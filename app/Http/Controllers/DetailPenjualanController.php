<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PenjualanDetail;
use App\Models\Penjualan;
use App\Models\Product;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;


class DetailPenjualanController extends Controller
{
    function create(Request $request)
    {
        // return die('masuk');
        // dd($request->all());
        $id_product = $request->id_product;
        $id_penjualan = $request->id_penjualan;

        $td = PenjualanDetail::whereid_product($id_product)->whereid_penjualan($id_penjualan)->first();

        $transaksi = Penjualan::find($id_penjualan);

        $product = Product::find($id_product);

        $validator = Validator::make($request->all(), [
            'qty' => 'required|integer|min:1', // Validasi qty sebagai integer dan minimal 1
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        if ($td == null) {
            $data = [
                'id_product' => $id_product,
                'nama_product' => $request->nama_product,
                'subtotal' => $request->subtotal,
                'jumlah_product' => $request->qty,
                'id_penjualan' => $id_penjualan
            ];
            PenjualanDetail::create($data);

            $td = [
                'total_harga' => $request->subtotal + $transaksi->total_harga
            ];
            $transaksi->update($td);

            // Kurangi stok produk
            $new_stock = $product->stok - $request->qty;
            $product->update(['stok' => $new_stock]);
        } else {
            $data = [
                'subtotal' => $request->subtotal + $td->subtotal,
                'jumlah_product' => $td->jumlah_product + $request->qty,
            ];
            $td->update($data);
            $td = [
                'total_harga' => $request->subtotal + $transaksi->total_harga
            ];
            $transaksi->update($td);

            // Kurangi stok produk
            $new_stock = $product->stok - $request->qty;
            $product->update(['stok' => $new_stock]);
        }

        return redirect('penjualan/create/' . $id_penjualan);
    }

    public function delete(PenjualanDetail $penjualanDetail, Request $request)
    {
        $id_penjualan_detail = $request->id;
        $td = PenjualanDetail::find($id_penjualan_detail);

        // Mendapatkan informasi produk yang akan dihapus
        $product = Product::find($td->id_product);

        $transaksi = Penjualan::find($td->id_penjualan);
        // Mengurangi total harga sesuai dengan subtotal produk yang akan dihapus
        $data = [
            'total_harga' => $transaksi->total_harga - $td->subtotal,
        ];
        $transaksi->update($data);


        // Menambahkan jumlah stok produk yang akan dikembalikan
        $new_stock = $product->stok + $td->jumlah_product;
        $product->update(['stok' => $new_stock]);


        $td->delete();
        return redirect()->back();
    }

    public function done($id_penjualan)
    {
        $transaksi = Penjualan::find($id_penjualan);
        $data = [
            'status' => 'selesai',
        ];
        $transaksi->update($data);
        return redirect('/penjualan');
    }

    public function show($id_penjualan)
    {
        $p_detail = PenjualanDetail::where('id_penjualan', $id_penjualan)->get();
        $penjualan = Penjualan::find($id_penjualan);
        return view('penjualan.detail',[
            'p_details' => $p_detail,
            'transaksi' => $penjualan
        ]);
    }

    public function viewPdf($id_penjualan)
    {
        $p_detail = PenjualanDetail::where('id_penjualan', $id_penjualan)->get();
        $penjualan = Penjualan::find($id_penjualan);

            // Mendapatkan tanggal saat ini dalam format tahun-bulan-tanggal
            $tanggal = now()->format('Ymd');

            // Menghasilkan angka acak 4 digit
            $angka_acak = rand(1000, 9999);

            // Gabungkan tanggal dan angka acak untuk membuat nomor invoice
            $nomor_invoice = $tanggal . $angka_acak;

        $pdf = Pdf::loadView('penjualan.invoice_pdf', compact('p_detail', 'penjualan', 'nomor_invoice'));
        $namaFile = "Invoive tagihan" . optional($penjualan->member)->nama . '.pdf';
        return $pdf->download($namaFile);

        // return view('penjualan.invoice_pdf', [
        //     'p_details' => $p_detail,
        //     'transaksi' => $penjualan,
        //     'nomor_invoice' => $nomor_invoice
        // ]);
    }
}
