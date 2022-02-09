@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <!-- Current Sessions -->
    <div class="pt-3">
        <div class="row">
            <div class="col-md-6">
                <div class="lead fw-normal np-0 b-0 g-0">
                    About
                </div>
                <p>This dashboard aims to provide the most up to date Information Comissioners Office security incident trends as reported by government
                    organisations and private companies.</p>

                <p>Data security incidents, which are breaches of the seventh data protection principle or personal data breaches
                    reported under the Privacy and Electronic Communications Regulations are a major concern for those affected.</p>

                <p>The UK Government body, called the Information Comissioners Office publish this information in non-standardised spreadsheets.
                    I have taken the time to format this data so that it has normalised and proper data structure.</p>

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
                                <span class="mdi mdi-license"></span> Alternatively you can read the terms of the licence <a href="https://www.nationalarchives.gov.uk/doc/open-government-licence/version/3/">here</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <p>Data from <b>Q{{ $lowest_q->quarter_1234 }} {{ $lowest_q->data_range_start }}-{{ $lowest_q->data_range_end }}</b>
                    to <b>Q{{ $highest_q->quarter_1234 }} {{ $highest_q->data_range_start }}-{{ $highest_q->data_range_end }}</b>.</p>

            </div>
            <div class="col-md-6">
                <div class="lead fw-normal np-0 b-0 g-0">
                    Explore Security Incident Trends
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
                </ol>
            </div>
        </div>
    </div>
</div>
@stop

@push('scripts')
{{-- <script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/datatables.js') }}"></script> --}}
@endpush