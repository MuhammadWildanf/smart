@extends('adminlte::page')

@section('title', 'Kriteria | Dashboard')

@section('content_header')
    <h1>Daftar Kriteria</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="errorBox"></div>
            <div class="col-3">
                <form method="POST" action="{{ route('criteria.store') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5>Add New</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="code" class="form-label">kode <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="code" placeholder="ex: C1"
                                    value="{{ old('code') }}">
                                @if ($errors->has('code'))
                                    <span class="text-danger">{{ $errors->first('code') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name"
                                    placeholder="Masukan Nama kriteria" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug" placeholder="Masukan Nama Slug"
                                    value="{{ old('slug') }}">
                                @if ($errors->has('slug'))
                                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="bobot" class="form-label">Bobot <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="bobot" placeholder="Masukan bobot"
                                    value="{{ old('bobot') }}">
                                @if ($errors->has('bobot'))
                                    <span class="text-danger">{{ $errors->first('bobot') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="normalisasi" class="form-label">Normalisasi <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="normalisasi" step="0.01" min="0"
                                    max="1" placeholder="Masukan kriteria" value="{{ old('normalisasi') }}">
                                @if ($errors->has('normalisasi'))
                                    <span class="text-danger">{{ $errors->first('normalisasi') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-control" name="type">
                                    <option value="">Pilih Type</option>
                                    <option value="cost" {{ old('type') == 'cost' ? 'selected' : '' }}>Cost</option>
                                    <option value="benefit" {{ old('type') == 'benefit' ? 'selected' : '' }}>Benefit
                                    </option>
                                </select>
                                @error('type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
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
                                        <th>Kode</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Bobot</th>
                                        <th>Normalisasi</th>
                                        <th>type</th>
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
                ajax: "{{ route('criteria.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'bobot',
                        name: 'bobot'
                    },
                    {
                        data: 'normalisasi',
                        name: 'normalisasi'
                    },
                    {
                        data: 'type',
                        name: 'type'
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
                    var route = "{{ route('criteria.destroy', ':id') }}";
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
@stop

@section('plugins.Datatables', true)
@section('plugins.Select2', true)
