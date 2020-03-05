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

/*
| ----------------------------------------------------------------------------------------------------------------
| Estamos cirando uma Rota(Route) com verbo Http GET(::get), e quando acessar /(Barra) o php vai executar a função
| que retorna(return) uma View chamada Welcome.
| ----------------------------------------------------------------------------------------------------------------
*/

Route::get('/series', 'SeriesController@index');
Route::get('/series/criar', 'SeriesController@create');