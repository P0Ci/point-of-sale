<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('categories');
        return view('products.index', [
            'products' => $products->latest()->filter(request(['product']))->paginate(10),
            'categories' => Category::all()->pluck('nama_categories', 'id_categories')
        ]);
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Product::whereIn('id_product', $ids)->delete();
        return response()->json(["success" => "Product have been deleted!"]);
    }

    public function cetakBarcode(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama_product' => 'required|max:225',
            'id_categories' => 'required',
            'merk' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ]);




        $product = Product::latest()->first() ?? new Product();
        $validatedData['kode_product'] = 'P' . tambah_nol_didepan($product->id_product + 1, 6);

        Product::create($validatedData);

        return redirect('/product')->with('success', 'Product baru berhasil di tambah!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'nama_product' => 'required|max:225',
            'id_categories' => 'required',
            'merk' => 'required',
            'harga' => 'required',
            'stok' => 'required',
        ];

        $validatedData = $request->validate($rules);

        Product::where('id_product', $product->id_product)
            ->update($validatedData);

        return redirect('/product')->with('success', 'Product berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id_product);

        return redirect('/product')->with('success', 'Product berhasil dihapus!');
    }
}
