<?php

namespace App\Livewire;

use App\Models\StudentRegister;
use Livewire\Component;
use Livewire\WithFileUploads;

class Student extends Component
{
    use WithFileUploads;

    public $full_name, $father_name, $gender, $cnic_number, $contact_number, $date_of_birth, $profile_picture, $intermediate_marksheet, $domicile_district, $domicile_form_c, $is_enrolled = false, $university_name, $preferred_study_center, $preferred_time_slot, $course_choice_1, $course_choice_2, $course_choice_3, $course_choice_4, $courseList = [];
    public function render()
    {
        $this->courseList = [
            'Web Development',
            'Graphic Design',
            'Digital Marketing',
            'App Development',
            'Cyber Security',
            'Data Science',
        ];
        return view('livewire.student')->layout('layouts.student-layout');
    }
    public function save()
    {
        $rule = [
            'full_name' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'gender' => 'required',
            'cnic_number' => 'required|digits:13|unique:student_registers,cnic_number',
            'contact_number' => 'required|numeric',
            'date_of_birth' => 'required',
            'profile_picture' => 'required|image|max:1024',
            'intermediate_marksheet' => 'required|image|max:1024',
            'domicile_form_c' => 'required|image|max:1024',
            'domicile_district' => 'required|string',
            'is_enrolled' => 'required|in:0,1',
            'university_name' => 'nullable|string|max:255',
            'preferred_study_center' => 'required|string',
            'preferred_time_slot' => 'required|string',
            'course_choice_1' => 'required|string',
            'course_choice_2' => 'required|string',
            'course_choice_3' => 'required|string',
            'course_choice_4' => 'required|string',
        ];
        $messages = [
            // Full Name
            'full_name.required' => 'Please enter your full name.',
            'full_name.string' => 'Your full name must be a valid string.',
            'full_name.max' => 'Your full name cannot exceed 255 characters.',

            // Father's Name
            'father_name.required' => 'Please enter your father’s name.',
            'father_name.string' => 'Father’s name must be a valid string.',
            'father_name.max' => 'Father’s name cannot exceed 255 characters.',

            // Gender
            'gender.required' => 'Please select your gender.',
            'gender.in' => 'Gender must be either Male or Female.',

            // CNIC Number
            'cnic_number.required' => 'Please enter your CNIC number.',
            'cnic_number.digits' => 'CNIC number must be exactly 13 digits.',
            'cnic_number.unique' => 'This CNIC number is already registered.',


            // Contact Number
            'contact_number.required' => 'Please enter your contact number.',
            'contact_number.numeric' => 'Contact number must be numeric.',

            // Date of Birth
            'date_of_birth.required' => 'Please enter your date of birth.',

            // Profile Picture
            'profile_picture.required' => 'Please upload your profile picture.',

            // Intermediate Marksheet
            'intermediate_marksheet.required' => 'Please upload your intermediate marksheet.',
            'intermediate_marksheet.image' => 'Intermediate marksheet must be an image (e.g., JPG, PNG).',
            'intermediate_marksheet.max' => 'Intermediate marksheet size cannot exceed 1MB.',

            // Domicile/Form C
            'domicile_form_c.required' => 'Please upload your domicile or Form C.',
            'domicile_form_c.image' => 'Domicile/Form C must be an image (e.g., JPG, PNG).',
            'domicile_form_c.max' => 'Domicile/Form C size cannot exceed 1MB.',

            // Domicile District
            'domicile_district.required' => 'Please select your domicile district.',
            'domicile_district.string' => 'Domicile district must be a valid string.',

            // University Name
            'university_name.string' => 'University name must be a valid string.',

            // Preferred Study Center
            'preferred_study_center.required' => 'Please select your preferred study center.',
            'preferred_study_center.string' => 'Preferred study center must be a valid string.',

            // Preferred Time Slot
            'preferred_time_slot.required' => 'Please select your preferred time slot.',
            'preferred_time_slot.string' => 'Preferred time slot must be a valid string.',

            // Course Choices
            'course_choice_1.required' => 'Please select your 1st course choice.',
            'course_choice_1.string' => '1st course choice must be a valid string.',

            'course_choice_2.required' => 'Please select your 2nd course choice.',
            'course_choice_2.string' => '2nd course choice must be a valid string.',

            'course_choice_3.required' => 'Please select your 3rd course choice.',
            'course_choice_3.string' => '3rd course choice must be a valid string.',

            'course_choice_4.required' => 'Please select your 4th course choice.',
            'course_choice_4.string' => '4th course choice must be a valid string.',
        ];

        $validatedData = $this->validate($rule, $messages);
        $fileFields = ['profile_picture', 'intermediate_marksheet', 'domicile_form_c'];
        foreach ($fileFields as $field) {
            if ($this->$field) {
                $file = $this->$field;
                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();

                $destinationPath = public_path('attachments');

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                $file->storeAs('', $filename, [
                    'disk' => 'custom_public',
                ]);
                $validatedData[$field] = $filename;
            }
        }
        StudentRegister::create($validatedData);
        $this->reset();
        $this->dispatch(
            'student-saved',
            title: 'Success!',
            text: "Registeration Completed.",
            icon: 'success',
        );
        $this->reset();

    }
}
