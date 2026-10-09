<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pesanan</title>
    <style>
        body { font-family: Arial; max-width: 800px; margin: 30px auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn { text-decoration: none; color: white; background: #007bff; padding: 8px 14px; border-radius: 4px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
        .info { background: #f9f9f9; padding: 15px; border-radius: 6px; margin-bottom: 15px; }
        .info p { margin: 5px 0; }
        .total { text-align: right; font-weight: bold; font-size: 1.1em; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Detail Pesanan</h2>
        <a href="/riwayat" class="btn">Kembali ke Riwayat</a>
    </div>

    <div class="info">
        <p><strong>ID Order:</strong> {{ $order->id_order }}</p>
        <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($order->tanggal_order)->format('d-m-Y H:i') }}</p>
        <p><strong>Alamat Pengiriman:</strong> {{ $order->alamat_pengiriman }}</p>
    </div>

    <h3>Barang yang Dibeli</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->details as $detail)
                <tr>
                    <td>{{ $detail->product->nama_barang ?? '-' }}</td>
                    <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                    <td>{{ $detail->jumlah_beli }}</td>
                    <td>Rp {{ number_format($detail->harga_satuan * $detail->jumlah_beli, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total Bayar: Rp {{ number_format($order->total_harga, 0, ',', '.') }}</p>
</body>
</html>