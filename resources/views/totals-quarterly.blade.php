@extends('layouts.stats')

@section('title', 'UK ICO Quarterly Year Totals')

@section('content-right')
<div class="container-fluid h-75">
    <div id="chart_year_total"></div>
    <script>
        const chart = new Chartisan({
            el: '#chart_year_total',
            url: "@chart('year_on_year_chart_quarterly')",
            hooks: new ChartisanHooks()
                .title("UK ICO Quarterly Year Totals")
                .colors()
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