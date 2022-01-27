@extends('layouts.stats')

@section('title', 'UK ICO Incidents by Category')

@section('content-right')
<div class="container-fluid h-75">
    <div id="chart_incidents_by_category"></div>
    <script>
        const chart = new Chartisan({
            el: '#chart_incidents_by_category',
            url: "@chart('incidents_by_category_chart')",
            hooks: new ChartisanHooks()
                .title("UK ICO Incidents by Category")
                .legend({
                    position: 'bottom'
                })
                .responsive(),
        })
    </script>
    <div class="small text-muted">* {{ $ICOFinalQuarter->data_range_start }} - {{ $ICOFinalQuarter->data_range_end }} may be missing data as it may not have been released yet.
        <div>Check <a href="/">here</a> to see how current the information is.</div>
    </div>
</div>
@stop

@push('scripts')
@endpush