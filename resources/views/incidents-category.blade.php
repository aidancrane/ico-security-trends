@extends('layouts.stats')

@section('title', 'UK ICO Incidents by Category')

@section('content-right')
<div class="container-fluid chart-container">
    <canvas id="chart_incidents_by_category"></canvas>
    <script>
        new Chart(document.getElementById('chart_incidents_by_category'), {
            type: 'bar',
            data: @json($chart),
            options: {
                responsive: true,
                plugins: {
                    title: { display: true, text: 'UK ICO Incidents by Category' },
                    legend: { position: 'top', align: 'start' }
                }
            }
        });
    </script>
    <div class="small text-muted">* {{ $ICOFinalQuarter->data_range_start }} - {{ $ICOFinalQuarter->data_range_end }} may be missing data as it may not have been released yet.
        <div>Check <a href="/">here</a> to see how current the information is.</div>
    </div>
</div>
@stop
