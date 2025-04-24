<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Mitralaporan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background-color: #ffffff;
            color: #111827;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            padding: 20px;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .emoji {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .title {
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 25px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #336699;
            border-radius: 6px;
            outline: none;
            font-size: 15px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #336699;
            color: white;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #2a547a;
        }

        .divider {
            margin: 30px 0;
            display: flex;
            align-items: center;
            text-align: center;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .divider:not(:empty)::before {
            margin-right: 10px;
        }

        .divider:not(:empty)::after {
            margin-left: 10px;
        }

        .google-btn {
            width: 100%;
            padding: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            color: #111827;
        }

        .google-btn img {
            height: 20px;
            margin-right: 8px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="login-box">
        <div class="emoji">📊</div>
        <div class="title">Welcome</div>
        <div class="subtitle">Log in to access your reports and insights</div>

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <input type="email" name="email" placeholder="Email address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Continue</button>
        </form>

        <div class="divider">OR</div>

        <button class="google-btn">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google logo">
            Continue with Google
        </button>
    </div>
</div>
</body>
</html>
