<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\ICOQuarter;
use App\Models\ICOIncidentCount;
use App\Models\ICOCategory;

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

      for ($x = 0; $x <= ($years->count() - 1); $x++) {
          $year = $years->values()->get($x);
          $this_years_quarters = ICOQuarter::where('data_range_start', $year)->get();
          $this_years_incidents = collect([]);
          foreach ($this_years_quarters as $quarter) {
            $this_years_incidents = $this_years_incidents->concat($quarter->ICOIncidents()->get());
          }

      }

      //Get a list of categories,
      $data_categories = ICOCategory::all();


      // Build a chart to start off with our data labels.
      $chart = Chartisan::build()->labels($year_labels);


      // categories_for_datasets Array
      $categories_for_datasets = collect([]);

      // populate our categories_for_datasets with the names of the categories_for_datasets.
      for ($y = 0; $y <= ($data_categories->count() - 1); $y++) {
        $this_category = $data_categories->values()->get($y);
          $key = $this_category->id;
          // Category name is required for the graph.
          // Category ID is required for adding missing year entries.
          $categories_for_datasets[$key] = ['category_name' => $this_category->category, 'category_id' => $this_category->id];
        }

      // For each year. Q1234 inclusive (could be next year).
      for ($x = 0; $x <= ($years->count() - 1); $x++) {
        $year = $years->values()->get($x);

        // Get a list of incident counts, in this year.
        $this_years_quarters = ICOQuarter::with('ICOIncidents')->where('data_range_start', $year)->get();
        //dd($this_years_quarters[1]->ICOIncidents()->get());

        //$this_years_incidents = collect([]);


        for ($y = 0; $y <= ($this_years_quarters->count() - 1); $y++) {
            //$this_years_incidents = $this_years_incidents->concat($quarter->ICOIncidents()->get());
            $this_quarter = $this_years_quarters->values()->get($y);
            $this_quarter_incidents = $this_quarter->ICOIncidents()->get();

            for ($z = 0; $z <= ($this_quarter_incidents->count() - 1); $z++) {
                $this_incident = $this_quarter_incidents->values()->get($z);
                $this_incident_category_id = $this_incident->category->id;
                $current_dataset = $categories_for_datasets[$this_incident_category_id];

                if(isset($current_dataset[$year])){
                  //dd("Year already has an entry, needs appending.");
                  $current_dataset[$year] = $current_dataset[$year] + $this_incident->incident_count;
                }
                else {
                  // Year doesn't have an entry for this.
                  $current_dataset[$year] = $this_incident->incident_count;
                }
                $categories_for_datasets[$this_incident_category_id] = $current_dataset;
            }


        }

        //$chart = $chart->dataset($data_categories->values()->get($x), [1, 2, 3]);
      }


      // We now have all of the values out of the database, but we may have a whole Q1234 where there
      // were no reported incidents for a particular category, so we need to account for that.
      for ($y = 0; $y <= ($categories_for_datasets->count() - 1); $y++) {
        $current_dataset = $categories_for_datasets->values()->get($y);
        // Iterate through known years for missing years.
        // Missing years are years with no entry for this category.
        for ($x = 0; $x <= ($years->count() - 1); $x++) {


          $year = $years->values()->get($x);
          if(!isset($current_dataset[$year])){
            // This category is not present this year, or no incidents were recorded for this year.
            $current_dataset[$year] = 0;
            $categories_for_datasets[$current_dataset["category_id"]] = $current_dataset;
          }
        }
      }

      for ($x = 0; $x <= ($categories_for_datasets->count() - 1); $x++) {
        $current_dataset = $categories_for_datasets->values()->get($x);

        $category_values = [];

        for ($y = 0; $y <= ($years->count() - 1); $y++) {
            $year = $years->values()->get($y);
            array_push($category_values, $current_dataset[$year]);
        }

        $chart = $chart->dataset($current_dataset["category_name"], $category_values);

      }

      //$chart = $chart->dataset('Sample', [1, 2, 3]);
      //$chart = $chart->dataset('Sample 2', [3, 2, 1]);

      return $chart;
    }
}
