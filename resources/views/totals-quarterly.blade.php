@extends('layouts.stats')

@section('title', 'UK ICO Quarterly Year Totals')

@section('content-right')
<div class="container-fluid chart-container">
    <canvas id="chart_year_total"></canvas>
    <script>
        new Chart(document.getElementById('chart_year_total'), {
            type: 'line',
            data: @json($chart),
            options: {
                responsive: true,
                plugins: {
                    title: { display: true, text: 'UK ICO Quarterly Year Totals' },
                    legend: { position: 'bottom' }
                }
            }
        });
    </script>
    <div class="small text-muted">* {{ $ICOFinalQuarter->data_range_start }} - {{ $ICOFinalQuarter->data_range_end }} may be missing data as it may not have been released yet.
        <div>Check <a href="/">here</a> to see how current the information is.</div>
    </div>
</div>
@stop

@push('scripts')
@endpush