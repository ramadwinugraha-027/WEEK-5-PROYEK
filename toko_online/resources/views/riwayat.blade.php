<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan</title>
    <style>
        body { font-family: Arial; max-width: 900px; margin: 30px auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn { text-decoration: none; color: white; background: #007bff; padding: 8px 14px; border-radius: 4px; }
        .btn-sukses { background: #28a745; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
        .sukses { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
        .kosong { background: #fff3cd; padding: 15px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Riwayat Pesanan</h2>
        <div>
            <a href="/barang" class="btn">Kembali ke Toko</a>
            <a href="/keranjang" class="btn btn-sukses">Keranjang</a>
        </div>
    </div>

    @if (session('sukses'))
        <div class="sukses">{{ session('sukses') }}</div>
    @endif

    @if ($orders->isEmpty())
        <div class="kosong">Belum ada pesanan.</div>
    @else
        <table>
            <thead>
                <tr>
                    <th>ID Order</th>
                    <th>Tanggal</th>
                    <th>Total Harga</th>
                    <th>Alamat Pengiriman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id_order }}</td>
                        <td>{{ \Carbon\Carbon::parse($order->tanggal_order)->format('d-m-Y H:i') }}</td>
                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $order->alamat_pengiriman }}</td>
                        <td>
                            <a href="/riwayat/{{ $order->id_order }}" class="btn">Lihat Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>