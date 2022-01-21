<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICOBody extends Model
{
    use HasFactory;

    protected $table = 'ico_bodies';

    protected $fillable =
    [
      'body_category',
    ];




}
