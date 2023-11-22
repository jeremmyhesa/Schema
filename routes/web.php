<?php

use App\Models\User;
use App\Models\Category;
use App\Models\Tournament;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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
Route::get('dashboard/about', function (User $user) {
    return view('dashboard/about', [
        "title" => "About",
        "active" => "about",
        "users" => $user->all()

    ]);
});


Route::get('/dashboard', [DashboardTournamentController::class, 'tournaments']);

// Route::get('/dashboard/index/{tournament:slug}', [DashboardTournamentController::class, 'show']);

// Participants
Route::get('/dashboard/tournaments/{tournament:slug}/participants', [DashboardTournamentController::class, 'participants'])->name('participants');
Route::post('dashboard/tournaments/{tournament:slug}/participants', [DashboardTournamentController::class, 'add']);
Route::get('dashboard/tournaments/{tournament:slug}/manage', [DashboardTournamentController::class, 'manage'])->name('manage');
Route::put('dashboard/tournaments/{tournament:slug}/manage/{team:id}', [DashboardTournamentController::class, 'upgrade']);
Route::delete('dashboard/tournaments/{tournament:slug}/manage/{team:id}', [DashboardTournamentController::class, 'delete']);
Route::put('dashboard/tournaments/{tournament:slug}/manage', [DashboardTournamentController::class, 'shuffle']);

// Make Game
Route::post('dashboard/tournaments/{tournament:slug}/manage', [DashboardTournamentController::class, 'save']);


// 
Route::get('/dashboard/tournaments/checkSlug', [DashboardTournamentController::class, 'checkSlug'])
->middleware('auth');

Route::resource('/dashboard/tournaments', DashboardTournamentController::class )
->middleware('auth');

// Admin
Route::get('/dashboard/tours', [AdminTournamentsController::class, 'index'])->middleware('admin');

// Category
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');
Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])
->middleware('auth');

// Route::resource('dashboard/participants', TeamController::class);


