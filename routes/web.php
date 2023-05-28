<?php
use App\Http\Controllers\EtudiantController;
use Illuminate\Support\Facades\Route;

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
Route::post('/etudiant/create', [EtudiantController::class, 'store']);
Route::get('etudiant/{etudiantId}', [EtudiantController::class, 'show'])->name('blog.show');
// Route::delete('etudiant/{etudiant}', [EtudiantController::class, 'destroy']);
Route::delete('/etudiants/{etudiant}', [EtudiantController::class, 'destroy'])->name('etudiant.destroy');


