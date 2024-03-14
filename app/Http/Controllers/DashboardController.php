<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Member;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $product = Product::count();
        $pelanggan = Member::count();
        $penjualan = Penjualan::count();
    
        return view('home', [
            'products' => $product,
            'pelanggan' => $pelanggan,
            'penjualan' => $penjualan
        ]);
    }
}
