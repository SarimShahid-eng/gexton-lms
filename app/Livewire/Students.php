<?php

namespace App\Livewire;

use App\Models\BatchGroup;
use App\Models\User;
use Auth;
use Livewire\Component;

class Students extends Component
{
    public $group_name = '';
    public function render()
    {
        $groups = BatchGroup::where('session_year_id', Auth::user()->session_year_id)
            ->where('teacher_id', Auth::user()->id)->get();

        $students = User::with('student_details')
            ->whereRelation('student_details', 'teacher_id', Auth::user()->id)
            ->whereRelation('student_details', 'result', 'pass')
            ->where('user_type', 'student')
            ->get();

        if ($this->group_name) {
            dd($this->group_name);
            $students->whereRelation('student_details', 'group_id', $this->group_name);
        }
        return view('livewire.students', compact('students', 'groups'));
    }
    public function filterByGroup($value)
    {
        // dd($value);
        $this->group_name = $value;
        // dd($this->group_name);
    }
}
