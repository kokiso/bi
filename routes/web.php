<?php
$this->group(['middleware'=>'auth'],function(){

    $this->get('admin','Admin\AdminController@index')->name('admin.home');
    $this->get('evento','Evento\EventoController@index')->name('eventos.home');
    $this->get('placa','Placa\PlacaController@index')->name('placas.home');

    //importacao evento
    $this->get('evento/export', 'Evento\EventoController@export2')->name('export2');
    $this->get('evento/importacao', 'Evento\EventoController@importview')->name('eventos.importacao');
    $this->post('evento/import', 'Evento\EventoController@import2')->name('import2');

    //importacao placa
    $this->get('placa/export', 'Placa\PlacaController@export')->name('export');
    $this->get('placa/importacao', 'Placa\PlacaController@importview')->name('placas.importacao');
    $this->post('placa/import', 'Placa\PlacaController@import')->name('import');
});

Route::get('/','Site\SiteController@index')->name('home');

Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
