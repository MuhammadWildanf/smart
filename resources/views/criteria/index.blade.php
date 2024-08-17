@extends('adminlte::page')

@section('title', 'Kriteria | Dashboard')

@section('content_header')
    <h1>Daftar Kriteria</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="errorBox"></div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h5 class="">List</h5>
                            {{-- <div class="">
                                <a class="btn btn-primary m-0" href="{{ route('criteria.create') }}"><i
                                        class="fas fa-plus"></i> Add</a>
                            </div> --}}
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
