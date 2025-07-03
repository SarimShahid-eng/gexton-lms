<?php

namespace App\Livewire;

use App\Models\StudentRegister;
use Livewire\Component;

class ShowStudent extends Component
{
    public function render()
    {
        $students =  StudentRegister::where('is_enrolled', 1)->paginate(10);
        return view('livewire.show-student',compact('students'));
    }
}
