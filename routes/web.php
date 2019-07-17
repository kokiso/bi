<?php
$this->group(['middleware'=>'auth'],function(){

    $this->get('admin','Admin\AdminController@index')->name('admin.home');

    $this->get('placa','Placa\PlacaController@index')->name('placas.home');
    $this->get('placa/ranking','Placa\PlacaController@rankingview')->name('placas.ranking');
    $this->get('placa/dashboard','Placa\PlacaController@dashboardview')->name('placas.dashboard');

    $this->get('evento','Evento\EventoController@index')->name('eventos.home');
    $this->get('evento/velocidade','Evento\EventoController@velocidadeview')->name('eventos.velocidade');
    $this->get('evento/dashboard','Evento\EventoController@dashboardview')->name('eventos.dashboard');

    //importacao evento
    $this->get('evento/export', 'Evento\EventoController@export2')->name('export2');
    $this->get('evento/importacao', 'Evento\EventoController@importview')->name('eventos.importacao');
    $this->post('evento/import', 'Evento\EventoController@import2')->name('import2');

    //importacao placa
    $this->get('placa/export', 'Placa\PlacaController@export')->name('export');
    $this->get('placa/importacao', 'Placa\PlacaController@importview')->name('placas.importacao');
    $this->post('placa/import', 'Placa\PlacaController@import')->name('import');

    //importacao das tabelas auxiliares
    $this->post('bc/frotaImport', 'bc\BcController@frotaImport')->name('frotaImport');
    $this->post('bc/motoristaImport', 'bc\BcController@motoristaImport')->name('motoristaImport');
    $this->get('bc/frota', 'bc\BcController@frotaview')->name('bc.frota');
    $this->get('bc/motorista', 'bc\BcController@motoristaview')->name('bc.motorista');

    //Meta media
    $this->get('formulario', 'MetaMediaController@formulario')->name('formulario');
    $this->post('update', 'MetaMediaController@update')->name('update');
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
