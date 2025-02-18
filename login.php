<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .container h2 {
            margin-bottom: 20px;
        }
        .container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .container input[type="submit"] {
            background-color: #4e54c8;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        .container input[type="submit"]:hover {
            background-color: #4e54c8;
        }
        .toggle {
            margin-top: 10px;
            font-size: 14px;
        }
        .toggle a {
            color: #007bff;
            text-decoration: none;
        }
        .toggle a:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        function toggleForm(formType) {
            document.getElementById('login-form').style.display = formType === 'login' ? 'block' : 'none';
            document.getElementById('register-form').style.display = formType === 'register' ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <div class="container">
        <div id="login-form">
            <h2>Login</h2>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
            </form>
            <div class="toggle">
                Belum punya akun? <a href="#" onclick="toggleForm('register')">Register</a>
            </div>
        </div>
        <div id="register-form" style="display: none;">
            <h2>Register</h2>
            <form method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <input type="submit" value="Register">
            </form>
            <div class="toggle">
                Sudah punya akun? <a href="#" onclick="toggleForm('login')">Login</a>
            </div>
        </div>
    </div>
</body>
</html>
