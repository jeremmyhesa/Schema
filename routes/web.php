<?php

use App\Models\Category;
use App\Models\Tournament;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TournamentController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminTournamentsController;
use App\Http\Controllers\DashboardTournamentController;

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
    return view('home', [
        "title" => "Home",
        "active" =>"home"
    ]);
});

Route::get('auth/login', [LoginController::class, 'login'])->name('login')
->middleware('guest');
Route::post('auth/login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout']);


Route::get('auth/register', [RegisterController::class, 'login'])
->middleware('guest');
Route::post('auth/register', [RegisterController::class, 'store']);

Route::get('index', function () {
    return view('index');
});

Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/about', function () {
    return view('about|Schema', [
        "title" => "About",
        "active" => "about"

    ]);
});

// Route::get('/dashboard', [TournamentController::class, 'show'])
// ->middleware('auth');
// Route::get('/dashboard', [TournamentController::class, 'index']);

// // Single Page Tournament
// Route::get('/dashboard/{tournament:slug}', [TournamentController::class, 'show']);

Route::get('/categories', function() {
    return view('/dashboard/index',[
        'title' => 'Tournament Categories',
        "active" => 'categories',
        'categories' => Category::all()
    ]);
});

// Route::get('/dashboard', [DashboardTournamentController::class, 'tournaments'])
// ->middleware('auth');
Route::get('/dashboard', [DashboardTournamentController::class, 'tournaments']);
Route::get('/dashboard/index/{tournament:slug}', [DashboardTournamentController::class, 'show']);
Route::get('/dashboard/tournaments/checkSlug', [DashboardTournamentController::class, 'checkSlug'])
->middleware('auth');
Route::resource('/dashboard/tournaments', DashboardTournamentController::class )
->middleware('auth');

Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');
Route::resource('/dashboard/tours', AdminTournamentsController::class)->except('show')->middleware('admin');