<?php

namespace App\Livewire;

use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Batch;
use App\Models\EnrollStudent;
use App\Models\EnrollStudentDetail;
use App\Models\StudentRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ShowStudent extends Component
{
    use WithPagination;
    protected $listeners = ['view_student'];
    public $full_name, $father_name, $gender, $cnic_number, $contact_number, $date_of_birth, $profile_picture, $intermediate_marksheet, $domicile_form_c, $domicile_district, $is_enrolled, $university_name, $enrolled_status, $preferred_study_center, $preferred_time_slot, $course_choice_1, $course_choice_2, $course_choice_3, $course_choice_4,$search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public $campus_id, $batch_id, $course_id, $student_id;
    public $campuses = [], $batches = [], $courses = [];
    public function render()
    {
        $students = StudentRegister::where(function ($query) {
            $query->where('full_name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('cnic_number', 'like', '%' . $this->search . '%')
                  ->orWhere('contact_number', 'like', '%' . $this->search . '%');
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
        // dd($students);
        return view('livewire.show-student', compact('students'));
    }
    public function mount()
    {
        $this->campuses = Campus::get();
    }
    public function view_student($id)
    {
        $student = StudentRegister::find($id);
        $this->full_name = $student->full_name;
        $this->father_name = $student->father_name;
        $this->gender = $student->gender;
        $this->cnic_number = $student->cnic_number;
        $this->contact_number = $student->contact_number;
        $this->date_of_birth = $student->date_of_birth;
        $this->profile_picture = $student->profile_picture;
        $this->intermediate_marksheet = $student->intermediate_marksheet;
        $this->domicile_form_c = $student->domicile_form_c;
        $this->domicile_district = $student->domicile_district;
        $this->is_enrolled = $student->is_enrolled;
        $this->university_name = $student->university_name;
        $this->preferred_study_center = $student->preferred_study_center;
        $this->preferred_time_slot = $student->preferred_time_slot;
        $this->course_choice_1 = $student->course_choice_1;
        $this->course_choice_2 = $student->course_choice_2;
        $this->course_choice_3 = $student->course_choice_3;
        $this->course_choice_4 = $student->course_choice_4;

        $this->dispatch('open-task-view-modal');

    }
    public function updatedCampusId($value)
    {
        $this->batches = Batch::where('campus_id', $value)->where('status', 1)->get();
        $this->batch_id = null;
        $this->courses = [];
        $this->course_id = null;
    }

    public function updatedBatchId($value)
    {
        $this->courses = Course::where('batch_id', $value)->get();
        $this->course_id = null;
    }
    public function enroll_student($id)
    {
        $this->reset(['campus_id', 'batch_id', 'course_id', 'batches', 'courses']);
        $this->reset();
        $this->campuses = Campus::get();
        $student = StudentRegister::find($id);
        // dd($student);
        $this->full_name = $student->full_name;
        $this->father_name = $student->father_name;
        $this->cnic_number = $student->cnic_number;
        $this->student_id = $student->id;
        $this->dispatch('open-enrol-view-modal');
    }
    public function enrollStudent($id)
    {
        $validated = $this->validate([
            'campus_id' => 'required',
            'batch_id' => 'required',
            'course_id' => 'required',
        ], [
            'campus_id.required' => 'Campus field is required.',
            'batch_id.required' => 'Batch field is required.',
            'course_id.required' => 'Course field is required.',
        ]);

        $student = StudentRegister::findOrFail($id);
        //User
        $user = User::create([
            'full_name' => $student->full_name,
            'email' => $student->email,
            'phone' => $student->contact_number,
            'password' => bcrypt($student->cnic_number),
            'is_active' => '1',
            'user_type' => 'student',
        ]);

        // EnrollStudent
        EnrollStudent::create([
            'student_id' => $user->id,
            'father_name' => $student->father_name,
            'gender' => $student->gender,
            'cnic_number' => $student->cnic_number,
            'contact_number' => $student->contact_number,
            'date_of_birth' => $student->date_of_birth,
            'profile_picture' => $student->profile_picture,
            'intermediate_marksheet' => $student->intermediate_marksheet,
            'domicile_form_c' => $student->domicile_form_c,
            'domicile_district' => $student->domicile_district,
            'university_name' => $student->university_name,
        ]);
        // EnrollStudentDetail
        EnrollStudentDetail::create([
            'student_id' => $user->id,
            'campus_id' => $this->campus_id,
            'batch_id' => $this->batch_id,
            'course_id' => $this->course_id,
        ]);
        $student->enrolled_status = 1;
        $student->save();
        $this->dispatch('close-enrol-view-modal');
        $this->dispatch(
            'student-saved',
            title: 'Success!',
            text: "User Enrolled Successfully.",
            icon: 'success',
        );

    }
    public function export()
    {
        return Excel::download(new StudentsExport, 'students.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv'
        ]);
            Excel::import(new StudentsImport, $request->file('file'));
            $message = "Import Has Successfully.";


        $this->dispatch(
            'student-saved',
            title: 'Success!',
            text: $message,
            icon: 'success',
        );
        sleep(1);

        return redirect()->route('show_students');

    }


}
