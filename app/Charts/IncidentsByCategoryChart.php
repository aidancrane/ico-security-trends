<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\ICOQuarter;

class IncidentsByCategoryChart extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {

      //Get a list of all years.
      $data_range_start_labels = ICOQuarter::orderBy('data_range_start', 'asc')->orderBy('quarter_1234', 'asc')->pluck('data_range_start');
      $years = $data_range_start_labels->unique();


      // Convert a list of years to a list of labels for the graph.

      $year_labels = [];
      for ($x = 0; $x <= ($years->count() - 1); $x++) {
          $year = $years->values()->get($x);
          array_push($year_labels, strval($year) . " - " . strval($year + 1));
      }


      // Now with a list of years for each year, get a list of incidents.

        return Chartisan::build()
            ->labels($year_labels)
            ->dataset('Sample', [1, 2, 3])
            ->dataset('Sample 2', [3, 2, 1]);
    }
}
