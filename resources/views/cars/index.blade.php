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
                <form method="POST" action="{{ route('cars.store') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5>Add New</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama" placeholder="Masukan Nama Mobil"
                                    value="{{ old('nama') }}">
                                @if ($errors->has('nama'))
                                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="harga_id" class="form-label">Harga <span class="text-danger">*</span></label>
                                <select class="form-control" name="harga_id">
                                    @foreach ($prices as $harga)
                                        <option value="{{ $harga->id }}">{{ $harga->harga }}</option>
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
                                        <option value="{{ $seat->id }}">{{ $seat->jumlah_seat }}</option>
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
                                        <option value="{{ $warna->id }}">{{ $warna->warna }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('warna_id'))
                                    <span class="text-danger">{{ $errors->first('warna_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="kapasitas_mesin_id" class="form-label">Kapasitas Mesin</label>
                                <select class="form-control" name="kapasitas_mesin_id">
                                    @foreach ($capacities as $kapasitas_mesin)
                                        <option value="{{ $kapasitas_mesin->id }}">{{ $kapasitas_mesin->kapasitas_mesin }}
                                        </option>
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
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Warna</th>
                                        <th>Kapasitas Mesin</th>
                                        <th>Jumlah Seat</th>
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
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'harga',
                        name: 'harga.harga'
                    },
                    {
                        data: 'warna',
                        name: 'warna.warna'
                    },
                    {
                        data: 'kapasitas_mesin',
                        name: 'kapasitas_mesin.kapasitas_mesin'
                    },
                    {
                        data: 'seat',
                        name: 'seat.jumlah_seat'
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
@stop

@section('plugins.Datatables', true)
@section('plugins.Select2', true)
