@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row h-75">
        <div class="col-sm-2">
            <ol class="list-group mt-4">
                <a href="/" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Landing Page</div>
                    </div>
                </a>
                <a href="/totals" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Total Incidents</div>
                    </div>
                </a>
                <a href="#2" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Incidents by Category</div>
                    </div>
                </a>
                <a href="#3" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Incidents by Year</div>
                    </div>
                </a>
            </ol>
        </div>
        <div class="col-sm-10">
            @yield('content-right')
        </div>
    </div>
</div>
@stop

@push('scripts')
{{-- <script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script> --}}
@endpush