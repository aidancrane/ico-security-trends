<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ICOCategory extends Model
{
    use HasFactory;

    protected $table = 'ico_categories';

    protected $fillable =
    [
      'category',
      'sub_category',
      'definition'
    ];

}
