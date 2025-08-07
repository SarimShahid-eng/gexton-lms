<?php

namespace App\Livewire;

use App\Models\Batch;
use App\Models\Campus;
use App\Models\Course;
use Livewire\Component;
use App\Models\Question;
use App\Models\QuizQuestion;
use App\Models\Quiz as QuizModel;

class Quiz extends Component
{
    public $title, $description, $duration, $marks, $id, $course_id, $updatedCampusId, $teachersAddedQuestion, $checkedId;
    //   dependent dropdowns vars declare
    public $batches, $courses, $campuses = [];
    // declaring it for hook call on modal live
    public $selectedCampus = null;
    public $selectedBatch = null;
    public array $selectedRows = [];
    public function mount()
    {
        $this->campuses = Campus::all();
    }
    public function render()
    {
        $quizes = QuizModel::paginate(10);
        return view('livewire.quiz', compact('quizes'));
    }
    public function updatedSelectedCampus($campus)
    {
        $this->batches = Batch::where('status', '1')->where('campus_id', $campus)->select('id', 'campus_id', 'title')->get();
        $this->selectedBatch = null;
        $this->courses = null;
    }
    public function updatedSelectedBatch($batch)
    {
        if (empty($batch)) {
            $this->courses = null;
            $this->selectedCampus = null;
        }
        $this->courses = Course::where('batch_id', $batch)->select('id', 'title', 'batch_id')->get();
    }
    public function save()
    {
        $rules = [
            'selectedRows' => 'required',
            'title' => 'required',
            'description' => 'required',
            'marks' => 'required',
            'duration' => 'required',
            'course_id' => 'required',
            'selectedBatch' => 'required',
            'selectedCampus' => 'required'
        ];

        $messages = [
            'title.required' => 'The title is required.',
            'description.required' => 'The description is required.',
            'marks.required' => 'The marks is required.',
            'duration.required' => 'The duration is required.',
            'group_id.required' => 'The group is required.',
            'course_id.required' => 'The course is required.',
            'selectedCampus.required' => 'The selected Campus is required.',
            'selectedBatch.required' => 'The selected Batch is required.',
            'selectedRows.required' => 'You must select a question to proceed.',
        ];
        $validatedData = $this->validate($rules, $messages);
        // After validation, rename the keys
        $validatedData['campus_id'] = $validatedData['selectedCampus'];
        $validatedData['batch_id'] = $validatedData['selectedBatch'];
        $validatedData['teacher_id'] = auth()->id();
        // Remove the original keys
        unset($validatedData['selectedCampus']);
        unset($validatedData['selectedBatch']);
        $validatedData['duration'] = $this->convertMinutesToTime($this->duration);
        $createdQuiz =    QuizModel::updateOrCreate(
            ['id' => $this->id],
            $validatedData
        );

        QuizQuestion::where('quiz_id', $createdQuiz->id)->delete();
        $quizQuestion = [];
        foreach ($this->selectedRows as $questionId) {
            $quizQuestion[] = [
                'question_id' => $questionId,
                'quiz_id' => $createdQuiz->id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        if (!empty($quizQuestion)) {
            QuizQuestion::insert($quizQuestion);
        }
        $message = $this->id ? 'updated' : 'saved';

        $this->reset();
        $this->dispatch(
            'quiz-saved',
            title: 'Success!',
            text: "Quiz has been $message successfully.",
            icon: 'success',
        );
    }
    public function showQuestionTeacherWise()
    {
        $this->teachersAddedQuestion = Question::where('teacher_id', auth()->id())->get();
        $this->dispatch('question-grab-complete');
    }

    public function edit($id)
    {
        $quiz = QuizModel::findOrFail($id);
        $this->title = $quiz->title;
        $this->description = $quiz->description;
        $this->id = $quiz->id;
        $this->updatedCampusId = $quiz->campus_id;
        $this->updatedSelectedCampus($quiz->campus_id);
        $this->updatedSelectedBatch($quiz->batch_id);
        $this->duration = $this->timeToMinutes($quiz->duration);
        $this->marks = $quiz->marks;
        $this->selectedRows =  QuizQuestion::where('quiz_id', $id)->pluck('question_id')->toArray();
        $this->showQuestionTeacherWise();
    }
    public function convertMinutesToTime($totalMinutes)
    {
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        return str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' .
            str_pad($minutes, 2, '0', STR_PAD_LEFT) . ':00';
    }
    public function timeToMinutes($time)
    {
        [$hours, $minutes, $seconds] = explode(':', $time);
        return ((int)$hours * 60) + (int)$minutes;
    }
}
