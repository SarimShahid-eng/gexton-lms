<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\EnrollStudent as EnrollStudentModel;
use Livewire\Component;

class EnrollStudent extends Component
{
    public $full_name, $father_name, $gender, $cnic_number, $contact_number, $date_of_birth,
       $profile_picture, $intermediate_marksheet, $domicile_form_c,
       $domicile_district, $university_name;
       public $enrolledDetails = [];


    public function render()
    {
        $students = User::where('user_type', 'student')
            ->where('is_active', '1')->orderBy('id', 'desc')->paginate(10);

        return view('livewire.enroll-student', compact('students'));
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
}
