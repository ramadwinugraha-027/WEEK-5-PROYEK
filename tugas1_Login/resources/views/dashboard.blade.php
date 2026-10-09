<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Dashboard</h2>
        <form action="/logout" method="POST">
            @csrf
            <button type="submit">[ Logout ]</button>
        </form>
    </div>
    <hr>
    <h3>Selamat datang, {{ Auth::user()->nama_lengkap }}!</h3>
    <p>Halaman ini hanya bisa dibuka setelah login.</p>
    <p>Username: {{ Auth::user()->username }}</p>
</body>
</html>