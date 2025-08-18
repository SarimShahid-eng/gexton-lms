<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\StudentRegister;
use Illuminate\Validation\Rule;

class Student extends Component
{
    use WithFileUploads;

    public $full_name, $father_name, $gender, $cnic_number, $email, $contact_number, $date_of_birth, $profile_picture, $intermediate_marksheet, $domicile_district, $domicile_category, $domicile_form_c,  $most_recent_institution, $preferred_study_center, $preferred_time_slot, $course_choice_1, $course_choice_2, $course_choice_3, $course_choice_4;
    public $highest_qualification, $have_disability, $monthly_household_income, $course_if_participated, $phase_if_participated, $center_if_participated, $from_source, $participated_previously, $info_confirm = false;
    public $activeTab = 'step1';
    // public string $highestQualification = '';
    public array $courseList = [];
    // course Setup
    // Master list
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

    // Matric courses
    protected array $matricCourses = [
        'Certified Graphic Designer',
        'Certified Digital Marketing Professional',
        'Certified E-Commerce Professional',
        'Certified Social Media Manager',
        'Certified Web Developer',
        'Certified Python Developer',
    ];

    // Graduate courses
    protected array $graduateCourses = [
        'Certified Cloud Computing Professional',
        'Certified Cyber Security and Ethical Hacking Professional',
        'Certified Data Scientist',
        'Certified Database Administrator',
        'Certified Java Developer',
        'Certified Mobile Application Developer',
    ];
    // districts
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
    //
    public function mount()
    {
        // Optional: set a default
        $this->highest_qualification = $this->highest_qualification ?? null;
        $this->refreshCourseList();
    }
    public function updatedHighestQualification($value)
    {
        $this->highest_qualification = $value;
        $this->refreshCourseList();
        $this->reset([
            'course_choice_1',
            'course_choice_2',
            'course_choice_3',
            'course_choice_4',
        ]);
    }
    private function refreshCourseList(): void
    {
        switch ($this->highest_qualification) {
            case 'matric':
                $this->courseList = $this->matricCourses;
                break;

            case 'intermediate':
                $this->courseList = $this->allCourses;
                break;

            case 'graduate':
                $this->courseList = $this->graduateCourses;
                break;

            default:
                $this->courseList = [];
        }
    }

    protected function rules()
    {
        return [
            'full_name'               => ['required', 'string', 'min:2', 'max:150'],
            'monthly_household_income' => ['required', 'string', 'min:2', 'max:150'],
            'father_name'             => ['required', 'string', 'min:2', 'max:150'],
            'gender'                  => ['required', Rule::in(['Male', 'Female', 'Transgender'])],

            'cnic_number'    => ['required', 'integer', 'digits:13'],
            'contact_number' => ['required', 'integer', 'digits:11'],

            'email'                   => ['required', 'email', 'max:100', 'unique:student_registers,email'],
            'contact_number'          => ['required', 'string', 'min:11', 'max:11'], // adjust pattern if needed
            'date_of_birth'           => ['required', 'date'],

            // FILES (Laravel's max is in KB)
            'profile_picture' => [
                'required',
                'file',
                'mimes:jpg,png,pdf',
                'max:256',                        // ≈ 1 MB
                // 'dimensions:min_width=350,min_height=450,ratio=7/9', // ~35x45 mm
            ],
            'intermediate_marksheet'  => ['required', 'file', 'max:256','mimes:jpg,png,pdf'],
            'domicile_category'             => ['required', 'string', 'min:2', 'max:150', Rule::in(['urban', 'rural'])],
            'domicile_form_c'         => ['required', 'file', 'max:256','mimes:jpg,png,pdf'],

            'domicile_district'       => ['required', 'string', 'max:100', Rule::in(array_keys($this->districts))],
            'most_recent_institution'   => ['required', 'string', 'max:150'],
            'preferred_study_center'  => ['required', 'string', 'max:120'],
            'preferred_time_slot'     => ['required', 'string', 'max:50'],

            // Course choices: all required & distinct & must be from list (if you want to lock to known list)
            'course_choice_1' => ['required', Rule::in(array_values($this->courseList))],
            'course_choice_2' => ['required', 'different:course_choice_1', Rule::in(array_values($this->courseList))],
            'course_choice_3' => ['required', 'different:course_choice_1', 'different:course_choice_2', Rule::in(array_values($this->courseList))],
            'course_choice_4' => ['required', 'different:course_choice_1', 'different:course_choice_2', 'different:course_choice_3', Rule::in(array_values($this->courseList))],

            'highest_qualification'   => ['required', 'string', 'max:100', Rule::in(['matric', 'intermediate', 'graduate'])],
            'have_disability'         => ['required', Rule::in(['yes', 'no'])],

            // Participated previously → require details
            'participated_previously' => ['required', Rule::in(['yes', 'no'])],
            'course_if_participated' => [
                'exclude_unless:participated_previously,yes',
                'required',
                'string',
                'max:150'
            ],
            'phase_if_participated' => [
                'exclude_unless:participated_previously,yes',
                'required',
                'string',
                'max:150'
            ],
            'center_if_participated' => [
                'exclude_unless:participated_previously,yes',
                'required',
                'string',
                'max:150'
            ],

            'from_source'  => ['required', 'string', 'max:50', Rule::in(['socail media', 'friend/family', 'university', 'post/banner', 'whatsapp group', 'other'])],
            'info_confirm' => ['accepted'],  // checkbox must be checked
        ];
    }

    protected $messages = [
        'info_confirm.accepted' => 'Please confirm that the information is accurate.',
        'domicile_form_c.required' => 'Please upload Domicile or Form‑C (max 256 KB).',
        'profile_picture.max'      => 'Profile picture must be at most 1 MB.',
        'profile_picture.mimes'    => 'Profile picture must be JPG or PNG.',
        // 'profile_picture.dimensions' => 'Profile picture must be passport size (~35x45mm, ratio 7:9, min 350×450 px).',
        'intermediate_marksheet.max' => 'Intermediate Marksheet/Certificate must be at most 256 KB.',
        'course_choice_2.different' => 'Course choices must be different.',
        'course_choice_3.different' => 'Course choices must be different.',
        'course_choice_4.different' => 'Course choices must be different.',
        'cnic_number.digits'       => 'CNIC must be exactly 13 digits.',
        'contact_number.digits'    => 'Contact number must be exactly 11 digits.',
    ];

    public function render()
    {
        return view('livewire.student')->layout('layouts.student-layout');
    }
    // Switch tabs
    public function switchTab($tab)
    {

        $this->activeTab = $tab;
    }
    public function save()
    {
        $this->refreshCourseList();
        // Validate all input fields according to your rules
        $validatedData = $this->validate();

        // Force CNIC & contact number into string to preserve leading zeros
        $validatedData['cnic_number']    = (string) $validatedData['cnic_number'];
        $validatedData['contact_number'] = (string) $validatedData['contact_number'];

        $fileDirs = [
            'profile_picture'        => '/profile_pictures',
            'intermediate_marksheet' => '/marksheets',
            'domicile_form_c'        => '/domicile_form_c',
        ];

        foreach ($fileDirs as $field => $subFolder) {
            if ($this->$field) {
                $file     = $this->$field;
                $ext      = strtolower($file->getClientOriginalExtension());
                $filename = time() . '_' . $field . '.' . $ext;

                // Absolute path to the target folder in /public
                $destinationPath = public_path($subFolder);

                // Ensure folder exists
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }

                // Store file in that subfolder via custom_public disk
                $file->storeAs($subFolder, $filename, [
                    'disk' => 'custom_public',
                ]);

                // Save relative path for DB or further use
                $validatedData[$field] = "{$filename}";
            }
        }
        StudentRegister::create($validatedData);

        $this->reset();
        return redirect()->back()->with('message', 'Successfully Registered !');
    }
}
