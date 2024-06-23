@extends('adminlte::page')

@section('title', 'Evaluation')

@section('content_header')
    <h1>Evaluation</h1>
@stop

@section('content')
    <div class="container">
        <h1>Car Evaluation</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Alternativ</th>
                    <th>C1 (Harga)</th>
                    <th>C2 (Jumlah Seat)</th>
                    <th>C3 (Warna)</th>
                    <th>C4 (Kapasitas Mesin)</th>
                    <th>Total</th>
                    <th>Rank</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rankings as $carId => $total)
                    <tr>
                        <td>{{ $utilities[$carId]['nama'] }}</td>
                        <td>{{ $utilities[$carId]['C1'] }}</td>
                        <td>{{ $utilities[$carId]['C2'] }}</td>
                        <td>{{ $utilities[$carId]['C3'] }}</td>
                        <td>{{ $utilities[$carId]['C4'] }}</td>
                        <td>{{ $total }}</td>
                        <td>{{ array_search($carId, array_keys($rankings)) + 1 }}</td>
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
