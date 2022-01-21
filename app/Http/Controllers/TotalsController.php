<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\ICOQuarter;

class TotalsController extends Controller
{

  public function Totals()
     {
       // find the highest quarter and lowest quarter imported into the db.
       $ICOQuarters = ICOQuarter::all();

       return view('totals')->with('ICOQuarters', $ICOQuarters);
     }

}
