<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; }
        .container { width: 300px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        button { width: 100%; padding: 10px; background: blue; color: white; border: none; }
        .toggle { margin-top: 10px; }
    </style>
    <script>
        function toggleForm(type) {
            document.getElementById('login-form').style.display = type === 'login' ? 'block' : 'none';
            document.getElementById('register-form').style.display = type === 'register' ? 'block' : 'none';
        }
    </script>
</head>
<body>

    <div class="container" id="login-form">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="toggle">Belum punya akun? <a href="#" onclick="toggleForm('register')">Register</a></div>
    </div>

    <div class="container" id="register-form" style="display: none;">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <div class="toggle">Sudah punya akun? <a href="#" onclick="toggleForm('login')">Login</a></div>
    </div>

</body>
</html>
