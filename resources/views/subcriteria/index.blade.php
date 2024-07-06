@extends('adminlte::page')

@section('title', 'Sub Kriteria | Dashboard')

@section('content_header')
    <h1>Daftar Sub Kriteria</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="errorBox"></div>
            <div class="col-3">
                <form method="POST" action="{{ route('subcriteria.store') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5>Add New</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="criteria_id" class="form-label">Criteria <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="criteria_id">
                                    <option value="">Pilih Kriteria</option>
                                    @foreach ($criteria as $criterion)
                                        <option value="{{ $criterion->id }}"
                                            {{ old('criteria_id') == $criterion->id ? 'selected' : '' }}>
                                            {{ $criterion->name }} ({{ $criterion->code }})
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('criteria_id'))
                                    <span class="text-danger">{{ $errors->first('criteria_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="range" class="form-label">Range <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="range"
                                    placeholder="Masukan Nama kriteria" value="{{ old('range') }}">
                                @if ($errors->has('range'))
                                    <span class="text-danger">{{ $errors->first('range') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="value" class="form-label">Value <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="value" placeholder="Masukan Nama value"
                                    value="{{ old('value') }}">
                                @if ($errors->has('value'))
                                    <span class="text-danger">{{ $errors->first('value') }}</span>
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
                                        <th>Criteria</th>
                                        <th>Range</th>
                                        <th>value</th>
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
                ajax: "{{ route('subcriteria.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'criteria_name',
                        name: 'criteria_name'
                    },
                    {
                        data: 'range',
                        name: 'range'
                    },
                    {
                        data: 'value',
                        name: 'value'
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
                    var route = "{{ route('subcriteria.destroy', ':id') }}";
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
