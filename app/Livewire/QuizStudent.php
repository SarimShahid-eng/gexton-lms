<?php

namespace App\Livewire;

use App\Models\Quiz;
use Livewire\Component;

class QuizStudent extends Component
{
    public function render()
    {
        $quizes = Quiz::all();
        return view('livewire.quiz-student', compact('quizes'));
    }
    public function redirecToQuiz($id)
    {
        return  redirect()->route('student.start_test', ['id' => $id]);
    }
}
