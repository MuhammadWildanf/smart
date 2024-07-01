@extends('adminlte::page')

@section('title', 'Recomendation')

@section('content_header')
    <h1>Detail Mobil</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ $car->name }}</h2>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ asset('images/' . $car->image_url) }}" class="card-img-top" alt="Car Image">
                            </div>
                            <div class="col-md-6">
                                <p><strong>Harga:</strong> {{ $car->price }}</p>
                                <p><strong>Jumlah Kursi:</strong> {{ $car->available_seat }}</p>
                                <p><strong>Warna:</strong> {{ $car->color }}</p>
                                <p><strong>Kapasitas Mesin:</strong> {{ $car->capacity_machine }}</p>
                            </div>
                        </div>
                        {{-- <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Deskripsi Mobil</h3>
                            <p>{{ $car->full_description }}</p>
                        </div>
                    </div>
                    <hr> --}}
                        {{-- <div class="row">
                        <div class="col-md-12">
                            <h3>Fitur Utama</h3>
                            <ul>
                                <li>Fitur 1</li>
                                <li>Fitur 2</li>
                                <li>Fitur 3</li>
                                <!-- Tambahkan fitur lainnya sesuai kebutuhan -->
                            </ul>
                        </div>
                    </div> --}}
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
