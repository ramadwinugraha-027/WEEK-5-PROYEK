<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function form()
    {
        $keranjang = session()->get('keranjang', []);

        if (empty($keranjang)) {
            return redirect('/keranjang')->with('error', 'Keranjang kosong.');
        }

        $items = [];
        $total = 0;

        foreach ($keranjang as $id => $jumlah) {
            $p = Product::find($id);
            if (!$p) continue;

            $subtotal = $p->harga * $jumlah;
            $total += $subtotal;

            $items[] = [
                'id' => $p->id_barang,
                'nama' => $p->nama_barang,
                'harga' => $p->harga,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal,
            ];
        }

        return view('checkout', compact('items', 'total'));
    }

    public function proses(Request $request)
    {
        $request->validate([
            'alamat_pengiriman' => 'required',
        ]);

        $keranjang = session()->get('keranjang', []);

        if (empty($keranjang)) {
            return redirect('/keranjang')->with('error', 'Keranjang kosong.');
        }

        DB::beginTransaction();

        try {
            $total = 0;
            $detailItems = [];

            foreach ($keranjang as $id => $jumlah) {
                $p = Product::findOrFail($id);

                if ($p->stok < $jumlah) {
                    DB::rollBack();
                    return back()->with('error', 'Stok ' . $p->nama_barang . ' tidak cukup.');
                }

                $subtotal = $p->harga * $jumlah;
                $total += $subtotal;

                $detailItems[] = [
                    'id_barang' => $p->id_barang,
                    'harga_satuan' => $p->harga, // arsip harga saat dibeli
                    'jumlah_beli' => $jumlah,
                ];
            }

            // Generate ID order
            $last = Order::orderBy('id_order', 'desc')->first();
            $num = $last ? (int) substr($last->id_order, 3) + 1 : 1;
            $idOrder = 'ORD' . str_pad($num, 3, '0', STR_PAD_LEFT);

            $order = Order::create([
                'id_order' => $idOrder,
                'id_user' => Auth::user()->id_user,
                'tanggal_order' => now(),
                'total_harga' => $total,
                'alamat_pengiriman' => $request->alamat_pengiriman,
            ]);

            foreach ($detailItems as $d) {
                OrderDetail::create([
                    'id_order' => $idOrder,
                    'id_barang' => $d['id_barang'],
                    'harga_satuan' => $d['harga_satuan'],
                    'jumlah_beli' => $d['jumlah_beli'],
                ]);

                // Kurangi stok
                Product::where('id_barang', $d['id_barang'])
                    ->decrement('stok', $d['jumlah_beli']);
            }

            DB::commit();

            // Kosongkan keranjang
            session()->forget('keranjang');

            return redirect('/riwayat')->with('sukses', 'Checkout berhasil.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Checkout gagal: ' . $e->getMessage());
        }
    }

    public function riwayat()
    {
        $orders = Order::with('details.product')
            ->where('id_user', Auth::user()->id_user)
            ->orderBy('tanggal_order', 'desc')
            ->get();

        return view('riwayat', compact('orders'));
    }

    public function detail($id)
    {
        $order = Order::with('details.product')
            ->where('id_order', $id)
            ->where('id_user', Auth::user()->id_user)
            ->firstOrFail();

        return view('detail_pesanan', compact('order'));
    }
}