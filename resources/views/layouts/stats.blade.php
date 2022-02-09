@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row h-75">
        <div class="col-sm-2">
            <ol class="list-group mt-4">
                <a href="/" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"><span class="mdi mdi-arrow-left-thin"></span> Back</div>
                    </div>
                </a>
                <a href="/uk-ico-annual-year-totals" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Total Incidents</div>
                    </div>
                </a>
                <a href="/uk-ico-quarterly-year-totals" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Quarterly Total Incidents</div>
                    </div>
                </a>
                <a href="/uk-ico-incidents-by-category" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Incidents by Category</div>
                    </div>
                </a>
            </ol>
        </div>
        <div class="col-sm-10">
            <div class="py-2">
                @yield('content-right')
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
{{-- <script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script> --}}
@endpush