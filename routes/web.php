<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Mail\JobPosted;
use Illuminate\Support\Facades\Route;

Route::get("test", function () {
    $job = \App\Models\Job::first();

    TranslateJob::dispatch($job);
    

    return 'Done';
});


Route::view('/', 'home');
Route::view('/contact', 'contact');

// Route::resource('job', JobController::class);
Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/create', [JobController::class, 'create']);
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
Route::get('/jobs/{job}', [JobController::class, 'show']);

Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'job');

Route::get('/register', [RegisteredUserController::class,'create']);
Route::post('/register', [RegisteredUserController::class,'store']);

Route::get('/login', [SessionController::class,'create'])->name('login');
Route::post('/login', [SessionController::class,'store']);
Route::post('/logout', [SessionController::class,'destroy']);

