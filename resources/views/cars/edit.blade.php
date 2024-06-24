@extends('adminlte::page')

@section('title', 'Update Cars | Dashboard')

@section('content_header')
    <h1>Update Data Mobil</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="errorBox"></div>
            <div class="col-3">
                <form method="POST" action="{{ route('cars.update', $car->id) }}">
                    @method('patch')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5>Update Data Mobil</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Mobil"
                                    value="{{ $car->nama }}">
                                @if ($errors->has('nama'))
                                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="harga_id" class="form-label">Harga <span class="text-danger">*</span></label>
                                <select class="form-control" name="harga_id">
                                    @foreach ($prices as $harga)
                                        <option value="{{ $harga->id }}"
                                            {{ $car->harga_id == $harga->id ? 'selected' : '' }}>{{ $harga->harga }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('harga_id'))
                                    <span class="text-danger">{{ $errors->first('harga_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="seat_id" class="form-label">Jumlah Seat</label>
                                <select class="form-control" name="seat_id">
                                    @foreach ($seats as $seat)
                                        <option value="{{ $seat->id }}"
                                            {{ $car->seat_id == $seat->id ? 'selected' : '' }}>{{ $seat->jumlah_seat }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('seat_id'))
                                    <span class="text-danger">{{ $errors->first('seat_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="warna_id" class="form-label">Warna</label>
                                <select class="form-control" name="warna_id">
                                    @foreach ($colos as $warna)
                                        <option value="{{ $warna->id }}"
                                            {{ $car->warna_id == $warna->id ? 'selected' : '' }}>{{ $warna->warna }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('warna_id'))
                                    <span class="text-danger">{{ $errors->first('warna_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="kapasitas_mesin_id" class="form-label">Kapasitas Mesin</label>
                                <select class="form-control" name="kapasitas_mesin_id">
                                    @foreach ($capacities as $kapasitas)
                                        <option value="{{ $kapasitas->id }}"
                                            {{ $car->kapasitas_mesin_id == $kapasitas->id ? 'selected' : '' }}>
                                            {{ $kapasitas->kapasitas_mesin }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('kapasitas_mesin_id'))
                                    <span class="text-danger">{{ $errors->first('kapasitas_mesin_id') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(function() {
            $('#select2').select2();
        });
    </script>
@stop
@section('plugins.Select2', true)
