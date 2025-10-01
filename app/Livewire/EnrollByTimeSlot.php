<?php

namespace App\Livewire;

use App\Models\EnrollStudent;
use Illuminate\Support\Facades\Config;
use Livewire\Component;

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
        $centerLabels = array_keys(Config::get('filters.study_centers', []));
        $groupedSlotsMap = [
            'Morning' => ['9 AM to 12 PM'],
            'Afternoon' => ['12 PM to 3 PM'],
            'Early Evening' => ['3 PM to 6 PM'],
            'Late Evening' => ['6 PM to 9 PM'],
            'Weekend' => ['Sat & Sun (Weekend)'],
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

        // --- QUERY NOW FROM ENROLLSTUDENT ---
        $enrollmentCounts = EnrollStudent::query()
            ->where('cancel_enrollment', 0) // exclude cancelled
            ->whereHas('registered_student', function ($q) {
                $q->where('enrolled_status', 1); // only enrolled students
            })
            ->with('registered_student')
            ->get()
            ->groupBy(function ($enroll) {
                return $enroll->registered_student->preferred_study_center.'|'.
                       $enroll->registered_student->preferred_time_slot;
            })
            ->map(function ($group) {
                return $group->count();
            });

        // 3. Process results
        foreach ($enrollmentCounts as $key => $count) {
            [$centerName, $dbTimeSlotValue] = explode('|', $key);
            $centerIndex = array_search($centerName, $centerLabels);
            $groupName = null;
            foreach ($groupedSlotsMap as $group => $slots) {
                if (in_array($dbTimeSlotValue, $slots)) {
                    $groupName = $group;
                    break;
                }
            }

            if ($centerIndex !== false && $groupName) {
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

        // 4. Final package
        $this->timeSlotData = [
            'labels' => $centerLabels,
            'colors' => $this->colors,
        ];
    }

    public function render()
    {
        return view('livewire.enroll-by-time-slot');
    }
}
