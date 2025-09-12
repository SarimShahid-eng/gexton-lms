<?php

namespace App\Livewire;

use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Batch;
use App\Models\EnrollStudent;
use App\Models\EnrollStudentDetail;
use App\Models\Phase;
use App\Models\StudentRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ShowStudent extends Component
{
    protected array $allCourses = [
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
    use WithPagination;
    protected $listeners = ['view_student'];
    public $full_name, $father_name, $gender, $cnic_number, $contact_number,
        $domicile_category, $most_recent_institution, $highest_qualification, $have_disability, $monthly_household_income, $participated_previously, $from_source,
        $course_if_participated, $phase_if_participated, $center_if_participated,
        $date_of_birth, $profile_picture, $intermediate_marksheet, $domicile_form_c, $domicile_district, $is_enrolled, $university_name, $enrolled_status, $preferred_study_center, $preferred_time_slot, $course_choice_1, $course_choice_2, $course_choice_3, $course_choice_4, $search = '', $phases = [], $phase_id;
    public $filter_course = '';
    public $filter_qualification = '';
    public $filter_gender = '';
    public $filter_d_category = '';
    public $filter_district = '';

    // public function updatingSearch()
    // {
    //     $this->resetPage();
    // }
    public $campus_id, $batch_id, $course_id, $student_id;
    public $campuses = [], $batches = [], $courses = [];
    public function updating($name, $value)
    {
        if (in_array($name, [
            'search',
            'filter_course',
            'filter_qualification',
            'filter_gender',
            'filter_d_category',
        ])) {
            $this->resetPage();
        }
    }
    public function render()
    {
        $students = StudentRegister::query()

            // existing search
            ->when($this->search !== '', function ($q) {
                $term = "%{$this->search}%";
                $q->where(function ($q) use ($term) {
                    $q->where('full_name', 'like', $term)
                        ->orWhere('email', 'like', $term)
                        ->orWhere('cnic_number', 'like', $term)
                        ->orWhere('contact_number', 'like', $term);
                });
            })

            // course filter (matches any course_choice_* column)
            ->when($this->filter_course !== '', function ($q) {
                $course = $this->filter_course;
                $q->where(function ($q) use ($course) {
                    $q->where('course_choice_1', $course)
                        ->orWhere('course_choice_2', $course)
                        ->orWhere('course_choice_3', $course)
                        ->orWhere('course_choice_4', $course);
                });
            })

            // highest qualification
            ->when(
                $this->filter_qualification !== '',
                fn($q) =>
                $q->where('highest_qualification', $this->filter_qualification)
            )

            // gender
            ->when(
                $this->filter_gender !== '',
                fn($q) =>
                $q->where('gender', $this->filter_gender)
            )

            // domicile category
            ->when(
                $this->filter_d_category !== '',
                fn($q) =>
                $q->where('domicile_category', $this->filter_d_category)
            )
            ->when(
                $this->filter_district !== '',
                fn($q) =>
                $q->where('domicile_district', $this->filter_district)
            )

            ->orderByDesc('id')
            ->paginate(10);

        $phases = Phase::all();

        return view('livewire.show-student', compact('students', 'phases'));
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
        $this->domicile_category = $student->domicile_category;
        $this->profile_picture = $student->profile_picture;
        $this->intermediate_marksheet = $student->intermediate_marksheet;
        $this->domicile_form_c = $student->domicile_form_c;
        $this->domicile_district = $student->domicile_district;
        $this->most_recent_institution = $student->most_recent_institution;
        $this->is_enrolled = $student->is_enrolled;
        $this->university_name = $student->university_name;
        $this->preferred_study_center = $student->preferred_study_center;
        $this->preferred_time_slot = $student->preferred_time_slot;
        $this->course_choice_1 = $student->course_choice_1;
        $this->course_choice_2 = $student->course_choice_2;
        $this->course_choice_3 = $student->course_choice_3;
        $this->course_choice_4 = $student->course_choice_4;
        $this->highest_qualification = $student->highest_qualification;
        $this->have_disability = $student->have_disability;
        $this->monthly_household_income = $student->monthly_household_income;
        $this->participated_previously = $student->participated_previously;
        $this->course_if_participated = $student->course_if_participated;
        $this->phase_if_participated = $student->phase_if_participated;
        $this->center_if_participated = $student->center_if_participated;
        $this->from_source = $student->from_source;


        $this->dispatch('open-task-view-modal');
    }
    public function updatedPhaseId($value)
    {
        $this->campuses = Campus::where('phase_id', $value)->get();
        $this->campus_id = null;
        $this->batches = [];
        $this->batch_id = null;
        $this->courses = [];
        $this->course_id = null;
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
        // dd
        $this->courses = Course::where('batch_id', $value)->get();
        $this->course_id = null;
    }
    public function enroll_student($id)
    {
        $this->reset(['campus_id', 'batch_id', 'course_id', 'batches', 'courses']);
        $this->reset();
        $this->phases = Phase::get();
        $student = StudentRegister::find($id);
        $this->full_name = $student->full_name;
        $this->father_name = $student->father_name;
        $this->cnic_number = $student->cnic_number;
        $this->student_id = $student->id;
        $this->dispatch('open-enrol-view-modal');
    }
    public function enrollStudent($id)
    {
        $this->validate([
            'phase_id' => 'required',
            'campus_id' => 'required',
            'batch_id' => 'required',
            'course_id' => 'required',
        ], [
            'phase_id.required' => 'Phase field is required.',
            'campus_id.required' => 'Batch field is required.',
            'batch_id.required' => 'Campus field is required.',
            'course_id.required' => 'Course field is required.',
        ]);

        $student = StudentRegister::findOrFail($id);
        //User
        $user = User::create([
            'full_name' => $student->full_name,
            'email' => $student->email,
            'phone' => $student->contact_number,
            // cncic is student password
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
        return (new \App\Exports\StudentsExport(
            search: $this->search ?? '',
            course: $this->filter_course ?? '',
            qualification: $this->filter_qualification ?? '',
            gender: $this->filter_gender ?? '',
            dCategory: $this->filter_d_category ?? '',
            campusId: $this->campus_id ?? null,
            batchId: $this->batch_id ?? null,
            courseId: $this->course_id ?? null,
        ))->download('students.xlsx');
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
