<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ICOCategory;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ICODataSheetImport;

class ICOCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            $collection = Excel::toCollection(new ICODataSheetImport, storage_path("/data/categories.xlsx"));
            $categories_sheet = $collection[1];

            // Start at 1 and ignore header.
            // for each category.
            for ($x = 1; $x <= (count($categories_sheet) - 1); $x++) {
                $category_row = $categories_sheet[$x];
                $category = new ICOCategory;
                $category->category = $category_row[1];
                $category->sub_category = $category_row[2];
                $category->definition = $category_row[3];
                $category->save();
            }
    }
}
