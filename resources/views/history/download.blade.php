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
            <th>Image</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Jumlah Akhir</th>
            <th>Warna</th>
            <th>Kapasitas Mesin</th>
            <th>Ranking</th>
            <th>Total Score</th>
            <th>Keterangan</th>
        </tr>
        @foreach ($histories as $history)
            <tr>
                @hasrole('administrator|manager')
                    <td>{{ $history->history->user->name }}</td>
                @endhasrole
                <td>
                    @if ($history->car->image_base64)
                        <img src="{{ $history->car->image_base64 }}" alt="Car Image"
                            style="max-width: 100px; max-height: 100px;">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $history->car->code }}</td>
                <td>{{ $history->car->name }}</td>
                <td>{{ $history->car->price }}</td>
                <td>{{ $history->car->available_seat }}</td>
                <td>{{ $history->car->color }}</td>
                <td>{{ $history->car->capacity_machine }}</td>
                <td>{{ $history->ranking }}</td>
                <td>{{ $history->total_score }}</td>
                <td>
                    @if ($history->ranking == 1)
                        SANGAT LAYAK
                    @elseif($history->ranking == 2)
                        LAYAK
                    @elseif($history->ranking == 3)
                        DI PERTIMBANGKAN
                    @else
                        BISA DI PERTIMBANGKAN
                    @endif
                </td>
            </tr>
        @endforeach
    </table>
</body>

</html>
