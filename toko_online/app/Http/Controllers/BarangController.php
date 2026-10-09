<?php

namespace App\Http\Controllers;

use App\Models\Product;

class BarangController extends Controller
{
    public function index()
    {
        $produk = Product::all();
        return view('barang', compact('produk'));
    }
}