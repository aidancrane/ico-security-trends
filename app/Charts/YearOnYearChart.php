<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\ICOQuarter;

class YearOnYearChart
{
    /**
     * Returns chart data (labels + datasets) for the year-on-year totals chart.
     */
    public static function data(): array
    {
        $data_range_start_labels = ICOQuarter::orderBy('data_range_start', 'asc')->orderBy('quarter_1234', 'asc')->pluck('data_range_start');

        // Because there may not be any data for a particular quarter, we need to manually iterate.
        $years = $data_range_start_labels->unique();

        $total_incidents = [];

        foreach ($years as $year) {
            $year_incidents = [];

            $this_quarter1_incidents = ICOQuarter::where('data_range_start', $year)->where('quarter_1234', 1)->first();

            if ($this_quarter1_incidents != null) {
                $this_quarter1_incidents = $this_quarter1_incidents->ICOIncidents()->get();
                $this_quarter1_incidents = $this_quarter1_incidents->pluck('incident_count');
                $q_total = $this_quarter1_incidents->sum();
                array_push($year_incidents, $q_total);
            } else {
                array_push($year_incidents, 0);
            }

            $this_quarter2_incidents = ICOQuarter::where('data_range_start', $year)->where('quarter_1234', 2)->first();

            if ($this_quarter2_incidents != null) {
                $this_quarter2_incidents = $this_quarter2_incidents->ICOIncidents()->get();
                $this_quarter2_incidents = $this_quarter2_incidents->pluck('incident_count');
                $q_total = $this_quarter2_incidents->sum();
                array_push($year_incidents, $q_total);
            } else {
                array_push($year_incidents, 0);
            }

            $this_quarter3_incidents = ICOQuarter::where('data_range_start', $year)->where('quarter_1234', 3)->first();

            if ($this_quarter3_incidents != null) {
                $this_quarter3_incidents = $this_quarter3_incidents->ICOIncidents()->get();
                $this_quarter3_incidents = $this_quarter3_incidents->pluck('incident_count');
                $q_total = $this_quarter3_incidents->sum();
                array_push($year_incidents, $q_total);
            } else {
                array_push($year_incidents, 0);
            }

            $this_quarter4_incidents = ICOQuarter::where('data_range_start', $year)->where('quarter_1234', 4)->first();

            if ($this_quarter4_incidents != null) {
                $this_quarter4_incidents = $this_quarter4_incidents->ICOIncidents()->get();
                $this_quarter4_incidents = $this_quarter4_incidents->pluck('incident_count');
                $q_total = $this_quarter4_incidents->sum();
                array_push($year_incidents, $q_total);
            } else {
                array_push($year_incidents, 0);
            }

            $sum_of_year = array_sum($year_incidents);
            array_push($total_incidents, $sum_of_year);
        }

        $year_labels = [];

        for ($x = 0; $x <= ($years->count() - 1); $x++) {
            $year = $years->values()->get($x);
            array_push($year_labels, strval($year) . " - " . strval($year + 1));
        }

        return [
            'labels' => $year_labels,
            'datasets' => [
                ['label' => 'Year Total', 'data' => $total_incidents],
            ],
        ];
    }
}