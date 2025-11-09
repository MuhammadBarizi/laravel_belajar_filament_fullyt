<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Export Faktur</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Daftar Faktur</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Kode Faktur</th>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($records as $i => $r)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $r->kode_faktur }}</td>
                    <td>{{ $r->tanggal_faktur }}</td>
                    <td>{{ $r->customer?->nama_customer }}</td>
                    <td>{{ 'Rp ' . number_format($r->total, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>