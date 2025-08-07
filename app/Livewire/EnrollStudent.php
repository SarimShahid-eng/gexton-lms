<?php

namespace App\Livewire;

use App\Models\Batch;
use App\Models\Campus;
use App\Models\Course;
use App\Models\EnrollStudentDetail;
use App\Models\User;
use App\Models\EnrollStudent as EnrollStudentModel;
use Livewire\Component;
use Livewire\WithPagination;

class EnrollStudent extends Component
{
    use WithPagination;

    public $full_name, $father_name, $gender, $cnic_number, $contact_number, $date_of_birth,
    $profile_picture, $intermediate_marksheet, $domicile_form_c,
    $domicile_district, $university_name, $search = '', $enrolledDetails = [], $campuses = [], $batches = [], $courses = [], $student_id, $campus_ids = [], $batch_ids = [], $course_ids = [], $student_details = [];
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function mount()
    {
        $this->campuses = Campus::get();
    }
    public function render()
    {
        $students = User::where('user_type', 'student')
            ->where('is_active', '1')
            ->where(function ($query) {
                $query->where('full_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.enroll-student', compact('students'));
    }
    public function updatedCampusIds($value, $index)
    {
        $this->campus_ids[$index] = $value ? (int) $value : null;
        $this->batch_ids[$index] = null;
        $this->course_ids[$index] = null;
        $this->batches[$index] = collect();
        $this->courses[$index] = collect();

        if ($value) {
            $this->batches[$index] = Batch::where('campus_id', (int) $value)
                ->where('status', 1)
                ->get();
        }
    }

    public function updatedBatchIds($value, $index)
    {
        $this->batch_ids[$index] = $value ? (int) $value : null;
        $this->course_ids[$index] = null;
        $this->courses[$index] = collect();

        if ($value) {
            $this->courses[$index] = Course::where('batch_id', (int) $value)->get();
        }
    }
    public function updatedCourseIds($value, $index)
    {
        $this->course_ids[$index] = $value ? (int) $value : null;
    }
    function view_student($id)
    {
        // dd($id);
        $student = EnrollStudentModel::with([
            'enroll_student.campus',
            'enroll_student.batch',
            'enroll_student.course'
        ])->where('student_id', $id)->first();
        $this->full_name = $student->student->full_name;
        $this->father_name = $student->father_name;
        $this->gender = $student->gender;
        $this->cnic_number = $student->cnic_number;
        $this->contact_number = $student->contact_number;
        $this->date_of_birth = $student->date_of_birth;
        $this->profile_picture = $student->profile_picture;
        $this->intermediate_marksheet = $student->intermediate_marksheet;
        $this->domicile_form_c = $student->domicile_form_c;
        $this->domicile_district = $student->domicile_district;
        $this->university_name = $student->university_name;

        $this->enrolledDetails = $student->enroll_student;

        // dd($student);
        $this->dispatch('open-task-view-modal');

    }
    public function enroll_student($id)
    {
        $this->reset(['campus_ids', 'batch_ids', 'course_ids', 'batches', 'courses', 'full_name', 'father_name', 'cnic_number', 'student_id']);

        $student_data = EnrollStudentModel::with('student')->where('student_id', $id)->first();
        $this->student_details = EnrollStudentDetail::where('student_id', $id)->get()->toArray();
        // dd($student_data);
        if ($student_data) {
            $this->full_name = $student_data->student->full_name;
            $this->father_name = $student_data->father_name;
            $this->cnic_number = $student_data->cnic_number;
            $this->student_id = $student_data->student_id;
        }

        foreach ($this->student_details as $index => $detail) {
            $this->campus_ids[$index] = $detail['campus_id'];
            $this->batch_ids[$index] = $detail['batch_id'];
            $this->course_ids[$index] = $detail['course_id'];

            // Populate batches for this campus_id
            $this->batches[$index] = $this->campus_ids[$index]
                ? Batch::where('campus_id', $this->campus_ids[$index])
                    ->where('status', 1)
                    ->get()
                : collect();

            // Populate courses for this batch_id
            $this->courses[$index] = $this->batch_ids[$index]
                ? Course::where('batch_id', $this->batch_ids[$index])->get()
                : collect();
        }

        $this->dispatch('open-enrol-view-modal');
    }
    public function updateStudent()
    {
        try {

            $this->validate([
                'campus_ids.*' => 'required|exists:campuses,id',
                'batch_ids.*' => 'nullable|exists:batches,id',
                'course_ids.*' => 'nullable|exists:courses,id',
            ]);

            // dd($this->student_id);
            // Process each campus_id
            foreach ($this->campus_ids as $index => $campus_id) {
                if (!empty($campus_id)) {
                    // Cast all IDs to integers
                    $campus_id = (int) $campus_id;
                    $batch_id = isset($this->batch_ids[$index]) ? (int) $this->batch_ids[$index] : null;
                    $course_id = isset($this->course_ids[$index]) ? (int) $this->course_ids[$index] : null;

                    // Find existing enrollment by student_id and campus_id
                    $enrollDetail = EnrollStudentDetail::where('student_id', (int) $this->student_id)
                        ->where('campus_id', $campus_id)
                        ->first();

                    if ($enrollDetail) {
                        // Update existing record
                        $enrollDetail->update([
                            'campus_id' => $campus_id,
                            'batch_id' => $batch_id,
                            'course_id' => $course_id,
                        ]);
                    }
                }
            }
            // Dispatch success events
            $this->dispatch('close-enrol-view-modal');
            $this->dispatch(
                'student-update',
                title: 'Success!',
                text: 'User Course Updated.',
                icon: 'success',
            );
        } catch (\Exception $e) {
            \Log::error('Error updating student enrollment: ' . $e->getMessage());
            $this->dispatch(
                'student-update',
                title: 'Error!',
                text: 'An error occurred while updating enrollment.',
                icon: 'error',
            );
        }
    }
}
