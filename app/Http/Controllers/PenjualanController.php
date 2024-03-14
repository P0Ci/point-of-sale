<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Member;
use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penjualan = Penjualan::with('member');

        return view('penjualan.index', [
            'transaksi' => $penjualan->latest()->filter(request(['member']))->paginate(10),
            'members' => Member::all()
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_penjualan)
    {
        $transaksi = Penjualan::find($id_penjualan);

        $product = Product::get();

        if ($product->isEmpty()) {
            return redirect()->route('penjualan.index')->with('error', 'Product belum tersedia, mohon lapor ke admin');
        }

        $product_id = request('id_product');
        $p_detail = Product::find($product_id);

        $transaksi_detail = PenjualanDetail::whereid_penjualan($id_penjualan)->get();

        $act = request('act');
        $qty = request('qty');
        if ($act == 'min') {
            if ($qty <= 1) {
                $qty = 1;
            } else {
                $qty = $qty - 1;
            }
        } else {
            $qty = $qty + 1;
        }

        $subtotal = 0;
        if ($p_detail) {
            if ($qty > $p_detail->stok) {
                // Jika stok tidak mencukupi, berikan respons atau tindakan yang sesuai.
                echo "<script>alert('Stok produk tidak mencukupi'); window.history.back();</script>";
            } else {
                $subtotal = $qty * $p_detail->harga;
            }
        } else {
            $qty = 0;
        }

        $dibayarkan = request('dibayarkan');

        $kembalian = $dibayarkan - $transaksi->total_harga;
        return view('penjualan.create', [
            'products' => $product,
            'transaksi' => $transaksi,
            'qty'      => $qty,
            'subtotal' => $subtotal,
            'kembalian' => $kembalian,
            'transaksi_detail' => $transaksi_detail,
            'p_detail' => $p_detail

        ]);
    }

    public function addTransaksi()
    {
        $data = [
            'id_user' => auth()->user()->id
        ];
        Penjualan::Create($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePenjualanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePenjualanRequest $request)
    {
        $members = Member::latest()->first() ?? new Member();
        $kode_member = (int) $members->kode_member + 1;
        // Simpan data member
        $member = Member::create([
            'kode_member' => tambah_nol_didepan($kode_member, 5),
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'telepon' => $request->input('telepon'),
            // tambahkan kolom lainnya sesuai kebutuhan
        ]);

        // Simpan data penjualan dan mengaitkannya dengan member yang baru dibuat
        $penjualan = new Penjualan();
        $penjualan->id_member = $member->id_member;
        $penjualan->id_user = auth()->user()->id;
        // tambahkan atribut lainnya sesuai kebutuhan
        $penjualan->save();

        return redirect('/penjualan')->with('success', 'Member baru berhasil di tambah!!');
    }


    // Controller cetak data penjualan pertanggal

    public function cetakform()
    {
        return view('penjualan.cetak_ptgl');
    }

    public function cetakPenjualan($tglawal, $tglakhir)
    {
        // dd(["Tanggal Awal : " . $tglawal, "Tanggal Akhir : " . $tglakhir]);

        $tanggal = $tglawal . '-' . $tglakhir;
        // Konversi string tanggal awal dan akhir menjadi objek Carbon
        $tanggal_awal = Carbon::parse($tglawal)->startOfDay();
        $tanggal_akhir = Carbon::parse($tglakhir)->endOfDay();

        // Ambil data penjualan berdasarkan rentang tanggal created_at
        $cetakPertanggal = Penjualan::with('member')
            ->whereDate('created_at', '>=', $tanggal_awal)
            ->whereDate('created_at', '<=', $tanggal_akhir)
            ->get();

        if ($cetakPertanggal->isEmpty()) {
            // Jika tidak ada data ditemukan, tampilkan alert
            return redirect()->back()->with('error', 'Tanggal tidak ditemukan.');
        }

        $pdf = PDF::loadView('penjualan.cetak_penjualan_ptgl', ['cetakPtgl' => $cetakPertanggal, 'tanggal' => $tanggal]);
        $namaFile = "Laporan penjualan tanggal " . $tanggal . '.pdf';
        return $pdf->download($namaFile);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(Penjualan $penjualan)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePenjualanRequest  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePenjualanRequest $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Penjualan $penjualan)
    {
        //
    }
}
