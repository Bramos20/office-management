@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Key Performance Indicators (KPIs)</h2>
    
    <canvas id="kpiChart" width="400" height="200"></canvas>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Employee</th>
                <th>KPI Name</th>
                <th>Target Value</th>
                <th>Actual Value</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kpis as $kpi)
                <tr>
                    <td>{{ $kpi->employee->name }}</td>
                    <td>{{ $kpi->kpi_name }}</td>
                    <td>{{ $kpi->target_value }}</td>
                    <td>{{ $kpi->actual_value ?? 'N/A' }}</td>
                    <td>{{ ucfirst($kpi->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('kpiChart').getContext('2d');
        
        var chartData = @json($chartData);

        var labels = chartData.map(item => `${item.employee} - ${item.kpi_name}`);
        var targetValues = chartData.map(item => item.target_value);
        var actualValues = chartData.map(item => item.actual_value);

        var kpiChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Target Value',
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        data: targetValues
                    },
                    {
                        label: 'Actual Value',
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        data: actualValues
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

@endsection
