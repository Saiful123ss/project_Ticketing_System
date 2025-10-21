@extends('layouts.admin')

@section('content')
<style>
body { background-color: #0d1117; color: #e6edf3; }
.card { background-color: #161b22; border: 1px solid #30363d; border-radius: 12px; padding: 1.5rem; }
</style>

<div class="main-content text-center">
    <h2 class="mb-4">📊 Reports & Analytics</h2>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card">
                <h5 style="color: white;">Tickets by Status</h5>
                <canvas id="statusChart" height="120"></canvas>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <h5 style="color: white;">Tickets by Month</h5>
                <canvas id="monthChart" height="120"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js"></script>
<script>
const statusData = @json(array_values($ticketsByStatus));
const statusLabels = @json(array_keys($ticketsByStatus));
const monthData = @json(array_values($ticketsByMonth));
const monthLabels = @json(array_keys($ticketsByMonth));

new Chart(document.getElementById('statusChart'), {
    type: 'pie',
    data: {
        labels: statusLabels,
        datasets: [{
            data: statusData,
            backgroundColor: ['#1f6feb', '#bb8009', '#238636', '#6e7681'],
        }]
    },
});

new Chart(document.getElementById('monthChart'), {
    type: 'bar',
    data: {
        labels: monthLabels.map(m => 'Month ' + m),
        datasets: [{
            label: 'Tickets Created',
            data: monthData,
            backgroundColor: '#238636'
        }]
    },
    options: { scales: { y: { beginAtZero: true } } }
});
</script>
@endsection
