@extends('adminlte::page')

@section('title', 'Mobil | Dashboard')

@section('content_header')
    <h1>Daftar Mobil</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="errorBox"></div>
            <div class="col-3">
                <form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5>Add New</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="image_url" class="form-label">Image</label>
                                <input type="file" class="form-control" name="image_url" id="image_url">
                                <div id="image_preview" class="mt-2"></div>
                                @if ($errors->has('image_url'))
                                    <span class="text-danger">{{ $errors->first('image_url') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="code" class="form-label">Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="code" placeholder="Masukan code"
                                    value="{{ old('code') }}">
                                @if ($errors->has('code'))
                                    <span class="text-danger">{{ $errors->first('code') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Masukan name Mobil"
                                    value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="price" class="form-label">Harga <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="price" placeholder="Masukan Harga"
                                    value="{{ old('price') }}">
                                @if ($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="warna" class="form-label">Warna <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="color" placeholder="Masukan Warna"
                                    value="{{ old('warna') }}">
                                @if ($errors->has('warna'))
                                    <span class="text-danger">{{ $errors->first('warna') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="available_seat" class="form-label">Jumlah Kursi <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="available_seat" placeholder="Masukan Jumlah Kursi"
                                    value="{{ old('available_seat') }}">
                                @if ($errors->has('available_seat'))
                                    <span class="text-danger">{{ $errors->first('available_seat') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="capacity_machine" class="form-label">Kapasitas Mesin <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="capacity_machine" placeholder="Masukan Kapasitas Mesin(CC)"
                                    value="{{ old('capacity_machine') }}">
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
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>List</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <!--DataTable-->
                        <div class="table-responsive">
                            <table id="tblData" class="table table-bordered table-striped dataTable dtr-inline">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Code</th>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Warna</th>
                                        <th>Kapasitas Mesin</th>
                                        <th>Jumlah Kursi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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
        $(function() {
            $('#select2').select2();
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $(document).ready(function() {
            var table = $('#tblData').DataTable({
                reponsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: "{{ route('cars.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    { data: 'image_url', name: 'image_url', bSortable: false },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'color',
                        name: 'color'
                    },
                    {
                        data: 'capacity_machine',
                        name: 'capacity_machine'
                    },
                    {
                        data: 'available_seat',
                        name: 'available_seat'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        bSortable: false,
                        className: "text-center"
                    },
                ],
                order: [
                    [0, "desc"]
                ]
            });
            $('body').on('click', '#btnDel', function() {
                //confirmation
                var id = $(this).data('id');
                if (confirm('Delete Data ' + id + '?') == true) {
                    var route = "{{ route('cars.destroy', ':id') }}";
                    route = route.replace(':id', id);
                    $.ajax({
                        url: route,
                        type: "delete",
                        success: function(res) {
                            console.log(res);
                            $("#tblData").DataTable().ajax.reload();
                        },
                        error: function(res) {
                            $('#errorBox').html('<div class="alert alert-dander">' + response
                                .message + '</div>');
                        }
                    });
                } else {
                    //do nothing
                }
            });
        });
    </script>

<script>
    $(function() {
        // Meng-handle event ketika input file diubah
        $('#image_url').change(function() {
            let input = this;
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $('#image_preview').html('<img src="' + e.target.result + '" class="img-fluid" style="max-height: 200px;">');
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
@stop

@section('plugins.Datatables', true)
@section('plugins.Select2', true)
