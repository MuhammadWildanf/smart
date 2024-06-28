@extends('adminlte::page')

@section('title', 'Update Sub Kriteria | Dashboard')

@section('content_header')
    <h1>Update Data Sub Kriteria</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="errorBox"></div>
            <div class="col-3">
                <form method="POST" action="{{ route('subcriteria.update', $subCriterion->id) }}">
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
                                <label for="criteria_id" class="form-label">Criteria <span
                                        class="text-danger">*</span></label>
                                <select class="form-control" name="criteria_id">
                                    <option value="">Pilih Kriteria</option>
                                    @foreach ($criteria as $criterion)
                                        <option value="{{ $criterion->id }}"
                                            {{ (old('criteria_id') ? old('criteria_id') : $subCriterion->criteria_id) == $criterion->id ? 'selected' : '' }}>
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
                                    placeholder="Masukan Nama kriteria"
                                    value="{{ old('range') ? old('range') : $subCriterion->range }}">
                                @if ($errors->has('range'))
                                    <span class="text-danger">{{ $errors->first('range') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="value" class="form-label">Value <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="value" placeholder="Masukan Nama value"
                                    value="{{ old('value') ? old('value') : $subCriterion->value }}">
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
