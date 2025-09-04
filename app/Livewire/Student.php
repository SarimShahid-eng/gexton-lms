<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\StudentRegister;
use App\Rules\UniqueAcrossTables;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\RateLimiter;

class Student extends Component
{
    use WithFileUploads;
    public bool $info_confirm = false;

    public $full_name, $father_name, $gender, $cnic_number, $email, $contact_number, $date_of_birth, $profile_picture, $intermediate_marksheet, $domicile_district, $domicile_category, $domicile_form_c,  $most_recent_institution, $preferred_study_center, $preferred_time_slot, $course_choice_1, $course_choice_2, $course_choice_3, $course_choice_4;
    public $highest_qualification, $have_disability, $monthly_household_income, $course_if_participated, $phase_if_participated, $center_if_participated, $from_source, $participated_previously;
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
    // from changing qualification wise to on course choices change option exclusion section = mainQualifSec
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
        $list = match ($this->highest_qualification) {
            'matric'        => $this->matricCourses,
            'intermediate'  => $this->allCourses,
            'graduate'      => $this->graduateCourses,
            default         => [],
        };
        $this->courseList = array_map(fn($s) => trim($s), $list);
    }
    /* === Helpers === */
    private function selectedClean(array $items): array
    {
        // keep only non-empty + trimmed
        return array_values(array_filter(array_map(
            fn($s) => $s === null ? null : trim($s),
            $items
        )));
    }

    #[Computed]
    public function availableCoursesForChoice1(): array
    {
        // dd($this->courseList);
        return $this->courseList;
    }
    #[Computed]
    public function availableCoursesForChoice2(): array
    {
        $exclude = $this->selectedClean([$this->course_choice_1]);
        return array_values(array_diff($this->courseList, $exclude));
    }

    #[Computed]
    public function availableCoursesForChoice3(): array
    {
        $exclude = $this->selectedClean([$this->course_choice_1, $this->course_choice_2]);
        return array_values(array_diff($this->courseList, $exclude));
    }

    #[Computed]
    public function availableCoursesForChoice4(): array
    {
        $exclude = $this->selectedClean([
            $this->course_choice_1,
            $this->course_choice_2,
            $this->course_choice_3
        ]);
        return array_values(array_diff($this->courseList, $exclude));
    }

    public function updatedCourseChoice1(): void
    {
        $this->reset(['course_choice_2', 'course_choice_3', 'course_choice_4']);
        $this->dispatch('$refresh'); // force DOM to reconcile
    }

    public function updatedCourseChoice2(): void
    {
        $this->reset(['course_choice_3', 'course_choice_4']);
        $this->dispatch('$refresh');
    }

    public function updatedCourseChoice3(): void
    {
        $this->reset('course_choice_4');
        $this->dispatch('$refresh');
    }
    // selected Course Ends
    // mainQualifSec End

    // When user selects "no", clear the extra fields
    public function updatedParticipatedPreviously($val): void
    {
        if ($val === 'no') {
            $this->reset(['phase_if_participated', 'course_if_participated', 'center_if_participated']);
        }
    }
    protected function rules()
    {
        return [
            'full_name'               => ['required', 'string', 'min:2', 'max:150'],
            'monthly_household_income' => ['required', 'string', 'min:2', 'max:150'],
            'father_name'             => ['required', 'string', 'min:2', 'max:150'],
            'gender'                  => ['required', Rule::in(['male', 'female', 'transgender'])],

            'cnic_number'    => ['required', 'integer', 'digits:13', new UniqueAcrossTables(['student_registers'], 'cnic_number')],
            'contact_number' => ['required', 'integer', 'digits:11'],

            'email'                   => ['required', 'email', 'max:100',   new UniqueAcrossTables(['student_registers', 'users'], 'email')],
            'contact_number'          => ['required', 'string', 'min:11', 'max:11'], // adjust pattern if needed
            'date_of_birth'           => ['required', 'date'],

            'profile_picture' => [
                'required',
                'file',
                'mimes:jpg,png,pdf',
                'max:256',                        // ≈ 1 MB
            ],
            'intermediate_marksheet'  => ['required', 'file', 'max:256', 'mimes:jpg,png,pdf'],
            'domicile_category'             => ['required', 'string', 'min:2', 'max:150', Rule::in(['urban', 'rural'])],
            'domicile_form_c'         => ['required', 'file', 'max:256', 'mimes:jpg,png,pdf'],

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
        'course_if_participated.exclude_unless' => 'previous course required if you have participated before',
        'course_if_participated.required' => 'course required if you have participated before',
        'phase_if_participated.exclude_unless' => 'previous phase required if you have participated before',
        'phase_if_participated.required' => 'phase required if you have participated before',
        'center_if_participated.exclude_unless' => 'previous center required if you have participated before',
        'center_if_participated.required' => 'center required if you have participated before',
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
        // Build a unique key (per IP or per user). Here: per IP.
        $key = 'student-register:' . request()->ip();
        $max = 5;          // 5 attempts
        $decay = 60;       // per 60 seconds

        // If over the limit, show an error and stop
        if (RateLimiter::tooManyAttempts($key, $max)) {
            $seconds = RateLimiter::availableIn($key);
            $this->addError('rate', "Too many attempts. Please try again in {$seconds} seconds.");
            return;
        }

        // Count this attempt (expires after $decay seconds)
        RateLimiter::hit($key, $decay);
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
        return redirect()->back()->with('message', 'Dear Candidate,

Thank you for submitting your registration form for PITP Phase II. Interviews for selection will be conducted soon. Please stay connected through our official WhatsApp channel for updates on your interview date and venue: https://whatsapp.com/channel/0029VayWRoWKgsNsomnaAp0t

In the meantime, kindly ensure that all your documents are prepared and ready for verification.

Best regards,
PITP – MUET');
    }
}
