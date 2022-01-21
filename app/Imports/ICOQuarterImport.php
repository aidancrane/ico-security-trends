<?php

namespace App\Imports;

use App\Models\ICOQuarter;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\ToCollection;

class ICOQuarterImport implements WithMultipleSheets, ToCollection
{


  public function sheets(): array
     {
       return [
           2 => new SheetImport(),
       ];
     }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function SheetImport(Collection $rows)
    {
      //
    }


    public function onUnknownSheet($sheetName)
    {
    // E.g. you can log that a sheet was not found.
    info("Sheet {$sheetName} was skipped");
    }

}
