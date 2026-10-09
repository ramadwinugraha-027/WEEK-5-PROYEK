<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <style>
        body { font-family: Arial; max-width: 800px; margin: 30px auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
        .btn { text-decoration: none; color: white; background: #007bff; padding: 4px 9px; border-radius: 4px; margin: 0 2px; }
        .btn-danger { background: #dc3545; }
        .btn-warning { background: #ffc107; color: black; }
        .btn-sukses { background: #28a745; padding: 8px 14px; }
        .error { color: red; background: #ffe6e6; padding: 10px; border-radius: 4px; }
        .sukses { color: green; background: #d4edda; padding: 10px; border-radius: 4px; }
        .kosong { background: #fff3cd; padding: 15px; border-radius: 4px; }
    </style>
</head>
<body>
    <h2>Keranjang Belanja</h2>
    <a href="/barang" class="btn">Lanjut Belanja</a>

    @if (session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif
    @if (session('sukses'))
        <p class="sukses">{{ session('sukses') }}</p>
    @endif

    @if (count($items) == 0)
        <div class="kosong">Keranjang masih kosong.</div>
    @else
        <table>
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td>
                            <img src="{{ asset('gambar/' . $item['gambar']) }}"
                                 width="50"
                                 onerror="this.src='https://via.placeholder.com/50'">
                        </td>
                        <td>{{ $item['nama'] }}</td>
                        <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                        <td>{{ $item['jumlah'] }}</td>
                        <td>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                        <td>
                            <a href="/keranjang/minus/{{ $item['id'] }}" class="btn btn-warning">-</a>
                            <a href="/keranjang/plus/{{ $item['id'] }}" class="btn">+</a>
                            <a href="/keranjang/hapus/{{ $item['id'] }}" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="text-align:right;"><strong>Total</strong></td>
                    <td colspan="2"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                </tr>
            </tbody>
        </table>

        <br>
        <a href="/checkout" class="btn btn-sukses">Checkout</a>
    @endif
</body>
</html>