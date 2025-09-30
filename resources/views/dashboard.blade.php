@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <!-- Header -->
                <div class="card-header text-white text-center" style="background-color:#007bff; font-weight:bold; font-size:20px;">
                    Dashboard
                </div>

                <div class="card-body" style="background-color:#f8f9fa;">
                    
                    <h4 class="mb-3 text-center">📊 Ringkasan Keuangan</h4>
                    <p class="text-center text-muted">
                        Berikut adalah gambaran kondisi keuangan kamu.
                    </p>

                    <!-- Ringkasan -->
                    <div class="row text-center mb-4">
                        <div class="col-md-4">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h6>Pemasukan</h6>
                                    <h3>Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h6>Pengeluaran</h6>
                                    <h3>Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h6>Saldo</h6>
                                    <h3>Rp {{ number_format($totalIncome - $totalExpense, 0, ',', '.') }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Grafik -->
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card p-3 shadow-sm">
                                <h6 class="text-center">Perbandingan Pemasukan vs Pengeluaran</h6>
                                <canvas id="pieChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card p-3 shadow-sm">
                                <h6 class="text-center">Tren Keuangan Bulanan</h6>
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pie Chart
    new Chart(document.getElementById('pieChart'), {
        type: 'doughnut',
        data: {
            labels: ['Pemasukan', 'Pengeluaran'],
            datasets: [{
                data: [{{ $totalIncome }}, {{ $totalExpense }}],
                backgroundColor: ['#28a745', '#dc3545'],
            }]
        }
    });

    // Line Chart
    new Chart(document.getElementById('lineChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($months) !!}, // contoh: ["Jan","Feb","Mar"]
            datasets: [
                {
                    label: 'Pemasukan',
                    data: {!! json_encode($monthlyIncome) !!}, 
                    borderColor: '#28a745',
                    backgroundColor: 'rgba(40,167,69,0.2)',
                    tension: 0.3
                },
                {
                    label: 'Pengeluaran',
                    data: {!! json_encode($monthlyExpense) !!}, 
                    borderColor: '#dc3545',
                    backgroundColor: 'rgba(220,53,69,0.2)',
                    tension: 0.3
                }
            ]
        }
    });
</script>
@endsection
