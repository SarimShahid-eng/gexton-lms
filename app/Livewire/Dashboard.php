<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Course;
use Livewire\Component;
use App\Models\BatchGroup;
use Illuminate\Support\Facades\Cache;

class Dashboard extends Component
{
    public $studentsCount,
        $teachersCount,
        $coursesCount,
        $groupsCount;
    public function render()
    {
        $this->studentsCount = Cache::remember('dashboard_students_count', now()->addMinutes(3), function () {
            return User::where('user_type', 'student')->count();
        });

        $this->teachersCount = Cache::remember('dashboard_teachers_count', now()->addMinutes(3), function () {
            return User::where('user_type', 'teacher')->count();
        });

        $this->coursesCount = Cache::remember('dashboard_courses_count', now()->addMinutes(3), function () {
            return Course::count();
        });

        $this->groupsCount = Cache::remember('dashboard_groups_count', now()->addMinutes(3), function () {
            return BatchGroup::count();
        });

        return view('livewire.dashboard');
    }
}
