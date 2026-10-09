<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body { font-family: Arial; max-width: 400px; margin: 30px auto; }
        input, textarea { display: block; width: 100%; padding: 8px; margin: 8px 0; box-sizing: border-box; }
        button { padding: 10px 20px; background: #28a745; color: white; border: none; cursor: pointer; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2>Register</h2>

    @if ($errors->any())
        <ul class="error">
            @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
        </ul>
    @endif

    <form method="POST" action="/register">
        @csrf
        <label>Nama Lengkap</label>
        <input type="text" name="nama_lengkap" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <label>No HP</label>
        <input type="text" name="no_hp" required>

        <label>Alamat</label>
        <textarea name="alamat" required></textarea>

        <button type="submit">Daftar</button>
    </form>

    <p>Sudah punya akun? <a href="/login">Login</a></p>
</body>
</html>