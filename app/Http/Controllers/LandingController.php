<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ICOQuarter;
use App\Models\ICOIncidentCount;
use App\Models\ICOCategory;

class LandingController extends Controller
{


  public function Landing()
     {
       // find the highest quarter and lowest quarter imported into the db.
       $highest_q = ICOQuarter::orderBy('data_range_end', 'desc')->orderBy('quarter_1234', 'desc')->first();
       $lowest_q = ICOQuarter::orderBy('data_range_end', 'asc')->orderBy('quarter_1234', 'asc')->first();

       $most_reported_crime_category = ICOIncidentCount::all()->sum('incident_count');

       //Get a list of categories,
       $data_categories = ICOCategory::all();
       $data_incidents = ICOIncidentCount::all();

       $category_incident_counts_by_id = [];

       for ($y = 0; $y <= ($data_categories->count() - 1); $y++) {
         $this_category = $data_categories->values()->get($y);
         $this_category_id = $this_category->id;

         for ($z = 0; $z <= ($data_incidents->count() - 1); $z++) {
             $this_incident = $data_incidents->values()->get($z);
             //dd($this_incident);
             $this_incident_category_id = $this_incident['ico_category_id'];

             if(isset($category_incident_counts_by_id[$this_incident_category_id])){
                $category_incident_counts_by_id[$this_incident_category_id] = $category_incident_counts_by_id[$this_incident_category_id] + $this_incident['incident_count'];
             }
             else {
               $category_incident_counts_by_id[$this_incident_category_id] = $this_incident['incident_count'];
             }

         }

       }


       $this_years_quarters = ICOQuarter::orderBy('data_range_end', 'asc')->orderBy('quarter_1234', 'asc')->where('data_range_start', '>=' , date("Y") - 1);
       $this_years_incidents = $this_years_quarters->with('ICOIncidents')->get()->pluck('ICOIncidents')->flatten();
       $sum_of_this_years_incidents = $this_years_incidents->sum('incident_count');

       $last_years_quarters = ICOQuarter::orderBy('data_range_end', 'asc')->orderBy('quarter_1234', 'asc')->where('data_range_start', '>=' , date("Y") - 2)->where('data_range_start', '<' , date("Y") - 1);
       $last_years_incidents = $last_years_quarters->with('ICOIncidents')->get()->pluck('ICOIncidents')->flatten();
       $sum_of_last_years_incidents = $last_years_incidents->sum('incident_count');


       $most_reported_crime_category_id = array_search(max($category_incident_counts_by_id), $category_incident_counts_by_id);
       $most_reported_crime_category = ICOCategory::where('id', $most_reported_crime_category_id)->first();
       //dd($most_reported_crime_category);
       return view('landing')->with('highest_q', $highest_q)
       ->with('lowest_q', $lowest_q)
       ->with('most_reported_crime_category', $most_reported_crime_category)
       ->with('sum_of_this_years_incidents', $sum_of_this_years_incidents)
       ->with('last_year', date("Y") - 1)
       ->with('sum_of_last_years_incidents', $sum_of_last_years_incidents);
     }

}
