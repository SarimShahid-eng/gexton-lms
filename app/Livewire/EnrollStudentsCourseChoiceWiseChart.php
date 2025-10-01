<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EnrollStudent;

class EnrollStudentsCourseChoiceWiseChart extends Component
{
    public $courseChoiceData = [];

    // ✅ Fixed labels (predefined course list)
    protected array $courseLabels = [
        'Certified Cloud Computing Professional',
        'Certified Cyber Security and Ethical Hacking Professional',
        'Certified Data Scientist',
        'Certified Database Administrator',
        'Certified Digital Marketing Professional',
        'Certified E-Commerce Professional',
        'Certified Graphic Designer',
        'Certified Java Developer',
        'Certified Mobile Application Developer',
        'Certified Python Developer',
        'Certified Social Media Manager',
        'Certified Web Developer',
    ];

    public function mount()
    {
        // Initialize counts with all courses = 0
        $courseCounts = array_fill_keys($this->courseLabels, 0);

        // Fetch enrolled students
        $students = EnrollStudent::query()
            ->where('cancel_enrollment', 0)
            ->whereHas('registered_student', function ($q) {
                $q->where('enrolled_status', 1);
            })
            ->with('registered_student')
            ->get();

        // Count selections from course_choice_1 - course_choice_4
        foreach ($students as $enroll) {
            $student = $enroll->registered_student;

            if ($student) {
                foreach (['course_choice_1', 'course_choice_2', 'course_choice_3', 'course_choice_4'] as $choiceCol) {
                    $course = $student->$choiceCol;
                    if ($course && isset($courseCounts[$course])) {
                        $courseCounts[$course]++;

                    }
                }
            }
        }

        // Prepare data for Chart.js
        $this->courseChoiceData = [
            'labels' => array_keys($courseCounts),   // fixed course labels
            'data'   => array_values($courseCounts), // counts
        ];
    }

    public function render()
    {
        return view('livewire.enroll-students-course-choice-wise-chart');
    }
}
