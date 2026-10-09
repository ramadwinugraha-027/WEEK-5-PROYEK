<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $produk = [
            ['P001', 'Buku Tulis',   5000,  50, 'buku.jpg'],
            ['P002', 'Pulpen',       3000, 100, 'pulpen.jpg'],
            ['P003', 'Penggaris',    4000,  30, 'penggaris.jpg'],
            ['P004', 'Pensil 2B',    2500,  80, 'pensil.jpg'],
            ['P005', 'Penghapus',    1500,  60, 'penghapus.jpg'],
            ['P006', 'Spidol',       8000,  25, 'spidol.jpg'],
            ['P007', 'Buku Gambar', 10000,  20, 'bukugambar.jpg'],
            ['P008', 'Lem Kertas',   6000,  40, 'lem.jpg'],
            ['P009', 'Gunting',     12000,  15, 'gunting.jpg'],
            ['P010', 'Tas Sekolah', 85000,   5, 'tas.jpg'],
        ];

        foreach ($produk as $p) {
            Product::create([
                'id_barang'   => $p[0],
                'nama_barang' => $p[1],
                'harga'       => $p[2],
                'stok'        => $p[3],
                'gambar'      => $p[4],
            ]);
        }
    }
}