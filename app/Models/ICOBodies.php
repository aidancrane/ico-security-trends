<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICOBodies extends Model
{
    use HasFactory;

    protected $table = 'ico_bodies';

    protected $fillable =
    [
      'body_category',
    ];



    
}
