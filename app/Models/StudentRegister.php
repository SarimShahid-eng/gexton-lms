<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentRegister extends Model
{
    protected $fillable = [
        'full_name',
        'father_name',
        'gender',
        'cnic_number',
        'contact_number',
        'date_of_birth',
        'profile_picture',
        'intermediate_marksheet',
        'domicile_form_c',
        'domicile_district',
        'is_enrolled',
        'university_name',
        'preferred_study_center',
        'preferred_time_slot',
        'course_choice_1',
        'course_choice_2',
        'course_choice_3',
        'course_choice_4',
    ];

}
