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

        /* Auth Container */
        .auth-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #1e272e;
            padding: 20px;
        }

        .auth-box {
            width: 100%;
            max-width: 450px;
            background: #2d3436;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.5s ease;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-header h1 {
            color: #6c5ce7;
            font-size: 1.8rem;
            margin-top: 15px;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .logo-icon {
            font-size: 2rem;
        }

        .logo-text {
            color: #fff;
            font-size: 1.8rem;
            font-weight: bold;
            letter-spacing: 1px;
        }

        /* Form Styles */
        .auth-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            position: relative;
            margin-bottom: 10px;
        }

        .form-group input {
            width: 100%;
            padding: 15px 0 5px 0;
            background: transparent;
            border: none;
            border-bottom: 2px solid #4b4b4b;
            color: #fff;
            font-size: 1rem;
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #6c5ce7;
        }

        .form-group label {
            position: absolute;
            top: 15px;
            left: 0;
            color: #b2b2b2;
            pointer-events: none;
            transition: all 0.3s;
        }

        .form-group input:focus+label,
        .form-group input:not(:placeholder-shown)+label {
            top: 0;
            font-size: 0.8rem;
            color: #6c5ce7;
        }

        .input-border {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: #6c5ce7;
            transition: width 0.3s;
        }

        .form-group input:focus~.input-border {
            width: 100%;
        }

        /* Button Styles */
        .auth-btn {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 20px;
            background: #6c5ce7;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.3s;
        }

        .auth-btn:hover {
            background: #5649c0;
            transform: translateY(-2px);
        }

        .btn-text {
            flex-grow: 1;
            text-align: center;
        }

        .auth-btn i {
            transition: transform 0.3s;
        }

        .auth-btn:hover i {
            transform: translateX(3px);
        }

        /* Login Link */
        .auth-link {
            text-align: center;
            color: #b2b2b2;
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .auth-link a {
            color: #6c5ce7;
            text-decoration: none;
            transition: color 0.3s;
        }

        .auth-link a:hover {
            color: #a29bfe;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    @yield('content')
</body>

</html>