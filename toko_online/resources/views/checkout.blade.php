<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <style>
        body { font-family: Arial; max-width: 700px; margin: 30px auto; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
        textarea { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 10px 20px; background: #28a745; color: white; border: none; cursor: pointer; border-radius: 4px; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Checkout</h2>

    @if (session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif

    <table>
        <thead>
            <tr><th>Nama</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th></tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item['nama'] }}</td>
                    <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                    <td>{{ $item['jumlah'] }}</td>
                    <td>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align:right;"><strong>Total</strong></td>
                <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <form method="POST" action="/checkout">
        @csrf
        <label>Alamat Pengiriman</label>
        <textarea name="alamat_pengiriman" rows="3" required>{{ auth()->user()->alamat }}</textarea>
        <br><br>
        <button type="submit">Konfirmasi Checkout</button>
    </form>
</body>
</html>