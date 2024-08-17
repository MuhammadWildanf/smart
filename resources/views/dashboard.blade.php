@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-body">
                    <div style="width: 100%; height: 50vh; margin: auto;">
                        <canvas id="totalScoreChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @hasrole('administrator')
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('cars.index') }}" class="">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                Daftar Mobil ({{ $cars }})
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('criteria.index') }}" class="">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                Kriteria ({{ $criteria }})
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('subcriteria.index') }}" class="">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                Sub Kriteria ({{ $subcriteria }})
                            </h5>

                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{ route('evaluation.index') }}" class="">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                Penilaian ({{ $evaluations }})
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('history.index') }}" class="">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                History ({{ $evaluations }})
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('users.index') }}" class="">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                Users ({{ $users }})
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endhasrole
    @hasrole('user')
        <div class="row">
            <div class="col">
                <a href="{{ route('list-cars.index') }}" class="">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                Daftar Mobil ({{ $cars }})
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('recomendation.index') }}" class="">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                Rekomendasi Mobil ({{ $evaluations }})
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col">
                <a href="{{ route('hasil-akhir.index') }}" class="">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                Hasil Akhir ({{ $hasil_akhir }})
                            </h5>

                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endhasrole
    @hasrole('manager')
        <div class="row">
            <div class="col">
                <a href="{{ route('history.index') }}" class="">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                History
                            </h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('list-cars.index') }}" class="">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                Daftar Mobil ({{ $cars }})
                            </h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('evaluation.index') }}" class="">
                    <div class="card">
                        <div class="card-body">
                            <h5>
                                Penilaian ({{ $evaluations }})
                            </h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    @endhasrole

@endsection

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>

    <script>
        getData();

        function getData() {
            $.ajax({
                url: "{{ route('dashboard.getDataChart') }}",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    getChart(data.cars, data.total_scores);
                }
            });
        }

        function getChart(cars, total_scores) {
            var ctx = document.getElementById('totalScoreChart').getContext('2d');
            var totalScoreChart = new Chart(ctx, {
                type: 'line', // Pilihan: 'bar', 'line', 'radar', 'pie', 'doughnut', 'scatter'
                data: {
                    labels: cars,
                    datasets: [{
                        label: 'Total Score',
                        data: total_scores.map(score => parseFloat(score.toFixed(
                            2))), // Memformat data menjadi 2 desimal
                        backgroundColor: 'rgba(54, 162, 235, 1)',
                        borderColor: 'rgba(54, 162, 235, 1)', // Warna garis tidak transparan
                        borderWidth: 3, // Menambah ketebalan garis
                        pointBackgroundColor: 'rgba(54, 162, 235, 1)', // Warna titik data tanpa transparansi
                        pointBorderColor: '#fff', // Warna border titik data
                        pointBorderWidth: 2, // Ketebalan border titik data
                    }]
                },
                options: {
                    responsive: true, // Membuat chart responsif
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        datalabels: {
                            align: 'end', // Mengatur posisi label (pilihan: 'start', 'center', 'end')
                            anchor: 'end', // Mengatur titik jangkar label (pilihan: 'start', 'center', 'end')
                            backgroundColor: 'rgba(0, 0, 0, 0.7)', // Warna latar belakang label
                            borderRadius: 4,
                            color: 'white',
                            formatter: function(value) {
                                return value; // Menampilkan nilai total_score
                            }
                        }
                    }
                },
                plugins: [ChartDataLabels]
            });
        }
    </script>
@endsection
