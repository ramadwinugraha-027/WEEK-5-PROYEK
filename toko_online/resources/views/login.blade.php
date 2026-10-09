<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body { font-family: Arial; max-width: 400px; margin: 50px auto; }
        input { display: block; width: 100%; padding: 8px; margin: 8px 0; box-sizing: border-box; }
        button { padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; }
        .error { color: red; }
        .sukses { color: green; }
    </style>
</head>
<body>
    <h2>Login</h2>

    @if ($errors->any())
        <p class="error">{{ $errors->first() }}</p>
    @endif
    @if (session('sukses'))
        <p class="sukses">{{ session('sukses') }}</p>
    @endif

    <form method="POST" action="/login">
        @csrf
        <label>Username</label>
        <input type="text" name="username" value="{{ old('username') }}" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Masuk</button>
    </form>

    <p>Belum punya akun? <a href="/register">Daftar di sini</a></p>
</body>
</html>