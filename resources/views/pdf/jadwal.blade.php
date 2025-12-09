<!DOCTYPE html>
<html>

<head>
    <title>Jadwal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h2>Jadwal</h2>
    <table>
        <thead>
            <tr>
                <th>Judul Training</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwalTraining as $index )
            <tr>
                <td>{{ $index['judul_training'] }}</td>
                <td>{{ $index['tgl_mulai'] }}</td>
                <td>{{ $index['tgl_selesai'] }}</td>
                <td>{{ $index['lokasi'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>