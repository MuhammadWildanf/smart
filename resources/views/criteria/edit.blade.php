@extends('adminlte::page')

@section('title', 'Update Kriteria | Dashboard')

@section('content_header')
    <h1>Update Data Kriteria</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="errorBox"></div>
            <div class="col-3">
                <form method="POST" action="{{ route('cars.update', $criterion->id) }}">
                    @method('patch')
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5>Update Data Kriteria</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="kode" class="form-label">Kode <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="kode" placeholder="Enter Full kode"
                                    value="{{ $criterion->kode }}">
                                @if ($errors->has('kode'))
                                    <span class="text-danger">{{ $errors->first('kode') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="criteria" class="form-label">Kriteria <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="criteria"
                                    placeholder="Enter criteria" value="{{ $criterion->criteria }}">
                                @if ($errors->has('criteria'))
                                    <span class="text-danger">{{ $errors->first('criteria') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="jenis" class="form-label">Jenis</label>
                                <select class="form-control" name="jenis">
                                    <option value="">Pilih Jenis</option>
                                    @foreach ($jenisOptions as $option)
                                        <option value="{{ $option }}"
                                            {{ $criterion->jenis == $option ? 'selected' : '' }}>{{ $option }}
                                        </option>
                                    @endforeach
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
