<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 30px auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        .btn { text-decoration: none; color: white; background: #007bff; padding: 4px 9px; border-radius: 4px; margin: 0 2px; }
        .btn-danger { background: #dc3545; }
        .btn-warning { background: #ffc107; color: black; }
        .total { font-weight: bold; font-size: 1.1em; }
        .kosong { background: #fff3cd; padding: 10px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Keranjang Belanja</h2>
        <a href="/index" class="btn">Kembali ke Daftar Barang</a>
    </div>
    <p><em>Tanpa login</em></p>

    @if (count($items) == 0)
        <div class="kosong">Keranjang masih kosong.</div>
    @else
        <table>
            <thead>
                <tr>
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
                        <td>{{ $item['nama'] }}</td>
                        <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                        <td>{{ $item['jumlah'] }}</td>
                        <td>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                        <td>
                            <a href="/minus/{{ $item['id'] }}" class="btn btn-warning">[-]</a>
                            <a href="/plus/{{ $item['id'] }}" class="btn">[+]</a>
                            <a href="/hapus/{{ $item['id'] }}" class="btn btn-danger">[hapus]</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="total">Total</td>
                    <td colspan="2" class="total">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

        <br>
        <a href="/kosongkan" class="btn btn-danger">Kosongkan Keranjang</a>
    @endif
</body>
</html>