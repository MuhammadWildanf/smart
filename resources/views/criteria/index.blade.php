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
                                <label for="kode" class="form-label">Kode <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="kode" placeholder="ex: C1"
                                    value="{{ old('kode') }}">
                                @if ($errors->has('kode'))
                                    <span class="text-danger">{{ $errors->first('kode') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="criteria" class="form-label">Kriteria <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="criteria" placeholder="Masukan kriteria"
                                    value="{{ old('criteria') }}">
                                @if ($errors->has('criteria'))
                                    <span class="text-danger">{{ $errors->first('criteria') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="weight" class="form-label">Bobot <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="weight" step="0.01" min="0" max="1" placeholder="Masukan kriteria"
                                    value="{{ old('weight') }}">
                                @if ($errors->has('weight'))
                                    <span class="text-danger">{{ $errors->first('weight') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="jenis" class="form-label">Jenis</label>
                                <select class="form-control" name="jenis">
                                    <option value="">Pilih Jenis</option>
                                    <option value="Cost" {{ old('jenis') == 'Cost' ? 'selected' : '' }}>Cost</option>
                                    <option value="Benefit" {{ old('jenis') == 'Benefit' ? 'selected' : '' }}>Benefit
                                    </option>
                                </select>
                                @if ($errors->has('jenis'))
                                    <span class="text-danger">{{ $errors->first('jenis') }}</span>
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
                                        <th>Kode</th>
                                        <th>kriteria</th>
                                        <th>Bobot</th>
                                        <th>jenis</th>
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
                        data: 'kode',
                        name: 'kode'
                    },
                    {
                        data: 'criteria',
                        name: 'criteria'
                    },
                    {
                        data: 'weight',
                        name: 'weight'
                    },
                    {
                        data: 'jenis',
                        name: 'jenis'
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
