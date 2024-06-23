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
            <form method="POST" action="{{route('cars.update', $car->id)}}">
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
                            <input type="text" class="form-control" name="nama" placeholder="Enter Full nama" value="{{$car->nama}}">
                            @if($errors->has('name'))
                                <span class="text-danger">{{$errors->first('name')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="harga" class="form-label">Harga <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="harga" placeholder="Enter Users harga" value="{{$car->harga}}">
                            @if($errors->has('harga'))
                                <span class="text-danger">{{$errors->first('harga')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="warna" class="form-label">Warna</label>
                            <input type="text" class="form-control" name="warna" placeholder="Enter Users warna" value="{{$car->warna}}">
                            @if($errors->has('warna'))
                                <span class="text-danger">{{$errors->first('warna')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="kapasitas_mesin" class="form-label">Kapasitas Mesin</label>
                            <input type="number" class="form-control" name="kapasitas_mesin" placeholder="Enter Users kapasitas_mesin" value="{{$car->kapasitas_mesin}}">
                            @if($errors->has('kapasitas_mesin'))
                                <span class="text-danger">{{$errors->first('kapasitas_mesin')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="jumlah_seat" class="form-label">Jumlah_seat</label>
                            <input type="number" class="form-control" name="jumlah_seat" placeholder="Enter Users jumlah_seat" value="{{$car->jumlah_seat}}">
                            @if($errors->has('jumlah_seat'))
                                <span class="text-danger">{{$errors->first('jumlah_seat')}}</span>
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
    $(function (){
        $('#select2').select2();
    });
</script>
@stop
@section('plugins.Select2', true)