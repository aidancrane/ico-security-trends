<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\ICOQuarter;
use App\Models\ICOIncidentCount;
use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class YearOnYearChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {

      //$all_q = ICOQuarter::all();

      $data_range_start_labels = ICOQuarter::orderBy('data_range_start', 'asc')->orderBy('quarter_1234', 'asc')->pluck('data_range_start');

      //$data_quarter_labels = ICOIncidentCount::whereRelation('quarter', 'quarter_1234', 1);

      // Because there may not be any data for a particular quarter for a particular category or body, we need to manually iterate.

      $years = $data_range_start_labels->unique();

      $Q1_incidents = [];
      $Q2_incidents = [];
      $Q3_incidents = [];
      $Q4_incidents = [];
      $total_incidents = [];

      foreach ($years as $year) {
        $year_incidents = [];
        $this_quarter1_incidents = ICOQuarter::where('data_range_start', $year)->where('quarter_1234', 1)->first();

        if ($this_quarter1_incidents != null)
        {
            $this_quarter1_incidents = $this_quarter1_incidents->ICOIncidents()->get();
            $this_quarter1_incidents = $this_quarter1_incidents->pluck('incident_count');
            $q_total = $this_quarter1_incidents->sum();
            array_push($Q1_incidents, $q_total);
            array_push($year_incidents, $q_total);
        }
        else {
          array_push($Q1_incidents, 0);
        }

        $this_quarter2_incidents = ICOQuarter::where('data_range_start', $year)->where('quarter_1234', 2)->first();

        if ($this_quarter2_incidents != null)
        {
            $this_quarter2_incidents = $this_quarter2_incidents->ICOIncidents()->get();
            $this_quarter2_incidents = $this_quarter2_incidents->pluck('incident_count');
            $q_total = $this_quarter2_incidents->sum();
            array_push($Q2_incidents, $q_total);
            array_push($year_incidents, $q_total);
        }
        else {
          array_push($Q2_incidents, 0);
        }

        $this_quarter3_incidents = ICOQuarter::where('data_range_start', $year)->where('quarter_1234', 3)->first();

        if ($this_quarter3_incidents != null)
        {
            $this_quarter3_incidents = $this_quarter3_incidents->ICOIncidents()->get();
            $this_quarter3_incidents = $this_quarter3_incidents->pluck('incident_count');
            $q_total = $this_quarter3_incidents->sum();
            array_push($Q3_incidents, $q_total);
            array_push($year_incidents, $q_total);
        }
        else {
          array_push($Q3_incidents, 0);
        }

        $this_quarter4_incidents = ICOQuarter::where('data_range_start', $year)->where('quarter_1234', 4)->first();

        if ($this_quarter4_incidents != null)
        {
            $this_quarter4_incidents = $this_quarter4_incidents->ICOIncidents()->get();
            $this_quarter4_incidents = $this_quarter4_incidents->pluck('incident_count');
            $q_total = $this_quarter4_incidents->sum();
            array_push($Q4_incidents, $q_total);
            array_push($year_incidents, $q_total);
        }
        else {
          array_push($Q4_incidents, 0);
        }

      }

      $sum_of_year = array_sum($year_incidents);
      array_push($total_incidents, $sum_of_year);
      // dd($data_range_start_labels->unique());
      //
      // dd($data_quarter_labels->get());

      //dd($data_range_start_labels->toArray());


        return Chartisan::build()
            ->labels($years->toArray())
            ->dataset('Q1', $Q1_incidents)
            ->dataset('Q2', $Q2_incidents)
            ->dataset('Q3', $Q3_incidents)
            ->dataset('Q4', $Q4_incidents)
            ->dataset('Year Total', $total_incidents);
          //  ->dataset('Sample 2', [3, 2, 1]);
    }
}
