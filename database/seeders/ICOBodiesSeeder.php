<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ICOBody;

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

      $bodies =
      [
        'Central Government',
        'Charitable and voluntary',
        'Education and childcare',
        'Finance, insurance and credit',
        'General business',
        'Health',
        'Justice',
        'Land or property services',
        'Legal',
        'Local government',
        'Marketing',
        'Media',
        'Membership association',
        'Online Technology and Telecoms',
        'Political',
        'Regulators',
        'Religious',
        'Retail and manufacture',
        'Social care',
        'Transport and leisure',
        'Utilities',
        'Unassigned'
      ];

      for ($x = 0; $x <= (count($bodies) - 1); $x++) {
        $body = new ICOBody;
        $body->body_category = $bodies[$x];
        $body->save();
      }

    }
}
