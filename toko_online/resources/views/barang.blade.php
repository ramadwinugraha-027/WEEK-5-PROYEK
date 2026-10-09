<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Toko Online</title>
    <style>
        body { font-family: Arial; max-width: 900px; margin: 30px auto; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        .produk-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }
        .produk { border: 1px solid #ccc; padding: 10px; border-radius: 6px; text-align: center; }
        .produk img { width: 120px; height: 120px; object-fit: cover; }
        .btn { text-decoration: none; color: white; background: #28a745; padding: 6px 12px; border-radius: 4px; display: inline-block; margin-top: 6px; }
        .btn-disabled { background: #999; cursor: not-allowed; }
        .error { color: red; }
        .sukses { color: green; }
        a.keranjang { background: #007bff; padding: 8px 14px; color: white; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Toko Online</h2>
        <div>
            @auth
                <span>Halo, {{ auth()->user()->nama_lengkap }}</span>
                <a href="/keranjang" class="keranjang">Keranjang</a>
                <a href="/riwayat" class="keranjang">Riwayat</a>
                <form method="POST" action="/logout" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn" style="background:#dc3545;">Logout</button>
                </form>
            @else
                <a href="/login" class="keranjang">Login</a>
                <a href="/register" class="keranjang">Register</a>
            @endauth
        </div>
    </div>

    @if (session('error'))
        <p class="error">{{ session('error') }}</p>
    @endif
    @if (session('sukses'))
        <p class="sukses">{{ session('sukses') }}</p>
    @endif

    <h3>Daftar Barang</h3>
    <div class="produk-grid">
        @foreach ($produk as $p)
            <div class="produk">
                <img src="{{ asset('gambar/' . $p->gambar) }}"
                     alt="{{ $p->nama_barang }}"
                     onerror="this.src='https://via.placeholder.com/120x120?text=No+Image'">
                <h4>{{ $p->nama_barang }}</h4>
                <p>Rp {{ number_format($p->harga, 0, ',', '.') }}</p>
                <p>Stok: {{ $p->stok }}</p>

                @auth
                    @if ($p->stok > 0)
                        <a href="/keranjang/tambah/{{ $p->id_barang }}" class="btn">Masukkan ke Keranjang</a>
                    @else
                        <span class="btn btn-disabled">Stok Habis</span>
                    @endif
                @else
                    <a href="/login" class="btn btn-disabled">Login untuk Membeli</a>
                @endauth
            </div>
        @endforeach
    </div>
</body>
</html>