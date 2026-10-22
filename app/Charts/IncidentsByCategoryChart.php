<?php

declare(strict_types = 1);

namespace App\Charts;

use App\Models\ICOQuarter;
use App\Models\ICOCategory;

class IncidentsByCategoryChart
{
    /**
     * Returns chart data (labels + datasets) for incidents by category.
     */
    public static function data(): array
    {
        // Get a list of all years.
        $data_range_start_labels = ICOQuarter::orderBy('data_range_start', 'asc')->orderBy('quarter_1234', 'asc')->pluck('data_range_start');
        $years = $data_range_start_labels->unique();

        // This converts the array, with keys all over the place, into a simple array.
        $years = array_values($years->toArray());

        // Convert a list of years to a list of labels for the graph.
        $year_labels = [];
        for ($x = 0; $x <= (count($years) - 1); $x++) {
            $year = $years[$x];
            array_push($year_labels, strval($year) . " - " . strval($year + 1));
        }

        // Get a list of categories.
        $data_categories = ICOCategory::all();

        // categories_for_datasets: category_id => ['category_name' => ..., 'category_id' => ..., year => count, ...]
        $categories_for_datasets = collect([]);

        for ($y = 0; $y <= ($data_categories->count() - 1); $y++) {
            $this_category = $data_categories->values()->get($y);
            $key = $this_category->id;
            // Category name is required for the graph.
            // Category ID is required for adding missing year entries.
            $categories_for_datasets[$key] = ['category_name' => $this_category->category, 'category_id' => $this_category->id];
        }

        // For each year (Q1234 inclusive, could be next year).
        for ($x = 0; $x <= (count($years) - 1); $x++) {
            $year = $years[$x];

            // Get a list of incident counts, in this year.
            $this_years_quarters = ICOQuarter::with('ICOIncidents')->where('data_range_start', $year)->get();

            for ($y = 0; $y <= ($this_years_quarters->count() - 1); $y++) {
                $this_quarter = $this_years_quarters->values()->get($y);
                $this_quarter_incidents = $this_quarter->ICOIncidents()->get();
                $this_quarter_incidents = collect($this_quarter_incidents->toArray());

                for ($z = 0; $z <= ($this_quarter_incidents->count() - 1); $z++) {
                    $this_incident = $this_quarter_incidents->values()->get($z);
                    $this_incident_category_id = $this_incident['ico_category_id'];
                    $current_dataset = $categories_for_datasets[$this_incident_category_id];

                    if (isset($current_dataset[$year])) {
                        // Year already has an entry, needs appending.
                        $current_dataset[$year] = $current_dataset[$year] + $this_incident['incident_count'];
                    } else {
                        // Year doesn't have an entry for this.
                        $current_dataset[$year] = $this_incident['incident_count'];
                    }
                    $categories_for_datasets[$this_incident_category_id] = $current_dataset;
                }
            }
        }

        // We now have all of the values out of the database, but we may have a whole Q1234 where there
        // were no reported incidents for a particular category, so we need to account for that.
        for ($y = 0; $y <= ($categories_for_datasets->count() - 1); $y++) {
            $current_dataset = $categories_for_datasets->values()->get($y);
            // Iterate through known years for missing years.
            for ($x = 0; $x <= (count($years) - 1); $x++) {
                $year = $years[$x];
                if (!isset($current_dataset[$year])) {
                    // This category is not present this year, or no incidents were recorded for this year.
                    $current_dataset[$year] = 0;
                    $categories_for_datasets[$current_dataset["category_id"]] = $current_dataset;
                }
            }
        }

        $datasets = [];
        for ($x = 0; $x <= ($categories_for_datasets->count() - 1); $x++) {
            $current_dataset = $categories_for_datasets->values()->get($x);

            $category_values = [];
            for ($y = 0; $y <= (count($years) - 1); $y++) {
                $year = $years[$y];
                array_push($category_values, $current_dataset[$year]);
            }

            array_push($datasets, ['label' => $current_dataset["category_name"], 'data' => $category_values]);
        }

        return [
            'labels' => $year_labels,
            'datasets' => $datasets,
        ];
    }
}