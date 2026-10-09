<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Alat Tulis</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 30px auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        .keranjang-link { text-decoration: none; color: white; background: #007bff; padding: 8px 14px; border-radius: 4px; }
        .btn { text-decoration: none; color: white; background: #28a745; padding: 5px 10px; border-radius: 4px; }
        .sukses { background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Toko Alat Tulis</h2>
        <a href="/keranjang" class="keranjang-link">Keranjang ({{ $totalItem }})</a>
    </div>

    @if (session('sukses'))
        <div class="sukses">{{ session('sukses') }}</div>
    @endif

    <h3>Daftar Barang</h3>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($barang as $b)
                <tr>
                    <td>{{ $b->nama }}</td>
                    <td>Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                    <td>{{ $b->stok }}</td>
                    <td>
                        <a href="/tambah/{{ $b->id }}" class="btn">Masukkan ke keranjang</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>