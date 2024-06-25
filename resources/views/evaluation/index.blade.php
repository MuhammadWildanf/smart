@extends('adminlte::page')

@section('title', 'Evaluation')

@section('content_header')
    <h1>Evaluation</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Nilai Kriteria</h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>C1</th>
                                <th>C2</th>
                                <th>C3</th>
                                <th>C4</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cars as $car)
                                <tr>
                                    <td>{{ $car->id }}</td>
                                    <td>{{ $car->nama }}</td>
                                    <td>{{ $car->harga_id }}</td>
                                    <td>{{ $car->seat_id }}</td>
                                    <td>{{ $car->warna_id }}</td>
                                    <td>{{ $car->kapasitas_mesin_id }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Nilai Kriteria (dalam Desimal)</h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>C1</th>
                                <th>C2</th>
                                <th>C3</th>
                                <th>C4</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cars as $car)
                                <tr>
                                    <td>{{ $car->id }}</td>
                                    <td>{{ $car->nama }}</td>
                                    <td>{{ $car->harga_id_decimal }}</td>
                                    <td>{{ $car->seat_id_decimal }}</td>
                                    <td>{{ $car->warna_id_decimal }}</td>
                                    <td>{{ $car->kapasitas_mesin_id_decimal }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Nilai Utiliti</h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Alternatif</th>
                                <th>C1 ({{ $criteria->where('kode', 'C1')->first()->criteria }})</th>
                                <th>C2 ({{ $criteria->where('kode', 'C2')->first()->criteria }})</th>
                                <th>C3 ({{ $criteria->where('kode', 'C3')->first()->criteria }})</th>
                                <th>C4 ({{ $criteria->where('kode', 'C4')->first()->criteria }})</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($utilitiValues as $carId => $utiliti)
                                <tr>
                                    <td>{{ $utiliti['nama'] }}</td>
                                    <td>{{ number_format($utiliti['C1'], 2, ',', '.') }}</td>
                                    <td>{{ number_format($utiliti['C2'], 2, ',', '.') }}</td>
                                    <td>{{ number_format($utiliti['C3'], 2, ',', '.') }}</td>
                                    <td>{{ number_format($utiliti['C4'], 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Nilai Keseluruhan</h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Alternatif</th>
                                <th>C1</th>
                                <th>C2</th>
                                <th>C3</th>
                                <th>C4</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($totalScores as $score)
                                <tr>
                                    <td>{{ $score['nama'] }}</td>
                                    <td>{{ $score['C1'] }}</td>
                                    <td>{{ $score['C2'] }}</td>
                                    <td>{{ $score['C3'] }}</td>
                                    <td>{{ $score['C4'] }}</td>
                                    <td>{{ $score['total'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Hasil Evaluasi</h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Alternatif</th>
                                <th>Total</th>
                                <th>Peringkat</th>
                                <th>Rekomendasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($totalScores as $score)
                                @php
                                    $car = $cars->where('id', $loop->iteration)->first();
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $car->nama }}</td>
                                    <td>{{ isset($score['total']) ? $score['total'] : '' }}</td>
                                    <td>{{ isset($score['peringkat']) ? $score['peringkat'] : '' }}</td>
                                    <td>
                                        @if (isset($score['peringkat']))
                                            @if ($score['peringkat'] == 1)
                                                Sangat Layak
                                            @elseif ($score['peringkat'] == 2)
                                                Layak
                                            @elseif ($score['peringkat'] == 3)
                                                Dipertimbangkan
                                            @else
                                                Tidak Layak
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
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
