@extends('adminlte::page')

@section('title', 'Rekomendasi Mobil')

@section('content_header')
    <h1>Rekomendasi Mobil</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <div class="card-title">
                            <h5>Filter Mobil</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="GET" id="form-filter" action="{{ route('recomendation.index') }}">
                            <div class="row">
                                @foreach ($criterias as $criteria)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="{{$criteria->slug}}">{{ $criteria->name }}:</label>
                                            <select name="{{$criteria->slug}}" id="{{$criteria->slug}}" class="form-control">
                                                <option value="">Semua</option>
                                                @foreach ($intervalCriteria[$criteria->slug] as $interval)
                                                    <option @if (old($criteria->slug) == $interval->id) selected @endif
                                                        value="{{ $interval->id }}">
                                                        {{ $interval->range }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mt-3">Firman</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @if ($cars->isEmpty())
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="alert alert-info">
                        Tidak ada mobil yang sesuai dengan kriteria yang dipilih.
                    </div>
                </div>
            </div>
        @else
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5>Nilai Kriteria untuk Setiap Mobil</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped dataTable dtr-inline">
                                    <thead>
                                        <tr>
                                            <th>Kode Mobil</th>
                                            <th>Nama</th>
                                            @foreach ($criterias as $criteria)
                                                <th>{{ $criteria->code }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cars as $car)
                                            <tr>
                                                <td>{{ $car->code }}</td>
                                                <td>{{ $car->name }}</td>
                                                @foreach ($criterias as $criteria)
                                                    @php
                                                        $value = $car->{$criteria->slug};
                                                        $interval_value = getIntervalValue($criteria, $value);
                                                    @endphp
                                                    <td>{{ $value }} ({{ $interval_value }})</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5>Nilai Alternatif (Utility)</h5>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped dataTable dtr-inline">
                                    <thead>
                                        <tr>
                                            <th>Kode Mobil</th>
                                            @foreach ($criterias as $criteria)
                                                <th>{{ $criteria->code }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cars as $car)
                                            <tr>
                                                <td>{{ $car->code }}</td>
                                                @foreach ($criterias as $criteria)
                                                    <td>{{ number_format($alternatives[$car->code][$criteria->slug], 4) }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h5>Ranking Mobil</h5>
                            </div>
                        </div>
                        <div class="card-body" id="card-ranking">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped dataTable dtr-inline">
                                    <thead>
                                        <tr>
                                            <th>Ranking</th>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Jumlah Kursi</th>
                                            <th>Warna</th>
                                            <th>Kapasitas Mesin</th>
                                            <th>Total Score</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cars as $index => $car)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $car->code }}</td>
                                                <td>{{ $car->name }}</td>
                                                <td>{{ $car->price }}</td>
                                                <td>{{ $car->available_seat }}</td>
                                                <td>{{ $car->color }}</td>
                                                <td>{{ $car->capacity_machine }}</td>
                                                <td>{{ number_format($car->total_score, 4) }}</td>
                                                <td>
                                                    @if ($loop->iteration == 1)
                                                        <span class="badge bg-success">SANGAT LAYAK</span>
                                                    @elseif($loop->iteration == 2)
                                                        <span class="badge bg-primary">LAYAK</span>
                                                    @elseif($loop->iteration == 3)
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
        @endif
    </div>
@stop

@push('js')
    <script>
        $(document).ready(function() {
            var filter = @json($filter);

            console.log(filter);

            if (filter) {
                document.getElementById('card-ranking').scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    </script>
@endpush
