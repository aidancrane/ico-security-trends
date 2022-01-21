<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ICOQuarter;

class LandingController extends Controller
{


  public function Landing()
     {
       // find the highest quarter and lowest quarter imported into the db.
       $highest_q = ICOQuarter::orderBy('data_range_end', 'desc')->orderBy('quarter_1234', 'desc')->first();
       $lowest_q = ICOQuarter::orderBy('data_range_end', 'asc')->orderBy('quarter_1234', 'asc')->first();

       return view('landing')->with('highest_q', $highest_q)->with('lowest_q', $lowest_q);
     }

}
