<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Mobil</title>
</head>
<body>
    <h3>
        <center>Laporan Data Mobil</center>
    </h3>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            @hasrole('administrator|manager')
                <th>User</th>
            @endhasrole
            <th>Kode</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Jumlah Akhir</th>
            <th>Warna</th>
            <th>Kapasitas Mesin</th>
            <th>Ranking</th>
            <th>Total Score</th>
        </tr>
        @foreach ($histories as $history)
            <tr>
                @hasrole('administrator|manager')
                    <td>{{ $history->history->user->name }}</td>
                @endhasrole
                <td>{{ $history->car->code }}</td>
                <td>{{ $history->car->name }}</td>
                <td>{{ $history->car->price }}</td>
                <td>{{ $history->car->available_seat }}</td>
                <td>{{ $history->car->color }}</td>
                <td>{{ $history->car->capacity_machine }}</td>
                <td>{{ $history->ranking }}</td>
                <td>{{ $history->total_score }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>


