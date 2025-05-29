<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameStore - Вход</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6c5ce7;
            --dark-color: #1a1a2e;
            --light-color: #f5f6fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: var(--dark-color);
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('https://images.unsplash.com/photo-1542751371-adc38448a05e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login-box {
            background-color: rgba(26, 26, 46, 0.9);
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .logo-icon {
            font-size: 32px;
            margin-right: 10px;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .login-header h1 {
            font-size: 20px;
            font-weight: 400;
        }

        .login-form .form-group {
            margin-bottom: 20px;
        }

        .login-form .form-control {
            width: 100%;
            padding: 12px 15px;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 4px;
            color: white;
            font-size: 14px;
            transition: all 0.3s;
        }

        .login-form .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: rgba(255, 255, 255, 0.2);
        }

        .login-form .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .login-button {
            width: 100%;
            padding: 12px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 15px;
        }

        .login-button:hover {
            background-color: #5649c0;
        }

        .forgot-password {
            display: block;
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
            text-decoration: none;
            margin-bottom: 20px;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: white;
        }

        .register-link {
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        .register-link a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
        }

        .register-link a:hover {
            color: #a29bfe;
        }

        .remember {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-check-input {
            margin-right: 10px;
        }

        .form-check-label {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>