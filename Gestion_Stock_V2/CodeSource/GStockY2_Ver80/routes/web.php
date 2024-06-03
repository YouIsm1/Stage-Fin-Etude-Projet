<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthentificationController;

// cella pour importer les controlleurs
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ProduitCommandeController;
use App\Http\Controllers\FactureController;

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
Route::get('/form_prod', [ProduitController::class, 'fun_form_prod'])->name('form_prod');
Route::get('_prod_Detailles', [ProduitController::class, 'fun_prod_Detailles'])->name('_prod_Detailles');
Route::resource('_prod_', ProduitController::class);

// Routes pour gérer le stock
Route::get('/form_stock', [StockController::class, 'fun_form_stock'])->name('form_stock');
Route::resource('_stock_', StockController::class);

// Routes pour gérer les commandes
Route::get('/form_Comm', [CommandeController::class, 'fun_form_Comm'])->name('form_Comm');
// Route::get('/form_dtl_Comm/{id_Commande}', [CommandeController::class, 'dtl_fun_comm'])->name('form_dtl_Comm');
Route::get('/form_dtl_Comm/{id_Commande}', [CommandeController::class, 'dtl_fun_comm'])->name('form_dtl_Comm');
// Route::get('/Comm_Ass_prod/{id_Commande}', [CommandeController::class, 'Comm_Ass_prod_Fun'])->name('Comm_Ass_prod');
Route::post('/Comm_Ass_prod/{id_Commande}', [CommandeController::class, 'Comm_Ass_prod_Fun'])->name('Comm_Ass_prod');
// Route::match(['put', 'patch'], '/form_dtl_Comm/{id_Commande}', [CommandeController::class, 'dtl_fun_comm'])->name('form_dtl_Comm');
Route::resource('_Comm_', CommandeController::class);


// Routes pour gérer les produits commandes
Route::resource('_Prod_Comm_', ProduitCommandeController::class);


// Routes pour gérer les produits commandes
Route::resource('_Fact_', FactureController::class);