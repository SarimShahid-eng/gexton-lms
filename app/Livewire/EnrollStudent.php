<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Batch;
use App\Models\Campus;
use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StudentRegister;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\EnrollStudentDetail;
use App\Models\EnrollStudent as EnrollStudentModel;

class EnrollStudent extends Component
{
    use WithPagination;

    public $full_name, $father_name, $gender, $email, $cnic_number, $phone, $contact_number, $date_of_birth,
        $highest_qualification, $most_recent_institution,
        $profile_picture, $intermediate_marksheet, $domicile_form_c,
        $domicile_category, $preferred_study_center, $preferred_time_slot,
        $domicile_district, $university_name, $search = '', $enrolledDetails = [], $campuses = [], $batches = [], $courses = [], $student_id, $campus_ids = [], $batch_ids = [], $course_ids = [], $student_details = [];
    public array $districts = [
        'badin'               => 'Badin',
        'dadu'                => 'Dadu',
        'ghotki'              => 'Ghotki',
        'hyderabad'           => 'Hyderabad',
        'jacobabad'           => 'Jacobabad',
        'jamshoro'            => 'Jamshoro',
        'karachi-central'     => 'Karachi Central',
        'karachi-east'        => 'Karachi East',
        'karachi-south'       => 'Karachi South',
        'karachi-west'        => 'Karachi West',
        'kashmore'            => 'Kashmore',
        'khairpur'            => 'Khairpur',
        'larkana'             => 'Larkana',
        'matiari'             => 'Matiari',
        'mirpurkhas'          => 'Mirpurkhas',
        'naushahro-feroze'    => 'Naushahro Feroze',
        'shaheed-benazirabad' => 'Shaheed Benazirabad',
        'qambar-shahdadkot'   => 'Qambar Shahdadkot',
        'sanghar'             => 'Sanghar',
        'shikarpur'           => 'Shikarpur',
        'sukkur'              => 'Sukkur',
        'tando-allahyar'      => 'Tando Allahyar',
        'tando-muhammad-khan' => 'Tando Muhammad Khan',
        'tharparkar'          => 'Tharparkar',
        'thatta'              => 'Thatta',
        'umerkot'             => 'Umerkot',
        'sujawal'             => 'Sujawal',
        'korangi'             => 'Korangi',
        'malir'               => 'Malir',
    ];
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
        // dd($student_data);
        $student_register_data = StudentRegister::where('cnic_number', $student_data->cnic_number)->first();

        $this->student_details = EnrollStudentDetail::where('student_id', $id)->get()->toArray();
        if ($student_data) {
            $this->full_name = $student_data->student->full_name;
            $this->father_name = $student_data->father_name;
            $this->gender = $student_data->gender;
            $this->date_of_birth = $student_data->date_of_birth;
            $this->cnic_number = $student_data->cnic_number;
            $this->email = $student_data->student->email;
            $this->phone = $student_data->contact_number;
            $this->highest_qualification = $student_register_data->highest_qualification;
            $this->most_recent_institution = $student_register_data->most_recent_institution;
            $this->domicile_district = $student_register_data->domicile_district;
            $this->domicile_category = $student_register_data->domicile_category;
            $this->preferred_study_center = $student_register_data->preferred_study_center;
            $this->preferred_time_slot = $student_register_data->preferred_time_slot;
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
    // public function updateStudents()
    // {

    //     try {

    //         $this->validate([
    //             'campus_ids.*' => 'required|exists:campuses,id',
    //             'batch_ids.*' => 'nullable|exists:batches,id',
    //             'course_ids.*' => 'nullable|exists:courses,id',
    //         ]);

    //         // dd($this->student_id);
    //         // Process each campus_id
    //         foreach ($this->campus_ids as $index => $campus_id) {
    //             if (!empty($campus_id)) {
    //                 // Cast all IDs to integers
    //                 $campus_id = (int) $campus_id;
    //                 $batch_id = isset($this->batch_ids[$index]) ? (int) $this->batch_ids[$index] : null;
    //                 $course_id = isset($this->course_ids[$index]) ? (int) $this->course_ids[$index] : null;

    //                 // Find existing enrollment by student_id and campus_id
    //                 $enrollDetail = EnrollStudentDetail::where('student_id', (int) $this->student_id)
    //                     ->where('campus_id', $campus_id)
    //                     ->first();

    //                 if ($enrollDetail) {
    //                     // Update existing record
    //                     $enrollDetail->update([
    //                         'campus_id' => $campus_id,
    //                         'batch_id' => $batch_id,
    //                         'course_id' => $course_id,
    //                     ]);
    //                 }
    //             }
    //         }
    //         // Dispatch success events
    //         $this->dispatch('close-enrol-view-modal');
    //         $this->dispatch(
    //             'student-update',
    //             title: 'Success!',
    //             text: 'User Course Updated.',
    //             icon: 'success',
    //         );
    //     } catch (\Exception $e) {
    //         \Log::error('Error updating student enrollment: ' . $e->getMessage());
    //         $this->dispatch(
    //             'student-update',
    //             title: 'Error!',
    //             text: 'An error occurred while updating enrollment.',
    //             icon: 'error',
    //         );
    //     }
    // }


    public function updateStudent()
    {
        $this->validate([
            // form fields you showed
            'full_name'               => 'required|string|max:255',
            'email'                   => ['required', 'email', Rule::unique('users', 'email')->ignore($this->student_id)],
            'phone'                   => 'required|string|max:20',
            'father_name'             => 'required|string|max:255',
            'gender'                  => 'required|in:male,female,transgender',
            'cnic_number'             => 'required|string|max:13',
            'date_of_birth'           => 'required|date',
            'domicile_district'       => 'required|string|max:255',
            'most_recent_institution' => 'required|string|max:255',
            'highest_qualification'   => 'required|string|max:100',
            'preferred_study_center'  => 'required|string|max:255',
            'preferred_time_slot'     => 'required|string|max:255',

            // detail arrays
            'campus_ids.*' => 'required|exists:campuses,id',
            'batch_ids.*'  => 'required|exists:batches,id',
            'course_ids.*' => 'required|exists:courses,id',
        ]);

        try {
            DB::transaction(function () {

                // --- 1) Load profile by current user/student id
                $profile = EnrollStudentModel::with('student')
                    ->where('student_id', (int)$this->student_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                // --- 2) Resolve StudentRegister by the *current* profile CNIC
                // (so you can safely change CNIC in this update)
                $register = StudentRegister::where('cnic_number', $profile->cnic_number)
                    ->latest('id')
                    ->lockForUpdate()
                    ->first();

                // --- 3) Update USER
                $profile->student->fill([
                    'full_name' => $this->full_name,
                    'email'     => $this->email,
                    'phone'     => $this->phone,
                ])->save();

                // --- 4) Update ENROLL_STUDENTS (profile sheet)
                $profile->fill([
                    'father_name'      => $this->father_name,
                    'gender'           => $this->gender,
                    'cnic_number'      => $this->cnic_number,     // can change
                    'contact_number'   => $this->phone,
                    'date_of_birth'    => $this->date_of_birth,
                    'domicile_district' => $this->domicile_district,
                    'university_name'  => $this->most_recent_institution,
                    // add picture/marksheet/etc if you collect them
                ])->save();

                // --- 5) Update STUDENT_REGISTERS (application card), if found via CNIC
                if ($register) {
                    $register->fill([
                        'full_name'               => $this->full_name,
                        'father_name'             => $this->father_name,
                        'gender'                  => $this->gender,
                        'cnic_number'             => $this->cnic_number, // keep in sync
                        'email'                   => $this->email,
                        'contact_number'          => $this->phone,
                        'date_of_birth'           => $this->date_of_birth,
                        'domicile_district'       => $this->domicile_district,
                        'most_recent_institution' => $this->most_recent_institution,
                        'highest_qualification'   => $this->highest_qualification,
                        'preferred_study_center'  => $this->preferred_study_center,
                        'preferred_time_slot'     => $this->preferred_time_slot,
                    ])->save();
                }
                // If you want to create when missing, you can add a create() here.

                // --- 6) Update per-campus/batch/course details (existing rows only)
                if (is_array($this->campus_ids)) {
                    foreach ($this->campus_ids as $i => $campus_id) {
                        if (empty($campus_id)) continue;

                        $campus_id = (int) $campus_id;
                        $batch_id  = !empty($this->batch_ids[$i])  ? (int)$this->batch_ids[$i]  : null;
                        $course_id = !empty($this->course_ids[$i]) ? (int)$this->course_ids[$i] : null;

                        $detail = EnrollStudentDetail::where('student_id', $profile->student_id)
                            ->lockForUpdate()
                            ->first();

                        if ($detail) {
                            $detail->update([
                                'campus_id' => $campus_id,
                                'batch_id'  => $batch_id,
                                'course_id' => $course_id,
                            ]);
                        }
                    }
                }
            });

            $this->dispatch('close-enrol-view-modal');
            $this->dispatch('student-update', title: 'Success!', text: 'User profile & enrollment updated.', icon: 'success');
        } catch (\Throwable $e) {
            report($e);
            $this->dispatch('student-update', title: 'Error!', text: 'An error occurred while updating enrollment.', icon: 'error');
        }
    }
}
