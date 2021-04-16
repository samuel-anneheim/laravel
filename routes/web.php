<?php

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
Route::get('/nos-annonces', function () {
    // $properties = DB::select('SELECT * FROM properties');
    // raccourcie
    $properties = DB::table('properties')->get();
    return view('properties/index', [
        'properties' => $properties,
    ]);
});

//voir une annonce
Route::get('/annonce/{id}', function ($id) {
    $property = DB::table('properties')->where('id', $id)->first();
            //  DB::table('properties)->find($id)

    if (! $property) {
        abort(404); // on renvoie une page 404
    }

    return view('properties/show',[
        'properties' => $property,
    ]);
});
