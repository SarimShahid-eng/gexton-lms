<?php

namespace App\Livewire;
use App\Models\Course;
use App\Models\CustomSession;
use App\Models\Question as DataQuestion;
use Livewire\Component;
class Question extends Component
{
    public $course_id, $session_year_id, $title, $question, $id, $options = [], $correct_answer;

    public function render()
    {
        $questions = DataQuestion::with(['course','session'])->paginate(100);
        $courses = Course::get();
        $session_active = CustomSession::where('is_selected', 1)->first();
        $this->session_year_id = $session_active->id;

        return view('livewire.question', compact('questions','courses', 'session_active'));
    }
    public function save()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'course_id' => 'required|integer',
            'session_year_id' => 'required|integer',
            'question' => 'required|string',
            'correct_answer' => 'required',
        ];
        $messages = [
            'title.required' => 'The title is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title must not exceed 255 characters.',
            'course_id.required' => 'Please select a course.',
            'course_id.integer' => 'Invalid course selected.',
            'question.required' => 'The question field cannot be empty.',
            'question.string' => 'The question must be valid text.',
            'correct_answer.required' => 'Please mark one option as the correct answer.',
        ];
        $validatedData = $this->validate($rules, $messages);
        $validatedData['options'] = serialize(json_decode($this->options, true));

        DataQuestion::updateOrCreate(
            ['id' => $this->id],
            $validatedData
        );
        $message = $this->id ? 'updated' : 'saved';

        $this->reset();
        $this->dispatch(
            'question-saved',
            title: 'Success!',
            text: "Question has been $message successfully.",
            icon: 'success',
        );
    }
    public function edit($id)
    {
        $question = DataQuestion::find($id);

        $this->course_id = $question->course_id;
        $this->session_year_id = $question->session_id;
        $this->title = $question->title;
        $this->question = $question->question;
        $this->correct_answer = $question->correct_answer;
        $this->options = $question->options;
        $this->id = $id;
        $this->dispatch('edit-question-loaded',
            options : unserialize($this->options),
            correct_answer : $this->correct_answer,
        );
    }
    // public function confirmDelete($q_id)
    // {
    //     $this->id = $q_id;
    //     $this->dispatch('swal-confirm');
    // }
    // public function deleteCourse()
    // {
    //     DataQuestion::destroy($this->id);
    //     $this->dispatch('question-deleted', title: 'Deleted!', text: 'Question has been deleted successfully.', icon: 'success');
    // }

}
