<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function index()
    {
        $keranjang = session()->get('keranjang', []);
        $items = [];
        $total = 0;

        foreach ($keranjang as $id => $jumlah) {
            $p = Product::find($id);
            if (!$p) continue;

            $subtotal = $p->harga * $jumlah;
            $total += $subtotal;

            $items[] = [
                'id'       => $p->id_barang,
                'nama'     => $p->nama_barang,
                'harga'    => $p->harga,
                'gambar'   => $p->gambar,
                'jumlah'   => $jumlah,
                'subtotal' => $subtotal,
            ];
        }

        return view('keranjang', compact('items', 'total'));
    }

    public function tambah($id)
    {
        $p = Product::findOrFail($id);

        if ($p->stok <= 0) {
            return back()->with('error', 'Stok habis.');
        }

        $keranjang = session()->get('keranjang', []);
        $jumlahSekarang = $keranjang[$id] ?? 0;

        if ($jumlahSekarang + 1 > $p->stok) {
            return back()->with('error', 'Jumlah melebihi stok.');
        }

        $keranjang[$id] = $jumlahSekarang + 1;
        session()->put('keranjang', $keranjang);

        return redirect('/keranjang')->with('sukses', 'Barang ditambahkan.');
    }

    public function plus($id)
    {
        $p = Product::findOrFail($id);
        $keranjang = session()->get('keranjang', []);

        if (($keranjang[$id] ?? 0) + 1 > $p->stok) {
            return back()->with('error', 'Jumlah melebihi stok.');
        }

        $keranjang[$id] = ($keranjang[$id] ?? 0) + 1;
        session()->put('keranjang', $keranjang);

        return redirect('/keranjang');
    }

    public function minus($id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]--;
            if ($keranjang[$id] <= 0) {
                unset($keranjang[$id]);
            }
            session()->put('keranjang', $keranjang);
        }

        return redirect('/keranjang');
    }

    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);
        unset($keranjang[$id]);
        session()->put('keranjang', $keranjang);

        return redirect('/keranjang');
    }
}