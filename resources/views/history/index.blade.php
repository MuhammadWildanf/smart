@extends('adminlte::page')

@section('title', 'History')

@section('content_header')
    <h1>History User</h1>
@stop

@section('content')
    @hasrole('administrator|manager')
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>Filter</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('history.index') }}">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="user_id">User</label>
                                    <select class="form-control select2" name="user_id" id="user_id">
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="car_id">Nama Mobil</label>
                                    <select class="form-control select2" name="car_id" id="car_id">
                                        <option value="">Select Car</option>
                                        @foreach ($cars as $car)
                                            <option value="{{ $car->id }}"
                                                {{ request('car_id') == $car->id ? 'selected' : '' }}>
                                                {{ $car->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="created_at">Tanggal</label>
                                    <input type="date" class="form-control" id="created_at" name="created_at"
                                        value="{{ request('created_at') }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endhasrole

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <div class="card-title">
                                <h5>Ranking Mobil</h5>
                            </div>
                        </div>
                        @hasrole('administrator|manager')
                            <div class="col-auto">
                                <a class="btn btn-sm btn-danger" href="{{ route('history.download') }}"><i
                                        class="fa fa-print"></i> Cetak PDF</a>
                            </div>
                        @endhasrole
                        @hasrole('user')
                            <div class="col-auto">
                                <a class="btn btn-sm btn-danger" href="{{ route('hasil-akhir.download') }}"><i
                                        class="fa fa-print"></i> Cetak PDF</a>
                            </div>
                        @endhasrole
                    </div>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered dataTable dtr-inline">
                            <thead>
                                <tr>
                                    @hasrole('administrator|manager')
                                        <th>User</th>
                                    @endhasrole
                                    <th>Image</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Jumlah Kursi</th>
                                    <th>Warna</th>
                                    <th>Kapasitas Mesin</th>
                                    <th>Ranking</th>
                                    <th>Total Score</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histories as $history)
                                    <tr>
                                        @hasrole('administrator|manager')
                                            <td>{{ $history->history->user->name }}</td>
                                        @endhasrole
                                        <td>

                                            @if ($history->car->image_url)
                                                <img src="{{ asset('images/' . $history->car->image_url) }}"
                                                    alt="Car Image" style="max-width: 100px; max-height: 100px;">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $history->car->code }}</td>
                                        <td>{{ $history->car->name }}</td>
                                        <td>{{ $history->car->price }}</td>
                                        <td>{{ $history->car->available_seat }}</td>
                                        <td>{{ $history->car->color }}</td>
                                        <td>{{ $history->car->capacity_machine }}</td>
                                        <td>{{ $history->ranking }}</td>
                                        <td>{{ $history->total_score }}</td>
                                        <td>
                                            @if ($history->ranking == 1)
                                                <span class="badge bg-success">SANGAT LAYAK</span>
                                            @elseif($history->ranking == 2)
                                                <span class="badge bg-primary">LAYAK</span>
                                            @elseif($history->ranking == 3)
                                                <span class="badge bg-info">DI PERTIMBANGKAN</span>
                                            @else
                                                <span class="badge bg-warning">BISA DI PERTIMBANGKAN</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop

@section('plugins.Datatables', true)
@section('plugins.Select2', true)
@section('css')
    <style>
        .select2-container .select2-selection--single {
            height: 38px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 38px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 38px !important;
        }
    </style>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@stop
