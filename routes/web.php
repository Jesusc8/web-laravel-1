<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AnswerPostController;
use App\Http\Controllers\PostController;

Route::get('/', [PageController::class, 'index'])->name('home');

Route::get('foro', [QuestionController::class, 'index'])->name('questions.index');
Route::get('blog', [PostController::class, 'index'])->name('posts.index');


Route::get('foro/crear', [QuestionController::class, 'create'])->name('questions.create')->middleware('auth'); //mostrar el diseno del formulario
Route::post('foro', [QuestionController::class, 'store'])->name('questions.store')->middleware('auth');; //guardar la informacion del formulario en BD




Route::get('foro/{question:slug}/editar', [QuestionController::class, 'edit'])->name('questions.edit')->middleware('auth');; //Muestra el formulario
Route::put('foro/{question:slug}', [QuestionController::class, 'update'])
    ->name('questions.update')
    ->middleware('auth', 'can:update,question'); //Actualiza la informacion en BD


Route::get('foro/{question:slug}', [QuestionController::class, 'show'])->name('questions.show');
Route::delete('questions/{question:slug}', [QuestionController::class, 'destroy'])->name('questions.destroy')->middleware('auth', 'can:delete,question');


Route::get('blog/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::delete('blog/{post:slug}', [PostController::class, 'destroy'])
    ->name('posts.destroy')
    ->middleware('auth', 'can:delete,post');

Route::get('blog/crear', [PostController::class, 'create'])->name('posts.create')->middleware('auth'); //mostrar el diseno del formulario
Route::post('blog', [PostController::class, 'store'])->name('posts.store')->middleware('auth');; //guardar la informacion del formulario en BD


Route::get('blog/{post:slug}/editar', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');; //Muestra el formulario
    
Route::put('blog/{post:slug}', [PostController::class, 'update'])->name('posts.update')->middleware('auth', 'can:update,post'); //Actualiza la informacion en BD

Route::post('/answers/{question}', [AnswerController::class, 'store'])->name('answers.store')->middleware('auth');
Route::post('/answer_posts/{post}', [AnswerPostController::class, 'store'])->name('answerspost.store')->middleware('auth');; //guardar la informacion del formulario en BD


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
