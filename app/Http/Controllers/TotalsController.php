<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ICOQuarter;

class TotalsController extends Controller
{

  public function Totals()
     {
       // find the highest quarter and lowest quarter imported into the db.
       $ICOFinalQuarter = ICOQuarter::orderBy('data_range_start', 'desc')->orderBy('quarter_1234', 'desc')->first();

       return view('totals')->with('ICOFinalQuarter', $ICOFinalQuarter);
     }

}
