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
                <p>I made this page to increase consciousness about security and provide some alternative visualisations of incident data.</p>

                <p>I have tried my best to transpose the data from the spreadsheets provided into a standardised database,
                    however if you spot an inconsistency please open a GitHub issue using the link at the top of the page.</p>

                <h3>Privacy Policy</h3>
                I use Google Analytics to track user behaviour across the website.
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
{{-- No extra scripts :) --}}
@endpush