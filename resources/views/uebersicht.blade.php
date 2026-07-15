<!DOCTYPE html>
<html>
<head>
    <title>Übersicht</title>
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
        .box { max-width: 900px; margin: 0 auto; }
        h1 { font-size: 48px; margin-bottom: 30px; }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
        }
        th {
            background: #f9c3da;
            font-size: 22px;
            padding: 20px;
            text-align: left;
        }
        td {
            padding: 20px;
            font-size: 21px;
            border-top: 2px solid #fdeef4;
        }
        tr:hover td { background: #fffafc; }
        .laeuft {
            background: #b8ecc4;
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
        }
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
    <h1>Übersicht</h1>

    <table>
        <tr>
            <th>Mitarbeiter</th>
            <th>Kommen</th>
            <th>Gehen</th>
            <th>Dauer</th>
        </tr>
        @foreach ($entries as $entry)
            <tr>
                <td><strong>{{ $entry->employee->name }}</strong></td>
                <td>{{ $entry->kommen->format('d.m.Y H:i') }}</td>
                <td>{{ $entry->gehen?->format('d.m.Y H:i') ?? '—' }}</td>
                <td>
                    @if ($entry->gehen)
                        @php
                            $min = $entry->kommen->diffInMinutes($entry->gehen);
                        @endphp
                        {{ intdiv($min, 60) }} Std {{ $min % 60 }} Min
                    @else
                        <span class="laeuft">läuft…</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    <a href="/">← Zurück zur Stempeluhr</a>
</div>
</body>
</html>