@extends('adminlte::page')

@section('title', 'Sub Kriteria | Dashboard')

@section('content_header')
    <h1>Daftar Sub Kriteria</h1>
@stop

@section('content')
    <div class="container-fluid">
        <!-- Form tambah sub kriteria -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Tambah Sub Kriteria</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('subcriteria.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="criteria_id">Pilih Kriteria</label>
                                <select name="criteria_id" class="form-control" required>
                                    @foreach ($criteria as $criterion)
                                        <option value="{{ $criterion->id }}">{{ $criterion->criteria }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="interval">Nama Sub Kriteria</label>
                                <input type="text" name="interval" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nilai">Nilai</label>
                                <input type="text" name="nilai" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Sub Kriteria</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Daftar kriteria dan sub kriteria -->
        @foreach ($criteria as $criterion)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ $criterion->criteria }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Nama Sub Kriteria</th>
                                            <th>Nilai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($criterion->subcriteria as $index => $subCriterion)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $subCriterion->interval }}</td>
                                                <td>{{ $subCriterion->nilai }}</td>
                                                <td>
                                                    <a class='btn btn-xs btn-warning'
                                                        href='{{ route('subcriteria.edit', $subCriterion->id) }}'><i
                                                            class='fas fa-edit'></i></a>
                                                    <button class='btn btn-xs btn-outline-danger'
                                                        data-id='{{ $subCriterion->id }}'><i
                                                            class='fas fa-trash'></i></button>
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
        @endforeach
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.btn-outline-danger', function() {
                var id = $(this).data('id');
                if (confirm('Delete Data ' + id + '?')) {
                    var route = "{{ route('subcriteria.destroy', ':id') }}";
                    route = route.replace(':id', id);
                    $.ajax({
                        url: route,
                        type: "delete",
                        success: function(res) {
                            location.reload();
                        },
                        error: function(res) {
                            alert('Error deleting data');
                        }
                    });
                }
            });
        });
    </script>
@stop
