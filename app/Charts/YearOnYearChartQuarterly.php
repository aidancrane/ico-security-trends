<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\ICOQuarter;

class YearOnYearChartQuarterly
{
    /**
     * Returns chart data (labels + datasets) for the quarterly year-on-year chart.
     */
    public static function data(): array
    {
        $data_range_start_labels = ICOQuarter::orderBy('data_range_start', 'asc')->orderBy('quarter_1234', 'asc')->pluck('data_range_start');

        // Because there may not be any data for a particular quarter, we need to manually iterate.
        $years = $data_range_start_labels->unique();

        $Q1_incidents = [];
        $Q2_incidents = [];
        $Q3_incidents = [];
        $Q4_incidents = [];

        foreach ($years as $year) {
            $this_quarter1_incidents = ICOQuarter::where('data_range_start', $year)->where('quarter_1234', 1)->first();

            if ($this_quarter1_incidents != null) {
                $this_quarter1_incidents = $this_quarter1_incidents->ICOIncidents()->get();
                $this_quarter1_incidents = $this_quarter1_incidents->pluck('incident_count');
                array_push($Q1_incidents, $this_quarter1_incidents->sum());
            } else {
                array_push($Q1_incidents, 0);
            }

            $this_quarter2_incidents = ICOQuarter::where('data_range_start', $year)->where('quarter_1234', 2)->first();

            if ($this_quarter2_incidents != null) {
                $this_quarter2_incidents = $this_quarter2_incidents->ICOIncidents()->get();
                $this_quarter2_incidents = $this_quarter2_incidents->pluck('incident_count');
                array_push($Q2_incidents, $this_quarter2_incidents->sum());
            } else {
                array_push($Q2_incidents, 0);
            }

            $this_quarter3_incidents = ICOQuarter::where('data_range_start', $year)->where('quarter_1234', 3)->first();

            if ($this_quarter3_incidents != null) {
                $this_quarter3_incidents = $this_quarter3_incidents->ICOIncidents()->get();
                $this_quarter3_incidents = $this_quarter3_incidents->pluck('incident_count');
                array_push($Q3_incidents, $this_quarter3_incidents->sum());
            } else {
                array_push($Q3_incidents, 0);
            }

            $this_quarter4_incidents = ICOQuarter::where('data_range_start', $year)->where('quarter_1234', 4)->first();

            if ($this_quarter4_incidents != null) {
                $this_quarter4_incidents = $this_quarter4_incidents->ICOIncidents()->get();
                $this_quarter4_incidents = $this_quarter4_incidents->pluck('incident_count');
                array_push($Q4_incidents, $this_quarter4_incidents->sum());
            } else {
                array_push($Q4_incidents, 0);
            }
        }

        $year_labels = [];

        for ($x = 0; $x <= ($years->count() - 1); $x++) {
            $year = $years->values()->get($x);
            array_push($year_labels, strval($year) . " - " . strval($year + 1));
        }

        return [
            'labels' => $year_labels,
            'datasets' => [
                ['label' => 'Q1', 'data' => $Q1_incidents],
                ['label' => 'Q2', 'data' => $Q2_incidents],
                ['label' => 'Q3', 'data' => $Q3_incidents],
                ['label' => 'Q4', 'data' => $Q4_incidents],
            ],
        ];
    }
}