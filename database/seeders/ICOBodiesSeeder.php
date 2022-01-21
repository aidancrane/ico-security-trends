<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ICOBody;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ICODataSheetImport;

class ICOBodiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      // Probably a better way to do this.

      $collection = Excel::toCollection(new ICODataSheetImport, 'data\categories.xlsx');
      $bodies_sheet = $collection[2];

      $bodies = [];

      // For each row in bodies sheet,
      // ignoring first row.
      for ($x = 1; $x <= (count($bodies_sheet) - 1); $x++) {
              array_push($bodies, $bodies_sheet[$x][1]);
      }

      for ($x = 0; $x <= (count($bodies) - 1); $x++) {
        $body = new ICOBody;
        $body->body_category = $bodies[$x];
        $body->save();
      }

    }
}
