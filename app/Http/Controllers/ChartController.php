<?php

namespace App\Http\Controllers;

use App\Charts\IncidentsByCategoryChart;
use App\Charts\IncidentsBySectorChart;
use App\Charts\YearOnYearChart;
use App\Charts\YearOnYearChartQuarterly;
use App\Models\ICOQuarter;

class ChartController extends Controller
{

     public function Totals()
     {
        // find the highest quarter and lowest quarter imported into the db.
        $ICOFinalQuarter = ICOQuarter::orderBy('data_range_start', 'desc')->orderBy('quarter_1234', 'desc')->first();

        return view('totals')
            ->with('ICOFinalQuarter', $ICOFinalQuarter)
            ->with('chart', YearOnYearChart::data());
     }

     public function QuarterlyTotals()
     {
        // find the highest quarter and lowest quarter imported into the db.
        $ICOFinalQuarter = ICOQuarter::orderBy('data_range_start', 'desc')->orderBy('quarter_1234', 'desc')->first();

        return view('totals-quarterly')
            ->with('ICOFinalQuarter', $ICOFinalQuarter)
            ->with('chart', YearOnYearChartQuarterly::data());
     }

     public function CategoryTotals()
     {
        // find the highest quarter and lowest quarter imported into the db.
        $ICOFinalQuarter = ICOQuarter::orderBy('data_range_start', 'desc')->orderBy('quarter_1234', 'desc')->first();

        return view('incidents-category')
            ->with('ICOFinalQuarter', $ICOFinalQuarter)
            ->with('chart', IncidentsByCategoryChart::data());
     }

     public function SectorTotals()
     {
        // find the highest quarter and lowest quarter imported into the db.
        $ICOFinalQuarter = ICOQuarter::orderBy('data_range_start', 'desc')->orderBy('quarter_1234', 'desc')->first();

        return view('incidents-sector')
            ->with('ICOFinalQuarter', $ICOFinalQuarter)
            ->with('chart', IncidentsBySectorChart::data());
     }


}