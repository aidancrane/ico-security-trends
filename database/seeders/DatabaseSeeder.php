<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Model\ICOBodies;
use Database\Seeders\ICOBodiesSeeder;
use Database\Seeders\ICOCategoriesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      $this->call([
          ICOBodiesSeeder::class,
          ICOCategoriesSeeder::class,

      ]);
    }
}
