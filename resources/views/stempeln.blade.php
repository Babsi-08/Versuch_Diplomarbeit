<!DOCTYPE html>
<html>
<head>
    <title>Stempeluhr</title>
    <meta charset="utf-8">
    <style>
        body {
            font-family: system-ui, sans-serif;
            background: #fff5fa;
            font-size: 20px;
            margin: 0;
            padding: 40px 20px;
            color: #3a2a33;
        }
        .box {
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            font-size: 48px;
            margin-bottom: 30px;
        }
        .status {
            padding: 20px;
            font-size: 24px;
            margin-bottom: 30px;
            border-radius: 8px;
        }
        .status-kommen {
            background: #d9f5e0;
            border-left: 8px solid #5fbf7a;
        }
        .status-gehen {
            background: #fce1ec;
            border-left: 8px solid #f48fb8;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 25px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }
        label {
            display: block;
            font-size: 22px;
            margin-bottom: 12px;
            font-weight: 600;
        }
        select {
            width: 100%;
            font-size: 24px;
            padding: 16px;
            border: 3px solid #f0d5e2;
            border-radius: 10px;
            margin-bottom: 20px;
            background: white;
        }
        button {
            width: 100%;
            font-size: 28px;
            font-weight: 700;
            padding: 24px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            color: #2a2a2a;
        }
        .kommen { background: #b8ecc4; }
        .kommen:hover { background: #a0e2af; }
        .gehen { background: #f9c3da; }
        .gehen:hover { background: #f4aac9; }
        a {
            display: block;
            text-align: center;
            font-size: 22px;
            color: #a04a72;
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="box">
    <h1>Stempeluhr</h1>

    @if (session('status'))
    <div class="status status-gehen">{{ session('status') }}</div>
    @endif

    <div class="card">
        <form method="POST" action="/kommen">
            @csrf
            <label>Ich komme</label>
            <select name="employee_id">
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="kommen">Kommen</button>
        </form>
    </div>

    <div class="card">
        <form method="POST" action="/gehen">
            @csrf
            <label>Ich gehe</label>
            <select name="employee_id">
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="gehen">Gehen</button>
        </form>
    </div>

    <a href="/uebersicht">Übersicht ansehen →</a>
</div>
</body>
</html>