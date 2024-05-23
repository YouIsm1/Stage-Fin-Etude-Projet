<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthentificationController;

// cella pour importer les controlleurs
use App\Http\Controllers\RoleController;

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
    return view('anthentication_page');
});


Route::post('/authentification', [AuthentificationController::class, 'AuthenFun'])->name('authentification');

Route::get('/test', function () {
    return view('test');
});

Route::get('/test2', function () {
    return view('test2');
});


// Route::get('/test2', [AuthentificationController::class, 'test2'])->name('test2');

Route::get('/deconnnecter_fun', [AuthentificationController::class, 'deconnnecter_fun'])->name('deconnnecter_fun');


// ceux route pour gerer la gestion des roles
// lien pour afficher page des roles
Route::get('/form_role', function(){
    return view('page_add_role');
});

// Route::res
Route::resource('_role_', RoleController::class);