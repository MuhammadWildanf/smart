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
                <form method="POST" action="{{ route('criteria.update', $criterion->id) }}">
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
                                <label for="code" class="form-label">Kode <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="code" placeholder="Enter Full code"
                                    value="{{ $criterion->code }}">
                                @if ($errors->has('code'))
                                    <span class="text-danger">{{ $errors->first('code') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name" class="form-label">Nama Kriteria <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" placeholder="Enter name"
                                    value="{{ $criterion->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="slug" class="form-label">Nama Slug <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="slug" placeholder="Enter slug"
                                    value="{{ $criterion->slug }}">
                                @if ($errors->has('slug'))
                                    <span class="text-danger">{{ $errors->first('slug') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="bobot" class="form-label">Bobot <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="bobot" placeholder="Enter bobot" value="{{ $criterion->bobot }}">
                                @if ($errors->has('bobot'))
                                    <span class="text-danger">{{ $errors->first('bobot') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="normalisasi" class="form-label">Normalisasi <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="normalisasi" step="0.01" min="0"
                                    max="1" placeholder="Enter normalisasi Ex. 0.20"
                                    value="{{ $criterion->normalisasi }}">
                                @if ($errors->has('normalisasi'))
                                    <span class="text-danger">{{ $errors->first('normalisasi') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-control" name="type">
                                    <option value="">Select Type</option>
                                    @foreach ($typeOptions as $option)
                                        <option value="{{ $option }}"
                                            {{ $criterion->type == $option ? 'selected' : '' }}>{{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('type'))
                                    <span class="text-danger">{{ $errors->first('type') }}</span>
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
