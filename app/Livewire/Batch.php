<?php

namespace App\Livewire;

use App\Models\Campus as BatchGroup;
// Batch acting as campus
use App\Models\Batch as Campus;
use App\Models\Phase;
use Livewire\Component;
use Livewire\WithPagination;

class Batch extends Component
{
    // Notes Campus Everuwhere denotes batch
    use WithPagination;
    protected $paginationTheme = 'tailwind';

    public $campus_id, $title, $description, $id, $search = '', $phase_id,$campuses = [];
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $phases = Phase::get();
        // campus are batches and
        $batches = Campus::with(['campus.phase','campus'])->where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return view('livewire.batch', compact('batches', 'phases'));
    }
    public function updatedPhaseId($value)
    {
        $this->campuses = BatchGroup::where('phase_id', $value)->get();
        $this->campus_id = null; // reset selected campus
    }
    public function save()
    {
        $rules = [
            'title' => 'required|unique:batches,title,' . $this->id,
            'description' => 'required',
            'campus_id' => 'required|exists:campuses,id',
            'phase_id' => 'required|exists:phases,id',
        ];
        $messages = [
            'title.required' => 'The title is required.',
            'description.required' => 'The description is required.',
            'campus_id.required' => 'The campus is required.',
            'phase_id.required' => 'The campus is required.'
        ];
        // Validate the data
        $validatedData = $this->validate($rules);
        unset($validatedData['phase_id']);
    //    $validatedData
        Campus::updateOrCreate(
            ['id' => $this->id],
            $validatedData
        );
        $message = $this->id ? 'updated' : 'saved';
        $this->reset();
        $this->dispatch(
            'batches-saved',
            title: 'Success!',
            text: "Campus has been $message successfully.",
            icon: 'success',
        );
        sleep(1);

        return redirect()->route('show_batches');
    }
    public function edit($id)
    {
        $batch = Campus::find($id);
        $this->title = $batch->title;
        $this->description = $batch->description;
        $this->campus_id = $batch->campus_id;
        $this->phase_id = $batch->campus->phase->id;
        $this->id = $id;
        $this->campuses = BatchGroup::where('phase_id', $this->phase_id)->get();
    }
    // public function toggleStatus($id)
    // {

    //     $batch = BatchGroup::findOrFail($id);
    //     $batch->status = !$batch->status;
    //     $batch->save();

    //     $statusText = $batch->status ? 'activated' : 'deactivated';

    //     $this->dispatch(
    //         'batches-saved',
    //         title: 'Success!',
    //         text: "Campus has been $statusText successfully.",
    //         icon: 'success',
    //     );
    // }
}
