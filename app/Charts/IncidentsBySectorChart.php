<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\ICOQuarter;
use App\Models\ICOIncidentCount;
use App\Models\ICOCategory;
use App\Models\ICOBody;


class IncidentsBySectorChart extends BaseChart
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

            // We used to get years from db at 1 query a year, but that is expensive in round trips, so lets shorten it.

            // this converts array and array keys being all over the place to a simple array.
            $years = array_values($years->toArray());


            // Convert a list of years to a list of labels for the graph.

            $year_labels = [];
            for ($x = 0; $x <= (count($years) - 1); $x++) {
                $year = $years[$x];
                array_push($year_labels, strval($year) . " - " . strval($year + 1));
            }

            // Now with a list of years for each year, get a list of incidents.

            // for ($x = 0; $x <= ($years->count() - 1); $x++) {
            //     $year = $years->values()->get($x);
            //     $this_years_quarters = ICOQuarter::where('data_range_start', $year)->get();
            //     $this_years_incidents = collect([]);
            //     foreach ($this_years_quarters as $quarter) {
            //       $this_years_incidents = $this_years_incidents->concat($quarter->ICOIncidents()->get());
            //     }
            //                                 NOT NEEDED
            // }

            //Get a list of categories,
            $ico_bodies = ICOBody::all();

            // Build a chart to start off with our data labels.
            $chart = Chartisan::build()->labels($year_labels);


            // bodies_for_datasets Array
            $bodies_for_datasets = collect([]);

            // populate our categories_for_datasets with the names of the categories_for_datasets.
            for ($y = 0; $y <= ($ico_bodies->count() - 1); $y++) {
              $this_body = $ico_bodies->values()->get($y);
                $key = $this_body->id;
                // Category name is required for the graph.
                // Category ID is required for adding missing year entries.
                $bodies_for_datasets[$key] = ['body_name' => $this_body->body_category, 'body_id' => $this_body->id];
              }

            // For each year. Q1234 inclusive (could be next year).
            for ($x = 0; $x <= (count($years) - 1); $x++) {
              // Get current year.
              $year = $years[$x];

              // Get a list of incident counts, in this year.
              $this_years_quarters = ICOQuarter::with('ICOIncidents')->where('data_range_start', $year)->get();
              //dd($this_years_quarters[1]->ICOIncidents()->get());

              //$this_years_incidents = collect([]);


              for ($y = 0; $y <= ($this_years_quarters->count() - 1); $y++) {
                  //$this_years_incidents = $this_years_incidents->concat($quarter->ICOIncidents()->get());
                  $this_quarter = $this_years_quarters->values()->get($y);
                  $this_quarter_incidents = $this_quarter->ICOIncidents()->get();

                  $this_quarter_incidents = collect($this_quarter_incidents->toArray());

                  //dd($this_quarter_incidents);

                  for ($z = 0; $z <= ($this_quarter_incidents->count() - 1); $z++) {
                      $this_incident = $this_quarter_incidents->values()->get($z);
                      //dd($this_incident);
                      $this_incident_body_id = $this_incident['ico_body_id'];
                      $current_dataset = $bodies_for_datasets[$this_incident_body_id];

                      if(isset($current_dataset[$year])){
                        //dd("Year already has an entry, needs appending.");
                        $current_dataset[$year] = $current_dataset[$year] + $this_incident['incident_count'];
                      }
                      else {
                        // Year doesn't have an entry for this.
                        $current_dataset[$year] = $this_incident['incident_count'];
                      }
                      $bodies_for_datasets[$this_incident_body_id] = $current_dataset;
                  }


              }

              //$chart = $chart->dataset($data_categories->values()->get($x), [1, 2, 3]);
            }





            // We now have all of the values out of the database, but we may have a whole Q1234 where there
            // were no reported incidents for a particular category, so we need to account for that.
            for ($y = 0; $y <= ($bodies_for_datasets->count() - 1); $y++) {
              $current_dataset = $bodies_for_datasets->values()->get($y);
              // Iterate through known years for missing years.
              // Missing years are years with no entry for this category.
              for ($x = 0; $x <= (count($years) - 1); $x++) {


                $year = $years[$x];
                if(!isset($current_dataset[$year])){
                  // This category is not present this year, or no incidents were recorded for this year.
                  $current_dataset[$year] = 0;
                  $bodies_for_datasets[$current_dataset["body_id"]] = $current_dataset;
                }
              }
            }

            for ($x = 0; $x <= ($bodies_for_datasets->count() - 1); $x++) {
              $current_dataset = $bodies_for_datasets->values()->get($x);

              $body_values = [];

              for ($y = 0; $y <= (count($years) - 1); $y++) {
                  $year = $years[$y];
                  array_push($body_values, $current_dataset[$year]);
              }

              $chart = $chart->dataset($current_dataset["body_name"], $body_values);

            }

            //$chart = $chart->dataset('Sample', [1, 2, 3]);
            //$chart = $chart->dataset('Sample 2', [3, 2, 1]);

            return $chart;

            // echo json_encode($categories_for_datasets);
            //
            // exit();

    }
}
