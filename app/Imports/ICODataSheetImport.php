<?php

namespace App\Imports;

use App\Models\ICOQuarter;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ICODataSheetImport implements ToCollection
{


  public function collection(Collection $rows)
  {
      foreach ($rows as $row)
      {
          dd($row);
      }
  }
}
