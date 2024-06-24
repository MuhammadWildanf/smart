@extends('adminlte::page')

@section('title', 'Evaluation')

@section('content_header')
    <h1>Evaluation</h1>
@stop

@section('content')
<div class="container">
    <h1>Car Evaluation</h1>

    <h2>Nilai Alternatif Mobil</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Alternatif</th>
                <th>C1 (Harga)</th>
                <th>C2 (Jumlah Seat)</th>
                <th>C3 (Warna)</th>
                <th>C4 (Kapasitas Mesin)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($utilities as $carId => $utility)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $utility['nama'] }}</td>
                    <td>{{ $utility['C1'] }}</td>
                    <td>{{ $utility['C2'] }}</td>
                    <td>{{ $utility['C3'] }}</td>
                    <td>{{ $utility['C4'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Nilai Utility</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Alternatif</th>
                <th>C1 (Harga)</th>
                <th>C2 (Jumlah Seat)</th>
                <th>C3 (Warna)</th>
                <th>C4 (Kapasitas Mesin)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($utilities as $carId => $utility)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $utility['nama'] }}</td>
                    <td>{{ number_format($utility['C1'], 2) }}</td>
                    <td>{{ number_format($utility['C2'], 2) }}</td>
                    <td>{{ number_format($utility['C3'], 2) }}</td>
                    <td>{{ number_format($utility['C4'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Nilai Keseluruhan</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Alternatif</th>
                <th>C1 (Harga)</th>
                <th>C2 (Jumlah Seat)</th>
                <th>C3 (Warna)</th>
                <th>C4 (Kapasitas Mesin)</th>
                <th>Total</th>
                <th>Rank</th>
                <th>Rekomendasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rankings as $carId => $ranking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $ranking['utility']['nama'] }}</td>
                    <td>{{ number_format($ranking['utility']['C1'] * 0.35, 2) }}</td>
                    <td>{{ number_format($ranking['utility']['C2'] * 0.30, 2) }}</td>
                    <td>{{ number_format($ranking['utility']['C3'] * 0.15, 2) }}</td>
                    <td>{{ number_format($ranking['utility']['C4'] * 0.20, 2) }}</td>
                    <td>{{ number_format($ranking['total'], 2) }}</td>
                    <td>{{ $ranking['rank'] }}</td>
                    <td>{{ $ranking['recommendation'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
