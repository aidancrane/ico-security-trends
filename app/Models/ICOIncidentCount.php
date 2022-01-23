<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ICOQuarter;

class ICOIncidentCount extends Model
{
    use HasFactory;

    protected $table = 'ico_incident_count';

    protected $fillable =
    [
      'quarter_id',
      'ico_body_id',
      'ico_category_id',
      'incident_count'
    ];

    public function quarter()
    {
        return $this->belongsTo(ICOQuarter::class, 'quarter_id', 'id');
    }

}
