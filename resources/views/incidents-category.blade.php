@extends('layouts.stats')

@section('title', 'UK ICO Incidents by Category')

@section('content-right')
<div class="container-fluid h-50">

    <div id="chart_incidents_by_category">
        <script>
            const chart = new Chartisan({
                el: '#chart_incidents_by_category',
                url: "@chart('incidents_by_category_chart')",
                hooks: new ChartisanHooks()
                    .title("UK ICO Incidents by Category")
                    .legend({
                        position: 'bottom'
                    })
                    .responsive()
                    .borderColors()
                    .datasets([{
                        type: 'line',
                        fill: false
                    }]),
            })
        </script>
    </div>
    <div id="chart_incidents_by_category_2">
        <script>
            const chart2 = new Chartisan({
                el: '#chart_incidents_by_category_2',
                url: "@chart('incidents_by_category_chart')",
                hooks: new ChartisanHooks()
                    .title("UK ICO Incidents by Category")
                    .legend({
                        position: 'bottom'
                    })
                    .responsive()
                    .borderColors()
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
@endpush