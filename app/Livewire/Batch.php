<?php

namespace App\Livewire;

use App\Models\Batch as BatchGroup;
use App\Models\Campus;
use Livewire\Component;
use Livewire\WithPagination;

class Batch extends Component
{
    use WithPagination;
    protected $paginationTheme='tailwind';

    public $campus_id, $title, $description, $id;
    public function render()
    {
        $campuses = Campus::get();
        $batches = BatchGroup::with('campus', )->paginate(10);
        return view('livewire.batch', compact('batches', 'campuses'));
    }
    public function save()
    {
        $rules = [
            'title' => 'required|unique:batches,title,' . $this->id,
            'description' => 'required',
            'campus_id' => 'required|exists:campuses,id',
        ];
        $messages = [
            'title.required' => 'The title is required.',
            'description.required' => 'The description is required.',
            'campus_id.required' => 'The campus is required.'
        ];
        // Validate the data
        $validatedData = $this->validate($rules);
        BatchGroup::updateOrCreate(
            ['id' => $this->id],
            $validatedData
        );
        $message = $this->id ? 'updated' : 'saved';
        $this->reset();
        $this->dispatch(
            'batches-saved',
            title: 'Success!',
            text: "Batch has been $message successfully.",
            icon: 'success',
        );
        sleep(1);

        return redirect()->route('show_batches');
    }
    public function edit($id)
    {
        $batch = BatchGroup::find($id);
        $this->title = $batch->title;
        $this->description = $batch->description;
        $this->campus_id = $batch->campus_id;
        $this->id = $id;
    }
    public function toggleStatus($id)
    {
        // dd($id);
        $batch = BatchGroup::findOrFail($id);
        // dd($batch);
        $batch->status = !$batch->status;
        $batch->save();

        $statusText = $batch->status ? 'activated' : 'deactivated';

        $this->dispatch(
            'batches-saved',
            title: 'Success!',
            text: "Batch has been $statusText successfully.",
            icon: 'success',
        );
    }
}
