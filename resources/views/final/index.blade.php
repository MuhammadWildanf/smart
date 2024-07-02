@extends('adminlte::page')

@section('title', 'Hasil Akhir Rekomendasi')

@section('content_header')
    <h1>Hasil Akhir Rekomendasi</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Hasil Akhir Perengkingan</th>
                                    <th>Nilai</th>
                                    <th>Rank</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($hasil_perhitungan))
                                    @foreach ($hasil_perhitungan as $mobil => $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $mobil }}</td>
                                            <td>{{ $data['total'] }}</td>
                                            <td>{{ $data['rank'] }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
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
