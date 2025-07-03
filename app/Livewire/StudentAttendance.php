<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\StudentAttendace as AttendanceModel;

class StudentAttendance extends Component
{
    public $students = [];
    public $attendances = [];
    public $attendanceDate, $course_id = null;

    public function mount()
    {
        $this->attendanceDate = now()->format('Y-m-d');
        $this->loadStudents();
    }

    public function loadStudents()
    {
        $this->students = User::where('user_type', 'student')
            ->whereHas('student_detail.enroll', function ($query) {
                $query->where('course_id', $this->course_id);
            })
            ->with('student_detail.enroll')
            ->get();

        foreach ($this->students as $student) {
            $attendance = AttendanceModel::where('student_id', $student->id)
                ->whereDate('date', $this->attendanceDate)
                ->first();

            // Set attendance status: present / absent / leave
            $this->attendances[$student->id] = $attendance ? $attendance->is_present  : null;
        }
    }



    public function updatedAttendanceDate()
    {
        $this->loadStudents();
    }

    public function saveAttendance()
    {
        foreach ($this->attendances as $studentId => $status) {
            AttendanceModel::updateOrCreate(
                [
                    'student_id' => $studentId,
                    'date' => $this->attendanceDate,
                ],
                [
                    'is_present' => $status, // status can be: present, absent, leave
                ]
            );
        }
        $this->attendances = [];

        $this->reset();

        // Alert
        $this->dispatch(
            'attendace-saved',
            title: 'Success!',
            text: 'Attendace has been saved successfully.',
            icon: 'success',
        );

        sleep(1);

        return redirect()->route('teacher.attendace');
    }
    public function markAll($status)
    {
        foreach ($this->students as $student) {
            $this->attendances[$student->id] = $status;
        }
    }
    public function updatedCourseId($value)
    {
        $this->course_id = $value;
        $this->loadStudents();
    }
    public function render()
    {
        $courses = Auth::user()->courses()->with('batch')->get();

        return view('livewire.student-attendance', compact('courses'));
    }
}
