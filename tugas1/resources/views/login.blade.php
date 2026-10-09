<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>

    <div>
        <h2>Login</h2>
        <p>Masuk untuk membuka dashboard</p>

        @error('login')
            <div style="color: red;">[ {{ $message }} ]</div>
        @enderror

        <form action="/login" method="POST">
            @csrf
            <div>
                <label>Username</label><br>
                <input type="text" name="username" value="{{ old('username') }}" required>
            </div>
            <br>
            <div>
                <label>Password</label><br>
                <input type="password" name="password" required>
            </div>
            <br>
            <button type="submit">Masuk</button>
        </form>
    </div>

</body>
</html>