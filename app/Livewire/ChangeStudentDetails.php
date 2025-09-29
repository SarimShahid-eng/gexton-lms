<?php

namespace App\Livewire;

use App\Models\Batch;
use App\Models\Campus;
use App\Models\Course;
use Livewire\Component;
// use App\Models\Student;
use Livewire\Attributes\On;
use App\Models\EnrollStudent;
use App\Models\StudentRegister;
use Illuminate\Support\Facades\DB;
use App\Models\EnrollStudentDetail;

class ChangeStudentDetails extends Component
{
    public $show = false;

    public $ids = [];

    public $campuses = [];

    public $batches = [];

    public $courses = [];

    public $campus_id;

    public $batch_id;

    public $course_id;

    public $preferred_study_center;

    public $preferred_time_slot;

    #[On('open-change-details-modal')]
    public function open($ids)
    {
        $this->ids = $ids;
        $this->show = true;
    }

    public function updatedCampusId($value)
    {
        $this->batches = Batch::where('campus_id', $value)->get();
        $this->batch_id = null;
        $this->courses = [];
        $this->course_id = null;
    }

    // when batch changes
    public function updatedBatchId($value)
    {
        $this->courses = Course::where('batch_id', $value)->get();
        $this->course_id = null;
    }

    public function save()
    {
        // $this->validate([
        //     'preferred_study_center' => 'required',
        //     'preferred_time_slot' => 'required',
        //     'campus_id' => 'required|exists:campuses,id',
        //     'batch_id' => 'required|exists:batches,id',
        //     'course_id' => 'required|exists:courses,id',
        // ], [
        //     'campus_id.required' => 'The campus field is required.',
        //     'batch_id.required' => 'The batch field is required.',
        //     'course_id.required' => 'The course field is required.',
        // ]);

          DB::transaction(function () {
        // 👇 Conditional validation
        if ($this->campus_id) {
            // 1️⃣ Validate campus/batch/course scenario
            $this->validate([
                'campus_id' => 'required|exists:campuses,id',
                'batch_id'  => 'required|exists:batches,id',
                'course_id' => 'required|exists:courses,id',
            ], [
                'campus_id.required' => 'The campus field is required.',
                'batch_id.required'  => 'The batch field is required.',
                'course_id.required' => 'The course field is required.',
            ]);

            // 2️⃣ Update EnrollStudentDetail records
            EnrollStudentDetail::whereIn('student_id', $this->ids['ids'])->update([
                'campus_id' => $this->campus_id,
                'batch_id'  => $this->batch_id,
                'course_id' => $this->course_id,
            ]);
        } else {
            // 3️⃣ Validate study center/time slot scenario
            $this->validate([
                'preferred_study_center' => 'required',
                'preferred_time_slot'    => 'required',
            ]);

            // 4️⃣ Pull CNICs from EnrollStudentDetails
            $cnics = EnrollStudent::whereIn('student_id', $this->ids['ids'])
                ->pluck('cnic_number') // make sure this column exists here
                ->filter()
                ->unique();

            // 5️⃣ Update StudentRegister rows
            StudentRegister::whereIn('cnic_number', $cnics)->update([
                'preferred_time_slot'    => $this->preferred_time_slot,
                'preferred_study_center' => $this->preferred_study_center,
            ]);
        }
    });



        $this->show = false;

        $this->dispatch(
            'toast',
            title: 'Student Has Been Updated Successfully.',
            icon: 'success',
        );
    }

    public function mount()
    {
        $this->campuses = Campus::all();
        $this->batches = [];
        $this->courses = [];
    }

    public function render()
    {
        return view('livewire.change-student-details');
    }
}
