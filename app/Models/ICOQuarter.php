<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICOQuarter extends Model
{
    use HasFactory;

    protected $table = 'ico_quarters';

    protected $fillable =
    [
      'data_range_start',
      'data_range_end',
      'quarter_1234'
    ];
}
