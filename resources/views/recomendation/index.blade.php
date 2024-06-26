@extends('adminlte::page')

@section('title', 'Rekomendasi')

@section('content_header')
    <h1>Rekomendasi</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('recomendation.calculate') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="harga">Harga:</label>
                                <select class="form-control" id="harga" name="harga">
                                    <option value="">Pilih Harga</option> {{-- Opsi default --}}
                                    @foreach ($prices as $price)
                                        <option value="{{ $price->id }}">{{ $price->harga }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="warna">Warna:</label>
                                <select class="form-control" id="warna" name="warna">
                                    <option value="">Pilih Warna</option> {{-- Opsi default --}}
                                    @foreach ($colors as $color)
                                        <option value="{{ $color->id }}">{{ $color->warna }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="kapasitas_mesin">Kapasitas Mesin:</label>
                                <select class="form-control" id="kapasitas_mesin" name="kapasitas_mesin">
                                    <option value="">Pilih Kapasitas Mesin</option> {{-- Opsi default --}}
                                    @foreach ($capacities as $capacity)
                                        <option value="{{ $capacity->id }}">{{ $capacity->kapasitas_mesin }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_seat">Jumlah Seat:</label>
                                <select class="form-control" id="jumlah_seat" name="jumlah_seat">
                                    <option value="">Pilih Jumlah Seat</option> {{-- Opsi default --}}
                                    @foreach ($seats as $seat)
                                        <option value="{{ $seat->id }}">{{ $seat->jumlah_seat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Hitung</button>
                        </form>
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
