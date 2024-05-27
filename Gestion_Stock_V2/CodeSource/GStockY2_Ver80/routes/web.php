<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthentificationController;

// cella pour importer les controlleurs
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;

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

Route::get('/home', function () {
    return view('home');
})->name('home');
// Route::get('/home', [AuthentificationController::class, 'home_fun'])->name('home');

Route::get('/deconnnecter_fun', [AuthentificationController::class, 'deconnnecter_fun'])->name('deconnnecter_fun');
// Route::get('/home_update/{id_Utilisateur}', [AuthentificationController::class, 'update'])->name('home_update');
Route::match(['put', 'patch'], '/home_update/{id_Utilisateur}', [AuthentificationController::class, 'update'])->name('home_update');

// ceux route pour gerer la gestion des roles
// lien pour afficher page des roles
Route::get('/form_role', function(){
    return view('page_add_role');
})->name('/form_role');

Route::resource('_role_', RoleController::class);

// Routes pour gérer les utilisateurs
Route::get('/form_user', [UserController::class, 'aff_form_user'])->name('form_user');
Route::resource('_user_', UserController::class);


// Routes pour gérer les Categories
Route::get('/form_cate', [CategorieController::class, 'form_categ'])->name('form_cate');
Route::resource('_cate_', CategorieController::class);


// Routes pour gerer les produits
Route::get('/form_prod', [CategorieController::class, 'fun_form_prod'])->name('form_prod');
Route::resource('_prod_', ProduitController::class);
