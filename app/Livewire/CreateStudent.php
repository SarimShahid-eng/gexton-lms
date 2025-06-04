<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Course;
use Livewire\Component;
use App\Models\BatchGroup;
use App\Models\CustomSession;
use App\Models\StudentDetail;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;

class CreateStudent extends Component
{
    use WithPagination;
    public $course_id;
    public $teacher_name;
    public $group_id, $email, $firstname, $lastname, $phone, $password, $is_active, $password_confirmation, $update_id, $session_year_id;
    #[Computed()]
    public function courses()
    {
        return Course::all();
    }
    #[Computed()]
    public function batchgroups()
    {
        return BatchGroup::where('course_id', $this->course_id)->get();
    }

    public function setTeacher($id)
    {
        $teacher = BatchGroup::with('teacher')->find($id);
        if ($teacher && $teacher->teacher) {
            $this->teacher_name = $teacher->teacher->firstname . ' ' . $teacher->teacher->lastname;
        } else {
            $this->teacher_name = '';
        }
    }
    public function save()
    {
        $validated = $this->validate(
            [
                'course_id' => 'required',
                'teacher_name' => 'required',
                'group_id' => 'required',
                'email' => 'unique:users,email,'.$this->update_id,
                'firstname' => 'required',
                'lastname' => 'required',
                'phone' => 'required',
                'password' => $this->update_id ? 'nullable' : 'required|confirmed',
                'session_year_id' => 'required',
                'is_active' => 'required',
            ],
            [
                'course_id.required' => 'course field is required',
                'group_id' => 'group field is required'
            ]
        );
        $userData = [
            'firstname' => $validated['firstname'],
            'lastname' => $validated['lastname'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'user_type' => 'student',
            'session_year_id' => $validated['session_year_id'],
            'is_active' => $validated['is_active'],

        ];
        if ($this->update_id && !$this->password) {
            unset($userData['password']);
        }

        $user =  User::updateOrCreate(
            ['id' => $this->update_id],
            $userData
        );
        $findRelatedGroup = BatchGroup::find($validated['group_id']);
        $studentDetails =  [
            'user_id' => $user->id,
            'teacher_id' => $findRelatedGroup->teacher_id,
            'group_id' => $validated['group_id'],
            'course_id' => $validated['course_id'],
        ];

        StudentDetail::updateOrCreate(
            ['user_id' => $this->update_id],
            $studentDetails
        );
        $message = $this->update_id ? 'updated' : 'saved';
        $this->reset();
        $this->dispatch(
            'student-saved',
            title: 'Success!',
            text: "Student has been $message successfully.",
            icon: 'success',
        );
        sleep(1);

        return redirect()->route('student_create');
    }
    public function edit($id)
    {
        $student = User::with('student_details', 'student_details.course:id,course_title', 'student_details.teacher:id,firstname,lastname', 'student_details.group:id,group_name')->where('user_type', 'student')
            ->select('id', 'firstname', 'lastname', 'email', 'phone', 'is_active')
            ->find($id);
        $this->course_id = $student->student_details->course_id;
        $this->group_id = $student->student_details->group_id;
        $this->email = $student->email;
        $this->firstname = $student->firstname;
        $this->lastname = $student->lastname;
        $this->phone = $student->phone;
        $this->is_active = $student->is_active ? 1 : 0;
        // dd($this->is_active);
        $this->update_id = $student->id;
        $this->setTeacher($this->group_id);
    }

    public function render()
    {
        $session_active = CustomSession::where('is_selected', 1)->first();
        $this->session_year_id = $session_active->id;
        // $this->batchgroups = BatchGroup::all();
        $students = User::with('student_details', 'student_details.course:id,course_title', 'student_details.group:id,group_name')->where('user_type', 'student')
            ->where('user_type', 'student')
<<<<<<< HEAD
            ->select('id', 'firstname', 'lastname','email')
=======
            ->select('id', 'firstname', 'lastname','is_active')
>>>>>>> a93fd89d4e9a266ae65685fa68f62b9e21645bf9
            ->paginate(10);
        return view('livewire.create-student', compact('students', 'session_active'));
    }
}
