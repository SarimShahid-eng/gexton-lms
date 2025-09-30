<?php

namespace App\Livewire;

use App\Models\EnrollStudent;
use Illuminate\Support\Arr;
use Livewire\Component;

class EnrollStudentGenderChart extends Component
{
    // Public properties to hold data for initial render
    public $chartLabels = ['Male', 'Female', 'Transgender'];

    public $chartData = [0, 0, 0];

    public $chartBackgrounds = ['#4BC0C0', '#FF6384', '#FFCE56'];

    public $filters = [];

    // Livewire 3 listener syntax
    protected $listeners = ['filtersUpdated' => 'updateFilters'];

    public function mount($filters = [])
    {
        $this->filters = $filters;
        $this->loadData();
    }

    public function updateFilters($filters)
    {
        $this->filters = $filters;
        $this->loadData(true); // Indicate update for dispatching event
    }

    public function loadData($isUpdate = false)
    {
        $baseQuery = EnrollStudent::query()
            ->where('cancel_enrollment', 0)
            ->when(Arr::get($this->filters, 'study_center'), function ($q, $center) {
                $q->whereHas('registered_student', fn ($sub) => $sub->where('preferred_study_center', $center));
            })
            ->when(Arr::get($this->filters, 'highest_qualification'), function ($q, $highest_qualification) {
                $q->whereHas('registered_student', fn ($sub) => $sub->where('highest_qualification', $highest_qualification));
            })
               ->when(Arr::get($this->filters, 'time_slot'), function ($q, $time_slot) {
                $q->whereHas('registered_student', fn ($sub) => $sub->where('preferred_time_slot', $time_slot));
            })
            ->when(Arr::get($this->filters, 'domicile'), function ($q, $domicile) {
                $q->whereHas('registered_student', fn ($sub) => $sub->where('domicile_category', $domicile));
            })
            ->when(Arr::get($this->filters, 'age_group'), function ($q, $age_group) {
                if (isset($age_group['from'])) {
                    $q->where('date_of_birth', '>=', $age_group['from']);
                }
                if (isset($age_group['to'])) {
                    $q->where('date_of_birth', '<=', $age_group['to']);
                }
            })

            ->when(Arr::get($this->filters, 'gender'), function ($q, $gender) {
                $q->whereHas('registered_student', fn ($sub) => $sub->where('gender', $gender));
            })
            ->when(Arr::get($this->filters, 'batch_id'), function ($q, $batch_id) {
                $q->whereHas('enroll_student.campus', fn ($sub) => $sub->where('id', $batch_id));
            })
            ->when(Arr::get($this->filters, 'course'), function ($q, $course) {
                $q->whereHas('enroll_student', fn ($sub) => $sub->where('course_id', $course));
            });

        $maleCount = (clone $baseQuery)->where('gender', 'male')->count();
        $femaleCount = (clone $baseQuery)->where('gender', 'female')->count();
        $transgenderCount = (clone $baseQuery)->where('gender', 'transgender')->count();

        $this->chartData = [$maleCount, $femaleCount, $transgenderCount];

        if ($isUpdate) {
            // Dispatch a single event with the complete structure
            $this->dispatch('chartDataUpdated',
                labels: $this->chartLabels,
                data: $this->chartData,
                backgrounds: $this->chartBackgrounds
            );
        }
    }

    public function render()
    {
        return view('livewire.enroll-student-gender-chart', [
            'initialLabels' => $this->chartLabels,
            'initialData' => $this->chartData,
            'initialBackgrounds' => $this->chartBackgrounds,
        ]);
    }
}
