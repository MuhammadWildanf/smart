@extends('adminlte::page')

@section('title', 'Penilaian Mobil')

@section('content_header')
    <h1>Penilaian Mobil</h1>
@stop

@section('content')
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Nilai Kriteria untuk Setiap Mobil</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dataTable dtr-inline">
                            <thead>
                                <tr>
                                    <th>Kode Mobil</th>
                                    <th>Nama</th>
                                    @foreach ($criterias as $criteria)
                                        <th>{{ $criteria->code }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                    <tr>
                                        <td>{{ $car->code }}</td>
                                        <td>{{ $car->name }}</td>
                                        @foreach ($criterias as $criteria)
                                            @php
                                                $value = $car->{$criteria->slug};
                                                $interval_value = getIntervalValue($criteria, $value);
                                            @endphp
                                            <td>{{ $value }} ({{ $interval_value }})</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Nilai Alternatif (Utility)</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped dataTable dtr-inline">
                            <thead>
                                <tr>
                                    <th>Kode Mobil</th>
                                    @foreach ($criterias as $criteria)
                                        <th>{{ $criteria->code }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                    <tr>
                                        <td>{{ $car->code }}</td>
                                        @foreach ($criterias as $criteria)
                                            <td>{{ number_format($alternatives[$car->code][$criteria->slug], 4) }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>

     <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>Ranking Mobil</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped dataTable dtr-inline">
                                <thead>
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Jumlah Kursi</th>
                                        <th>Warna</th>
                                        <th>Kapasitas Mesin</th>
                                        <th>Total Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cars as $index => $car)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $car->code }}</td>
                                            <td>{{ $car->name }}</td>
                                            <td>{{ $car->price }}</td>
                                            <td>{{ $car->available_seat }}</td>
                                            <td>{{ $car->color }}</td>
                                            <td>{{ $car->capacity_machine }}</td>
                                            <td>{{ number_format($car->total_score, 4) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@stop

@section('css')
@stop

@section('js')

@stop
