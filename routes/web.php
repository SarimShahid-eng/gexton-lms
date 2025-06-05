<?php

use App\Livewire\Batch;
use App\Livewire\Campus;
use App\Livewire\Students;
use App\Livewire\TeacherTask;
use Livewire\Livewire;
use App\Livewire\Group;
use App\Livewire\Teacher;
use App\Livewire\Question;
use App\Livewire\Dashboard;
use App\Livewire\EntryTest;
// use App\Livewire\CreatePost;
use App\Livewire\CreateTask;
use App\Livewire\UploadTask;
use App\Livewire\EditProfile;
use App\Livewire\CreateCourses;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/gexton_lms/public/livewire/update', $handle);
});
Route::get('/', function () {
    return view('welcome');
})->name('welcome');


