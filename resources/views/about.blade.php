@extends('layouts.master')

@section('title', 'About')

@section('content')
<div class="container">
    <!-- Current Sessions -->
    <div class="pt-3">
        <div class="row">
            <div class="col">
                <div class="h2 fw-normal np-0 b-0 g-0">
                    About
                </div>
                @include('components.about-blurb')
                <h3>Privacy Policy</h3>
                I use Google Analytics to track user behavior across the website.
                <br>
                To opt out of being tracked by Google Analytics across all websites, visit <a href="http://tools.google.com/dlpage/gaoptout">this link</a>.
                <br>
                <br>
                <a href=" https://support.google.com/analytics/answer/6004245">Read Google's overview of privacy and safeguarding data</a>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
{{-- <script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script> --}}
@endpush