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
                <form method="POST" action="{{ route('cars.update', $car->id) }}" enctype="multipart/form-data">
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
                                <label for="image_url" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image_url" id="image_url">
                                @if ($errors->has('image_url'))
                                    <span class="text-danger">{{ $errors->first('image_url') }}</span>
                                @endif
                                <br>
                                @if ($car->image_url)
                                    <img src="{{ asset('images/' . $car->image_url) }}" alt="Current Image"
                                        style="max-width: 200px; max-height: 200px;">
                                @else
                                    <img id="previewImage" src="{{ asset('images/no-image.png') }}" alt="Preview Image"
                                        style="max-width: 200px; max-height: 200px;">
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="code" class="form-label">Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="code" placeholder="Masukkan code"
                                    value="{{ $car->code }}">
                                @if ($errors->has('code'))
                                    <span class="text-danger">{{ $errors->first('code') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Masukkan nama Mobil"
                                    value="{{ $car->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="price" class="form-label">Harga <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="price" placeholder="Masukkan harga"
                                    value="{{ $car->price }}">
                                @if ($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="color" class="form-label">Warna <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="color" placeholder="Masukkan Warna"
                                    value="{{ $car->color }}">
                                @if ($errors->has('color'))
                                    <span class="text-danger">{{ $errors->first('color') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="available_seat" class="form-label">Jumlah Kursi <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="available_seat"
                                    placeholder="Masukkan Jumlah Kursi" value="{{ $car->available_seat }}">
                                @if ($errors->has('available_seat'))
                                    <span class="text-danger">{{ $errors->first('available_seat') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="capacity_machine" class="form-label">Kapasitas Mesin <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="capacity_machine"
                                    placeholder="Masukkan Kapasitas Mesin" value="{{ $car->capacity_machine }}">
                                @if ($errors->has('capacity_machine'))
                                    <span class="text-danger">{{ $errors->first('capacity_machine') }}</span>
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
    <script>
        $(document).ready(function() {
            // Fungsi untuk menampilkan preview gambar saat dipilih
            $('#image_url').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#previewImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@stop
@section('plugins.Select2', true)
