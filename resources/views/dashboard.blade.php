@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @hasrole('administrator')
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('cars.index') }}" class="">
                <div class="card">
                    <div class="card-body">
                        <h5>
                            Daftar Mobil
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('criteria.index') }}" class="">
                <div class="card">
                    <div class="card-body">
                        <h5>
                            Kriteria
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('subcriteria.index') }}" class="">
                <div class="card">
                    <div class="card-body">
                        <h5>
                            Sub Kriteria
                        </h5>

                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="{{ route('evaluation.index') }}" class="">
                <div class="card">
                    <div class="card-body">
                        <h5>
                            Penilaian
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('history.index') }}" class="">
                <div class="card">
                    <div class="card-body">
                        <h5>
                            History
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('users.index') }}" class="">
                <div class="card">
                    <div class="card-body">
                        <h5>
                            Users
                        </h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endhasrole
    @hasrole('user')
    <div class="row">
        <div class="col">
            <a href="{{ route('list-cars.index') }}" class="">
                <div class="card">
                    <div class="card-body">
                        <h5>
                            Daftar Mobil
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('recomendation.index') }}" class="">
                <div class="card">
                    <div class="card-body">
                        <h5>
                            Rekomendasi Mobil
                        </h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{ route('hasil-akhir.index') }}" class="">
                <div class="card">
                    <div class="card-body">
                        <h5>
                            Hasil Akhir
                        </h5>

                    </div>
                </div>
            </a>
        </div>
    </div>
    @endhasrole
    @hasrole('manager')
    <div class="row">
        <div class="col">
            <a href="{{ route('history.index') }}" class="">
                <div class="card">
                    <div class="card-body">
                        <h5>
                            History
                        </h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endhasrole
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
