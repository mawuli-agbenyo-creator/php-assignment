<!DOCTYPE html>
<html>
<head>
    <title>Index Page</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            margin: 0;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 200px;
        }
        .card a {
            text-decoration: none;
            color: white;
            background-color: #007BFF;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Login</h2>
            <p>Already have an account?</p>
            <a href="login.php">Login</a>
        </div>
        <div class="card">
            <h2>Register</h2>
            <p>Don't have an account?</p>
            <a href="register.php">Register</a>
        </div>
    </div>
</body>
</html>
