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

// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', 'MainController@index')->name('main.index');
Route::get('barcode', 'MainController@barcode');
//Route::get('personnel','PersonnelController@index')->name('personnel.index');



Auth::routes();
//Auth::routes(['register' => false]);
Route::resource('user','UserController');

Route::resource('produits','ProduitsController');
Route::resource('famille','FamilleController');
Route::resource('fournisseur','FournisseurController');
Route::resource('technicien','TechnicienController');

/* Cart Routes */
Route::get('/panier','CartController@index')->name('cart.index');
Route::post('/panier/ajouter','CartController@store')->name('cart.store');
Route::get('/videpanier','CartController@videpanier')->name('cart.videpanier');
Route::put('/panier/{rowId}','CartController@update')->name('cart.update');
Route::delete('/panier/{rowId}','CartController@destroy')->name('cart.destroy');

/*Entrees en stock*/
Route::resource('entree','EntreeController');
Route::get('entree/{id}','EntreeController@listeEntreByproduit')->name('entree.liste');

/*Sortie*/
Route::resource('sorties','SortieController');
Route::get('sortieProduit','SortieController@sortieProduit')->name('sortie.sortieProduit');

/**Retour En Stock */
Route::resource('retourStocks','RetourStockController');
/*PDF GENERATOR*/
Route::get('pdf/{id}','PDFMAkerController@gen')->name('pdf.invoice');
Route::get('listingTechnicien','PDFMAkerController@listingTechnicien')->name('pdf.listingTechnicien');
Route::get('listingUsers','PDFMAkerController@listingUsers')->name('pdf.listingUsers');
Route::get('listingFamilles','PDFMAkerController@listingFamilles')->name('pdf.listingFamilles');
Route::get('listingProduits','PDFMAkerController@listingProduits')->name('pdf.listingProduits');
Route::get('listingFournisseurs','PDFMakerController@listingFournisseur')->name('pdf.listingFournisseurs');
Route::get('listingRetourStocks/{id}','PDFMakerController@listingRetourStocks')->name('pdf.listingRetourStocks');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

