<?php
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\CustomAuthController ;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;


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

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [EtudiantController::class, 'index'])->name('blog.home');


Route::get('/etudiant/{etudiant}/edit', [EtudiantController::class, 'edit'])->name('blog.edit');
Route::put('/etudiant/{etudiant}', [EtudiantController::class, 'update'])->name('etudiantUpdate');
Route::get('/etudiant/create', [EtudiantController::class, 'create'])->name('blog.create');
Route::post('/etudiant/create', [EtudiantController::class, 'store'])->middleware('auth');
Route::get('etudiant/{etudiantId}', [EtudiantController::class, 'show'])->name('blog.show');
// Route::delete('etudiant/{etudiant}', [EtudiantController::class, 'destroy']);
Route::delete('/etudiants/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.destroy');
Route::get('/login', [CustomAuthController::class, 'index'])->name('login');
Route::post('/login', [CustomAuthController::class, 'authentication'])->name('login.authentication');
Route::get('/logout', [CustomAuthController::class, 'logout'])->name('logout');


Route::get('/registration', [CustomAuthController::class, 'create'])->name('user.registration');
Route::post('/registration-store', [CustomAuthController::class, 'store'])->name('user.store');
Route::get('/lang/{locale}', [LocalizationController::class, 'index'])->name('lang');
//FORUM   PAS FINI
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create')->middleware('auth');
Route::post('/forum', [ForumController::class, 'store'])->name('forum.store')->middleware('auth');
Route::get('/forum/{id}/edit', [ForumController::class, 'edit'])->name('forum.edit')->middleware('auth');
Route::put('/forum/{id}', [ForumController::class, 'update'])->name('forum.update')->middleware('auth');
Route::delete('/forum/{id}', [ForumController::class, 'destroy'])->name('forum.destroy')->middleware('auth');

//FILE
Route::get('/files', [FileController::class, 'index'])->name('files.index')->middleware('auth');
Route::get('/files/create', [FileController::class, 'create'])->name('files.create')->middleware('auth');
Route::post('/files', [FileController::class, 'store'])->name('files.store')->middleware('auth');
Route::delete('/files/{id}', [FileController::class, 'destroy'])->name('files.destroy')->middleware('auth');

//create user
Route::get('/blog/createUser', [UserController::class, 'index'])->name('user.index');
Route::post('/users', [UserController::class, 'store'])->name('users.store');




