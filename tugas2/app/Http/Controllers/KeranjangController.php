<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    // Halaman daftar barang
    public function index()
    {
        $barang = Barang::all();
        $keranjang = session()->get('keranjang', []);
        $totalItem = array_sum(array_column($keranjang, 'jumlah'));

        return view('index', compact('barang', 'totalItem'));
    }

    // Tambah produk ke keranjang
    public function tambah(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']++;
        } else {
            $keranjang[$id] = [
                'id'     => $barang->id,
                'jumlah' => 1,
            ];
        }

        session()->put('keranjang', $keranjang);

        return redirect('/index')->with('sukses', 'Barang berhasil ditambahkan.');
    }

    // Halaman keranjang
    public function keranjang()
    {
        $keranjang = session()->get('keranjang', []);
        $items = [];
        $total = 0;

        foreach ($keranjang as $id => $item) {
            $barang = Barang::find($id);
            if (!$barang) {
                continue;
            }

            $subtotal = $barang->harga * $item['jumlah'];
            $total += $subtotal;

            $items[] = [
                'id'       => $barang->id,
                'nama'     => $barang->nama,
                'harga'    => $barang->harga,
                'jumlah'   => $item['jumlah'],
                'subtotal' => $subtotal,
            ];
        }

        return view('keranjang', compact('items', 'total'));
    }

    // Tambah jumlah (+)
    public function plus($id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']++;
            session()->put('keranjang', $keranjang);
        }

        return redirect('/keranjang');
    }

    // Kurang jumlah (-)
    public function minus($id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            $keranjang[$id]['jumlah']--;

            // Jika jumlah 0, hapus item
            if ($keranjang[$id]['jumlah'] <= 0) {
                unset($keranjang[$id]);
            }

            session()->put('keranjang', $keranjang);
        }

        return redirect('/keranjang');
    }

    // Hapus satu item
    public function hapus($id)
    {
        $keranjang = session()->get('keranjang', []);

        if (isset($keranjang[$id])) {
            unset($keranjang[$id]);
            session()->put('keranjang', $keranjang);
        }

        return redirect('/keranjang');
    }

    // Kosongkan keranjang
    public function kosongkan()
    {
        session()->forget('keranjang');

        return redirect('/keranjang');
    }
}