<!DOCTYPE html>
<html lang="de">
<head>
    <title>Login – Stempeluhr</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: system-ui, sans-serif;
            background: #fff5fa;
            font-size: 20px;
            margin: 0;
            padding: 40px 20px;
            color: #3a2a33;
            display: flex;
            min-height: 80vh;
            align-items: center;
            justify-content: center;
        }
        .box { width: 100%; max-width: 440px; }
        h1 { font-size: 44px; margin-bottom: 30px; text-align: center; }
        .card {
            background: white;
            padding: 34px;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }
        label {
            display: block;
            font-size: 20px;
            margin-bottom: 8px;
            font-weight: 600;
        }
        input {
            width: 100%;
            box-sizing: border-box;
            font-size: 22px;
            padding: 14px;
            border: 3px solid #f0d5e2;
            border-radius: 10px;
            margin-bottom: 20px;
            background: white;
        }
        button {
            width: 100%;
            font-size: 26px;
            font-weight: 700;
            padding: 20px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            color: #2a2a2a;
            background: #b8ecc4;
        }
        button:hover { background: #a0e2af; }
        .remember {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            font-weight: 400;
            margin-bottom: 24px;
        }
        .remember input { width: auto; margin: 0; }
        .error {
            background: #fce1ec;
            border-left: 8px solid #f48fb8;
            padding: 14px 18px;
            border-radius: 8px;
            font-size: 18px;
            margin-bottom: 22px;
        }
    </style>
</head>
<body>
<div class="box">
    <h1>Stempeluhr</h1>

    <div class="card">
        @if ($errors->any())
            <div class="error">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <label for="email">E-Mail</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

            <label for="password">Passwort</label>
            <input id="password" type="password" name="password" required>

            <label class="remember">
                <input type="checkbox" name="remember" value="1">
                Angemeldet bleiben
            </label>

            <button type="submit">Anmelden</button>
        </form>
    </div>
</div>
</body>
</html>
