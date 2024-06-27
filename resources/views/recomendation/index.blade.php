@extends('adminlte::page')

@section('title', 'Rekomendasi Mobil')

@section('content_header')
    <h1>Rekomendasi Mobil</h1>
@stop

@section('content')
    <div class="row">
        <form method="GET" action="{{ route('recomendation.index') }}">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Masukan Bobot</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="harga_sub_criteria" class="form-label">Harga <span class="text-danger">*</span></label>
                        <select class="form-control" name="harga_sub_criteria">
                            <option value="">Pilih Harga</option>
                            @foreach ($prices as $harga)
                                <option value="{{ $harga->id }}"
                                    {{ old('harga_sub_criteria') == $harga->id ? 'selected' : '' }}>
                                    {{ $harga->harga }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('harga_sub_criteria'))
                            <span class="text-danger">{{ $errors->first('harga_sub_criteria') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="seat_sub_criteria" class="form-label">Jumlah Seat</label>
                        <select class="form-control" name="seat_sub_criteria">
                            <option value="">Pilih Jumlah Seat</option>
                            @foreach ($seats as $seat)
                                <option value="{{ $seat->id }}"
                                    {{ old('seat_sub_criteria') == $seat->id ? 'selected' : '' }}>
                                    {{ $seat->jumlah_seat }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('seat_sub_criteria'))
                            <span class="text-danger">{{ $errors->first('seat_sub_criteria') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="warna_sub_criteria" class="form-label">Warna</label>
                        <select class="form-control" name="warna_sub_criteria">
                            <option value="">Pilih Warna</option>
                            @foreach ($colors as $warna)
                                <option value="{{ $warna->id }}"
                                    {{ old('warna_sub_criteria') == $warna->id ? 'selected' : '' }}>
                                    {{ $warna->warna }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('warna_sub_criteria'))
                            <span class="text-danger">{{ $errors->first('warna_sub_criteria') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="kapasitas_sub_criteria" class="form-label">Kapasitas Mesin</label>
                        <select class="form-control" name="kapasitas_sub_criteria">
                            <option value="">Pilih Kapasitas Mesin</option>
                            @foreach ($capacities as $kapasitas_mesin)
                                <option value="{{ $kapasitas_mesin->id }}"
                                    {{ old('kapasitas_sub_criteria') == $kapasitas_mesin->id ? 'selected' : '' }}>
                                    {{ $kapasitas_mesin->kapasitas_mesin }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('kapasitas_sub_criteria'))
                            <span class="text-danger">{{ $errors->first('kapasitas_sub_criteria') }}</span>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <h5>Hasil Perhitungan</h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Harga (C1)</th>
                                <th>Jumlah Seat (C2)</th>
                                <th>Warna (C3)</th>
                                <th>Kapasitas Mesin (C4)</th>
                                <th>Total Skor</th>
                                <th>Peringkat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($totalScores as $score)
                                <tr>
                                    <td>{{ $score['nama'] }}</td>
                                    <td>{{ number_format($score['C1'], 2) }}</td>
                                    <td>{{ number_format($score['C2'], 2) }}</td>
                                    <td>{{ number_format($score['C3'], 2) }}</td>
                                    <td>{{ number_format($score['C4'], 2) }}</td>
                                    <td>{{ number_format($score['total'], 2) }}</td>
                                    <td>{{ $score['peringkat'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
