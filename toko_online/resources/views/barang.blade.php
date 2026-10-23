<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            padding-bottom: 50px;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar h2 {
            font-size: 1.25rem;
            font-weight: 700;
            color: #4f46e5;
            letter-spacing: -0.5px;
        }
        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
            font-size: 0.875rem;
        }
        .user-greeting {
            font-weight: 500;
            color: #475569;
        }
        .user-greeting strong {
            color: #0f172a;
        }
        .btn-nav {
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .btn-primary {
            background-color: #4f46e5;
            color: #ffffff;
        }
        .btn-primary:hover {
            background-color: #4338ca;
        }
        .btn-outline {
            border: 1px solid #cbd5e1;
            color: #475569;
            background: #fff;
        }
        .btn-outline:hover {
            background-color: #f1f5f9;
            border-color: #94a3b8;
        }
        .btn-logout {
            background-color: #fee2e2;
            color: #b91c1c;
            border: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 6px;
            transition: background 0.2s;
        }
        .btn-logout:hover {
            background-color: #fecaca;
        }
        .container {
            max-width: 1280px;
            margin: 30px auto;
            padding: 0 20px;
        }
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #0f172a;
        }
        .produk-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 16px;
        }
        .produk-card {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            flex-direction: column;
        }
        .produk-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .produk-img-wrapper {
            width: 100%;
            height: 140px;
            background-color: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        .produk-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 8px;
        }
        .produk-info {
            padding: 12px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .produk-name {
            font-size: 0.875rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 4px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .produk-price {
            font-size: 1rem;
            font-weight: 700;
            color: #4f46e5;
            margin-bottom: 4px;
        }
        .produk-stock {
            font-size: 0.75rem;
            color: #64748b;
            margin-bottom: 12px;
        }
        .btn-cart {
            display: block;
            width: 100%;
            text-align: center;
            text-decoration: none;
            padding: 8px;
            background-color: #f8fafc;
            border: 1px solid #cbd5e1;
            color: #334155;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
            margin-top: auto;
            transition: all 0.2s;
        }
        .btn-cart:hover {
            background-color: #4f46e5;
            color: #ffffff;
            border-color: #4f46e5;
        }
        .btn-disabled {
            background-color: #f1f5f9;
            color: #94a3b8;
            border: 1px solid #e2e8f0;
            pointer-events: none;
        }

        @media (max-width: 1024px) {
            .produk-grid { grid-template-columns: repeat(4, 1fr); }
        }
        @media (max-width: 768px) {
            .produk-grid { grid-template-columns: repeat(3, 1fr); }
        }
        @media (max-width: 576px) {
            .produk-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <h2>Toko Online</h2>
        <div class="user-menu">
            @auth
                <span class="user-greeting">Halo, <strong>{{ auth()->user()->nama_lengkap }}</strong></span>
                <a href="/keranjang" class="btn-nav btn-outline">Keranjang</a>
                <a href="/riwayat" class="btn-nav btn-outline">Riwayat</a>
                <form method="POST" action="/logout" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            @else
                <a href="/login" class="btn-nav btn-outline">Login</a>
                <a href="/register" class="btn-nav btn-primary">Register</a>
            @endauth
        </div>
    </nav>

    <div class="container">
        @if (session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if (session('sukses'))
            <div class="alert alert-success">{{ session('sukses') }}</div>
        @endif

        <h3 class="section-title">Katalog Produk</h3>
        
        <div class="produk-grid">
            @foreach ($produk as $p)
                <div class="produk-card">
                    <div class="produk-img-wrapper">
                        <img src="{{ asset('gambar/' . $p->gambar) }}" 
                             alt="{{ $p->nama_barang }}" 
                             onerror="this.src='https://via.placeholder.com/200x200?text=No+Image'">
                    </div>
                    
                    <div class="produk-info">
                        <h4 class="produk-name">{{ $p->nama_barang }}</h4>
                        <div class="produk-price">Rp {{ number_format($p->harga, 0, ',', '.') }}</div>
                        <div class="produk-stock">Sisa: {{ $p->stok }}</div>

                        @auth
                            @if ($p->stok > 0)
                                <a href="/keranjang/tambah/{{ $p->id_barang }}" class="btn-cart">+ Keranjang</a>
                            @else
                                <span class="btn-cart btn-disabled">Habis</span>
                            @endif
                        @else
                            <a href="/login" class="btn-cart">Beli</a>
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>