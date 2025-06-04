<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomSession extends Model
{
    use HasFactory;
protected $fillable=[
    'session_year',
    'created_date',
    'is_selected'
];
    //
}
