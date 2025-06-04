<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Result;
use Livewire\Component;
use App\Models\TestMark;
use App\Models\StudentDetail;

class CreateResult extends Component
{
    public $result_decision;
    public $loadingStudentId;
    public $current_target_user;
    protected $listeners = ['resultChangeConfirmed' => 'resultChangeConfirmed'];
    public function render()
    {
        $student_entries = TestMark::with(['user.student_details:id,user_id,result'])
            ->paginate(10);
        return view('livewire.create-result', compact('student_entries'));
    }
    public function updateResult($decision, $id)
    {
        $this->loadingStudentId = $id;
        $this->current_target_user = $id;
        $this->result_decision = $decision;
        $this->dispatch('changeResult-alert');
        $this->loadingStudentId = null;
    }
    public function resultChangeConfirmed()
    {
        $userQuery =   User::where('id', $this->current_target_user);
        if($this->result_decision == 'pass'  || $this->result_decision === 'fail' || $this->result_decision === 'In_progress'){
            StudentDetail::where('user_id', $this->current_target_user)->update(['result' => $this->result_decision]);
        }else {
            abort(403,'Invalid result decision.');
        }
        if ($this->result_decision === 'pass') {
            (clone $userQuery)->update(['is_active' => '1']);
        } else if ($this->result_decision === 'fail') {
            (clone $userQuery)->update(['is_active' => '0']);
        } else if ($this->result_decision === 'In_progress') {
            (clone $userQuery)->update(['is_active' => '0']);
        } else {
            abort(404);
        }
        $this->dispatch(
            'resultChange-success',
            title: 'Success!',
            text: "Result has been Updated successfully.",
            icon: 'success',
        );
    }
}
