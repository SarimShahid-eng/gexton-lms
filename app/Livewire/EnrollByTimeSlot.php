<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EnrollStudent;
use App\Models\StudentRegister;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class EnrollByTimeSlot extends Component
{
    // Properties must be defined to hold the individual data arrays
    public $timeSlotData;

    public $morning;

    public $afternoon;

    public $earlyEvening;

    public $lateEvening;

    public $weekend;

    public $colors;

    protected $slotColors = [
        'Morning' => '#FFC107',        // Orange/Amber
        'Afternoon' => '#63B0E4',      // Blue
        'Early Evening' => '#009788',  // Green/Teal
        'Late Evening' => '#4CAF50',   // Medium Green
        'Weekend' => '#9C27B0',        // Purple for Weekend
    ];

    public function mount()
    {
        // 1. Setup Center Labels and Slot Groups
        $centerLabels = array_values(Config::get('filters.study_centers', []));

        $groupedSlotsMap = [
            'Morning'       => ['9 AM to 12 PM'],
            'Afternoon'     => ['12 PM to 3 PM'],
            'Early Evening' => ['3 PM to 6 PM'],
            'Late Evening'  => ['6 PM to 9 PM'],
            'Weekend'       => ['Sat & Sun (Weekend)'],
        ];

        // 2. Initialize Data Arrays
        $numCenters = count($centerLabels);
        $this->colors = [
            'morning' => $this->slotColors['Morning'],
            'afternoon' => $this->slotColors['Afternoon'],
            'earlyEvening' => $this->slotColors['Early Evening'],
            'lateEvening' => $this->slotColors['Late Evening'],
            'weekend' => $this->slotColors['Weekend'],
        ];
        $this->morning = array_fill(0, $numCenters, 0);
        $this->afternoon = array_fill(0, $numCenters, 0);
        $this->earlyEvening = array_fill(0, $numCenters, 0);
        $this->lateEvening = array_fill(0, $numCenters, 0);
        $this->weekend = array_fill(0, $numCenters, 0);

        // --- START FINAL CORRECTED DATABASE QUERY LOGIC ---

        $enrollmentCounts = StudentRegister::query()
            // 💡 BASE FILTER: Only include enrolled students
            ->where('student_registers.enrolled_status', 1)

            // Join to EnrollStudent to apply the cancel filter
            ->join('enroll_students', 'student_registers.cnic_number', '=', 'enroll_students.cnic_number')

            // 💡 FILTER: Exclude cancelled enrollments
            ->where('enroll_students.cancel_enrollment', 0)

            // Select and Group using ONLY StudentRegister columns
            ->select(
                'student_registers.preferred_study_center',
                'student_registers.preferred_time_slot',
                DB::raw('COUNT(student_registers.cnic_number) as count')
            )
            ->groupBy('student_registers.preferred_study_center', 'student_registers.preferred_time_slot')
            ->get();

        // 3. Process the results and map them to the PHP properties
        foreach ($enrollmentCounts as $record) {
            $centerName = $record->preferred_study_center;
            $centerIndex = array_search($centerName, $centerLabels);

            // Determine which chart group the time slot belongs to
            $groupName = null;
            $dbTimeSlotValue = $record->preferred_time_slot; // Correct column used

            foreach ($groupedSlotsMap as $group => $slots) {
                if (in_array($dbTimeSlotValue, $slots)) {
                    $groupName = $group;
                    break;
                }
            }

            // Map the count to the correct center and time slot property
            if ($centerIndex !== false && $groupName) {
                $count = $record->count;

                switch ($groupName) {
                    case 'Morning':
                        $this->morning[$centerIndex] = $count;
                        break;
                    case 'Afternoon':
                        $this->afternoon[$centerIndex] = $count;
                        break;
                    case 'Early Evening':
                        $this->earlyEvening[$centerIndex] = $count;
                        break;
                    case 'Late Evening':
                        $this->lateEvening[$centerIndex] = $count;
                        break;
                    case 'Weekend':
                        $this->weekend[$centerIndex] = $count;
                        break;
                }
            }
        }

        // 4. Final data package for Alpine.js
        $this->timeSlotData = [
            'labels' => $centerLabels,
            'colors' => $this->colors
        ];
    }

    public function render()
    {
        return view('livewire.enroll-by-time-slot');
    }
}
