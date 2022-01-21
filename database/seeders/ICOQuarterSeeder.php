<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ICODataSheetImport;
use App\Models\ICOBody;
use App\Models\ICOCategory;
use App\Models\ICOQuarter;
use App\Models\ICOIncidentCount;

class ICOQuarterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */




    public function run()
    {
        $collection = Excel::toCollection(new ICODataSheetImport, 'data\categories.xlsx');

        $quarter_count = 1;
        $start_year = 2019;
        $end_year = 2020;

        // From the 4th sheet to the end.
        for ($x = 3; $x <= (count($collection) - 1); $x++) {
          $this->processAndSeedSheet($collection[$x], "Q" . $quarter_count . " " . $start_year . "-" . $end_year, $quarter_count, $start_year, $end_year); // Q1 2019-2020
          $quarter_count++;

          // If we have surpassed the fourth quarter.
          if ($quarter_count > 4)
          {
            $quarter_count = 1;
            $start_year++;
            $end_year++;
          }

          // Uncomment to check first sheet.
          //$x = count($collection);
        }

    }

    // Loads a single sheet of data into the database.
    public function processAndSeedSheet($collection, $name, $quarter, $start_year, $end_year)
    {

        // Make a new Quarter.
        $current_quarter = new ICOQuarter;
        $current_quarter->data_range_start = $start_year;
        $current_quarter->data_range_end = $end_year;
        $current_quarter->quarter_1234 = $quarter;
        $current_quarter->save();

        $bodies = ICOBody::all();
        $categories = ICOCategory::all();

        // for ($x = 0; $x <= (count($bodies) - 1); $x++) {
        //   echo $bodies[$x]->body_category . "\n";
        // }

        // for each category of data going down the left side.
        for ($y = 0; $y <= (count($categories) - 1); $y++) {

          // Rows with data start at 1, so this is the first row that is not a header.
          // So this is the row B or probably 'Alteration of personal data'.
          $row_of_datum = $collection[$y + 1];

          // for each cell going across the top, starting at id = 1 probably 'Central Government';
          for ($x = 0; $x <= (count($bodies) - 1); $x++) {
            $cell = $row_of_datum[$x + 1];

            if ($cell != null && $cell != 0)
            {
              // A new incident value where its not null or 0.
              // As in, in this quarter in this catergory, this body had $cell incidents.
              $current_incident = new ICOIncidentCount;
              $current_incident->quarter_id = $current_quarter->id;
              $current_incident->ico_body_id = $bodies[$x]->id;
              $current_incident->ico_category_id = $categories[$y]->id;
              $current_incident->incident_count = $cell;
              $current_incident->save();
            }

            // Doing some testing? Uncomment these lines it will help you a tonne.
            if ($cell != null)
            {
                //echo "Category : '" . $categories[$y]->category . "' Body : '" . $bodies[$x]->body_category . "' Value : '" . $cell . "'\n";
            }

          }
        }
    }
}
