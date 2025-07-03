<?php

use App\Livewire\Quiz;
use Livewire\Livewire;
use App\Livewire\Batch;
use App\Livewire\Campus;
use App\Livewire\Course;
use App\Livewire\Student;
use App\Livewire\Question;
use App\Livewire\Dashboard;
use App\Livewire\EditProfile;
use App\Livewire\QuizStudent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Livewire\StartTest;

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/gexton-lms-mehran/public/livewire/update', $handle);
});

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', Dashboard::class)->name('dashboard');
        Route::get('/profile', EditProfile::class)->name('show_profile');
        Route::get('/show-campus', Campus::class)->name('show_campus');
        Route::get('/show-batches', Batch::class)->name('show_batches');
        Route::get('show-courses', Course::class)->name('courses_create');
    });
    Route::middleware('role:student')->name('student.')->group(function () {
        Route::get('show-quiz', QuizStudent::class)->name('show_quiz');
        Route::get('start-test/{id}', StartTest::class)->name('start_test');
    });
    Route::middleware('role:teacher')->name('teacher.')->group(function () {
        Route::get('show-quiz-teacher', Quiz::class)->name('show_quiz');
        Route::get('show-questions', Question::class)->name('show_questions');
    });
});
Route::get('/student-register', Student::class)->name('student');

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('login_attemept', 'authenticate')
        // login request 5 times in 1 minute per ip
        // user can request only 5 times to login attempt in 1 minute then he will try after a minute
        ->middleware('throttle:5,1')
        ->name('login.attempt');
    Route::post('/logout', 'logout')->name('logout');
});
