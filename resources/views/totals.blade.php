@extends('layouts.stats')

@section('title', 'Totals')

@section('content-right')
<div class="container-fluid">
    <!-- Chart's container -->
    <div id="chart"></div>
    <!-- Charting library -->
    {{-- <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script> --}}
    <!-- Chartisan -->
    {{-- <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script> --}}
    <!-- Your application script -->
    <script>
        const chart = new Chartisan({
            el: '#chart',
            url: "@chart('year_on_year_chart')",
        });
    </script>
</div>
@stop

@push('scripts')
{{-- <script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script> --}}
@endpush