<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DisciplineController;
use App\Http\Controllers\FrequenceController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentDisciplineController;
use App\Http\Controllers\TeacherController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/discipline', [DisciplineController::class, 'index'])->name('discipline.index');
Route::post('/discipline', [DisciplineController::class, 'create'])->name('discipline.create');
Route::put('/discipline/{id}', [DisciplineController::class, 'update'])->name('discipline.update');
Route::delete('/discipline/{id}', [DisciplineController::class, 'destroy'])->name('discipline.destroy');

Route::get('/student', [StudentController::class, 'index'])->name('student.index');
Route::post('/student', [StudentController::class, 'create'])->name('student.create');
Route::delete('/student/{id}', [StudentController::class, 'destroy'])->name('student.destroy');

Route::get('/student/{id}/disciplines', [StudentDisciplineController::class, 'index'])->name('studentdiscipline.index');
Route::post('/student/{id}/disciplines', [StudentDisciplineController::class, 'create'])->name('studentdiscipline.create');
Route::delete('/student/{id}/disciplines', [StudentDisciplineController::class, 'destroy'])->name('studentdiscipline.destroy');
Route::get('/discipline/{id}/students', [StudentDisciplineController::class, 'listStudents'])->name('discipline.listStudents');

Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
Route::post('/teacher', [TeacherController::class, 'create'])->name('teacher.create');
Route::delete('/teacher/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');
Route::get('/teacher/{id}/minister', [TeacherController::class, 'minister'])->name('teacher.minister');
Route::get('/teacher/{id}/students', [TeacherController::class, 'allStudents'])->name('teacher.allStudents');

Route::post('/frequence', [FrequenceController::class, 'create'])->name('frequence.create');

Route::post('/note', [NoteController::class, 'create'])->name('note.create');
