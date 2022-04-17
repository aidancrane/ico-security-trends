@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <!-- Current Sessions -->
    <div class="pt-3">
        <div class="row">
            <div class="col-md-6">
                <div class="h2 fw-normal np-0 b-0 g-0 pt-2">
                    About
                </div>
                @include('components.about-blurb')
                <div class="alert alert-secondary mt-1 mb-1 py-1" role="alert">
                    <div class="small my-0 py-0">
                        <ul class="list-unstyled my-0 py-0">
                            <li>
                                <span class="mdi mdi-bookmark-box-multiple"></span> Contains public sector information licensed under the Open Government Licence v3.0
                            </li>
                            <li>
                                <span class="mdi mdi-book-search"></span> You can access this information first-hand <a href="https://ico.org.uk/action-weve-taken/data-security-incident-trends/previous-reports/">here</a>
                            </li>
                            <li>
                                <span class="mdi mdi-license"></span> You can read the terms of the OGL v3.0 licence <a href="https://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/">here</a>
                            </li>
                            <li>
                                <span class="mdi mdi-rotate-left"></span> Data from <b>Q{{ $lowest_q->quarter_1234 }} {{ $lowest_q->data_range_start }}-{{ $lowest_q->data_range_end }}</b>
                                to <b>Q{{ $highest_q->quarter_1234 }} {{ $highest_q->data_range_start }}-{{ $highest_q->data_range_end }}</b>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h2 fw-normal np-0 b-0 g-0 pt-2">
                    See Security Incident Trends
                </div>
                <p>Use the links below to view the most recent UK Security Incident Trends by Year or by Category</p>

                <ol class="list-group">
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
                    <a href="/uk-ico-incidents-by-sector" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Incidents by Sector</div>
                        </div>
                    </a>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <div class="h2 fw-normal np-0 b-0 g-0 pt-3">
                        Quick Statistics
                    </div>

                    <ul class="list my-0 py-0">
                        <li>
                            The most prominent cyber incident is categorised as <span title="{{ $most_reported_crime_category->definition }}"><b>{{ $most_reported_crime_category->category }}</b></span>
                        </li>
                        <li>

                            The sector with the most cyber incidents is <span title="{{ $most_reported_crime_body->body_category }}"><b>{{ $most_reported_crime_body->body_category }}</b></span>
                        </li>
                        <li>
                            So far there have been <b>{{ $sum_of_this_years_incidents }}</b> security incidents reported this year * **
                        </li>
                        <li>
                            Last year there were <b>{{ $sum_of_last_years_incidents }}</b> security incidents reported **
                        </li>
                    </ul>

                    <span class="text-secondary"><small><i> ** Data annualised as incidents are reported by quarter, * ~{{ $last_year-1 }}-{{ $last_year }}</i></small></span>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
{{-- <script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script> --}}
@endpush