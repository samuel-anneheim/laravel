<?php

use App\Http\Controllers\PropertyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    return view('home');
});

Route::get('/a-propos', function () {
    return view('about', [
        'name' => 'Samuel',
        'bibis' => [1, 2, 3, 4],
    ]);
});

route::get('/hello/{name?}', function ($name = 'Samuel') {
    return "<h1>Hello $name</h1>";
})->where('name', '.{2,}');

//afficher les annonces 
Route::get('/nos-annonces', [PropertyController::class, 'index']);
Route::get('/los-annoncas', [PropertyController::class, 'index']);

//voir une annonce
Route::get('/annonce/{property}', [PropertyController::class, 'show'])->whereNumber('property');
Route::get('/annonce/{id}', [PropertyController::class, 'show'])->whereNumber('id');

Route::get('annonce/creer', [PropertyController::class, 'create']);

Route::post('/annonce/creer', [PropertyController::class, 'store']);

Route::get('/annonce/editer/{id}', [PropertyController::class, 'edit']);

Route::put('/annonce/editer/{id}', [PropertyController::class, 'update']);

Route::delete('/annonce/{id}', [PropertyController::class, 'destroy']);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
