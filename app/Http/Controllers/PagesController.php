<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ICOQuarter;
use App\Models\ICOIncidentCount;
use App\Models\ICOCategory;
use App\Models\ICOBody;

class PagesController extends Controller
{
  public function PrivacyPolicy()
  {
     return view('privacy');
  }

}
