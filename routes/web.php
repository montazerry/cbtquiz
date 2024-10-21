<?php

use App\Models\StudentAnswer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\CourseQuetionController;
use App\Http\Controllers\CourseStudentController;
use App\Http\Controllers\StudentAnswerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('dashboard')->name('dashboard.')->group(function(){

        Route::resource('courses', CourseController::class)->middleware('role:teacher');
        
        Route::get('/course/quetion/create/{course}',[CourseQuetionController::class], 'create')
            ->middleware('role:teacher')
            ->name('course.create.question');

        Route::post('/course/quetion/save/{course}',[CourseQuetionController::class], 'store')
            ->middleware('role:teacher')
            ->name('course.create.question.store');

        Route::resource('courses_quetions', CourseQuetionController::class)->middleware('role:teacher');
        
        Route::get('/course/students/show/{course}',[CourseStudentController::class],'index')
            ->middleware('role:teacher')
            ->name('course.students.index');

        Route::get('/course/students/create/{course}',[CourseStudentController::class],'create')
            ->middleware('role:teacher')
            ->name('course.students.create');

        Route::post('/course/students/save/{course}',[CourseStudentController::class],'store')
            ->middleware('role:teacher')
            ->name('course.students.create');

        Route::get('/learning/finished/{course}',[LearningController::class],'learning_finisher')
            ->middleware('role:student')
            ->name('course.finished.course');

        Route::get('/learning/rapport/{course}',[LearningController::class],'learning_rapport')
            ->middleware('role:student')
            ->name('course.rapport.course');

        // menampilkan class yang diberikan oleh guru 
        Route::get('/learning',[LearningController::class,'index'])
            ->middleware('role:student')
            ->name('learning.index');

        Route::get('/learning/{course}/{question}',[LearningController::class,'learning'])
            ->middleware('role:student')
            ->name('learning.course');

        Route::post('/learning/{course}/{question}',[StudentAnswerController::class,'store'])
            ->middleware('role:student')
            ->name('learning.course.anwer.store');



    });
});

require __DIR__.'/auth.php';
