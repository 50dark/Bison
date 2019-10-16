<?php

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

//Afficher la page d'accueil




Route::get('/', 'Shop\MainController@index')->name('homepage');
//Afficher la page produits dans une catégorie
Route::get('/categorie/{id}', 'Shop\MainController@viewByCategorie')->name('view_by_cat');
//Afficher la page pour consulter le détail d'un produit
Route::get('/produit/{id}', 'Shop\MainController@viewProduct')->name('view_product');
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/panier/add/{id}', 'shop\CartController@add')->name('add_product_cart');
//  afficher le contenue du panier
Route::get('/panier','shop\CartController@index')->name('cart_index');



Route::post('/mt/login','Auth\LoginController@loginMonTshirt')->name('login_montshirt');

//route dependent de l'authantification'
Route::middleware('auth.admin')->group(function (){
    Route::get('/backend','Backend\ProduitController@index')->name('backend_homepage');
    Route::get('/backend/tag','Backend\TagController@index')->name('backend_tag_index');
    Route::get('/backend/tag/add','Backend\TagController@add')->name('backend_tag_add');
    Route::post('/backend/tag/store','Backend\TagController@store')->name('backend_tag_store');
    Route::post('/backend/tag/update','Backend\TagController@update')->name('backend_tag_update');
    Route::get('/backend/tag/edit','Backend\TagController@edit')->name('backend_tag_edit');
    Route::get('/backend/tag/delete','Backend\TagController@delete')->name('backend_tag_delete');

    Route::get('/backend/categorie/add','Backend\CategorieController@add')->name('backend_categorie_add');
    Route::post('/backend/categorie/store','Backend\CategorieController@store')->name('backend_categorie_store');
    Route::post('/backend/categorie/update','Backend\categorieController@update')->name('backend_categorie_update');
    Route::get('/backend/categorie/edit/{id}','Backend\categorieController@edit')->name('backend_categorie_edit');
    Route::post('/backend/categorie/update','Backend\categorieController@update')->name('backend_categorie_update');
    Route::get('/backend/categorie/delete','Backend\categorieController@delete')->name('backend_categorie_delete');

//route stock
    Route::get('backend/produit','Backend\ProduitController@index')->name('backend_produit_index');
    Route::get('/backend/produit/add','Backend\ProduitController@add')->name('backend_produit_add');
    Route::post('/backend/produit/store','Backend\ProduitController@store')->name('backend_produit_store');
    Route::get('/backend/produit/edit/{id}','Backend\ProduitController@edit')->name('backend_produit_edit');
    Route::post('/backend/produit/update/{id}','Backend\ProduitController@update')->name('backend_produit_update');
    Route::get('/backend/produit/edit/{id}','Backend\ProduitController@edit')->name('backend_produit_edit');
    Route::get('/backend/produit/delete','Backend\produitController@delete')->name('backend_produit_delete');

    Route::get('/backend/produit/add/size/{id}','Backend\ProduitController@addSize')->name('backend_produit_add_size');

    Route::post('/backend/produit/store/size/{id}','Backend\ProduitController@storeSize')->name('backend_produit_store_size');

    // requetes Ajax
    Route::post('/backend/produit/select/size','Backend\ProduitController@selectSizeAjax')
        ->name('backend_produit_select_size');
});