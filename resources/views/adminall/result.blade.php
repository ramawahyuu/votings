<!-- resources/views/chart.blade.php -->

@extends('index')

@section('content')
<script src="node_modules/chart.js/dist/chart.min.js"></script>
<div class="container">
    <h2>Vote Result Chart</h2>
    <canvas id="resultChart" width="400" height="200"></canvas>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const data = @json($event);

        // Modify labels to include the position
        const labels = data.map(kandidat => `${kandidat.nama_kandidat} (${kandidat.posisi})`);
        const votes = data.map(kandidat => kandidat.jumlah_suara);

        const ctx = document.getElementById('resultChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Suara',
                    data: votes,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
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