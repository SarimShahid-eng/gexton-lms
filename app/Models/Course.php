<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
     protected $fillable = [
        'title',
        'description',
        'batch_id',
        'campus_id'
    ];
    //
}
