@extends('layouts.stats')

@section('title', 'UK ICO Incidents by Sector')

@section('content-right')
<div class="container-fluid h-special">
    <div id="chart_incidents_by_sector">
        <script>
            const chart = new Chartisan({
                el: '#chart_incidents_by_sector',
                url: "@chart('incidents_by_sector_chart')",
                hooks: new ChartisanHooks()
                    .title("UK ICO Incidents by Sector")
                    .legend({
                        position: 'top',
                        align: 'start'
                    })
                    .responsive()
                    .colors()
                    .datasets([{
                        type: 'bar',
                        fill: false
                    }]),
            })
        </script>
    </div>
    <div class="small text-muted">* {{ $ICOFinalQuarter->data_range_start }} - {{ $ICOFinalQuarter->data_range_end }} may be missing data as it may not have been released yet.
        <div>Check <a href="/">here</a> to see how current the information is.</div>
    </div>
</div>
@stop

@push('scripts')
<style>
    .h-special {
        height: 80% !important;
    }
</style>
@endpush