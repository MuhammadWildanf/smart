@extends('adminlte::page')

@section('title', 'Daftar Mobil')

@section('content_header')
    <h1>Daftar Mobil</h1>
@stop

@section('content')

    <div class="container-fluid" >
        <div class="container py-5">
            <div class="row justify-content-center">
                @foreach ($data->chunk(3) as $chunk)
                    @foreach ($chunk as $car)
                        <div class="col-md-4 mb-4">
                            <div class="card card-outline card-primary text-center h-100">
                                <img src="{{ asset('images/' . $car->image_url) }}" class="card-img-top img-fluid" alt="Car Image">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $car->nama }}</h5>
                                    <a href="{{ route('list-cars.show', $car->id) }}" class="btn btn-primary mt-auto">Detail</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
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
