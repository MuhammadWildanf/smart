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
                            <h5>Ranking Mobil</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped dataTable dtr-inline">
                                <thead>
                                    <tr>
                                        @hasrole('administrator|manager')
                                        <th>User</th>
                                        @endhasrole
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Jumlah Kursi</th>
                                        <th>Warna</th>
                                        <th>Kapasitas Mesin</th>
                                        <th>Ranking</th>
                                        <th>Total Score</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
@stop

@section('plugins.Datatables', true)
@section('plugins.Select2', true)