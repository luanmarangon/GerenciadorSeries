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

Route::get('/', function () {
    return redirect('/entrar');
});

Route::get('/series', 'SeriesController@index')
    ->name('listar_series');
Route::get('/series/criar', 'SeriesController@create')
    ->name('criar_serie');
Route::post('/series/criar', 'SeriesController@store');
//removendo via form com method post
Route::post('/series/remover/{id}', 'SeriesController@destroy');
Route::post('/series/{id}/editaNome', 'SeriesController@editaNome');


Route::get('/series/{serieId}/temporadas', 'TemporadasController@index')
                                            ->name('listar_temporadas');
Route::post('/series/{serie}/temporadas/new', 'TemporadasController@add');
Route::post('/series/{serie}/temporadas/destroyAll', 'TemporadasController@destroyAll');

Route::get('temporadas/{temporada}/episodios', 'EpisodiosController@index')
                                            ->name('episodios_index');

Route::get('/temporadas/destroy/{temporada}', 'TemporadasController@destroy');

Route::post('temporadas/{temporada}/episodios/assistir', 'EpisodiosController@assistir');
Route::get('temporadas/{temporada}/episodios/new', 'EpisodiosController@add');
//Route::get('/episodios/{temporada}/destroy/{episodio}', 'EpisodiosController@destroy');
Route::get('/episodios/destroy/{episodio}', 'EpisodiosController@destroy');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/entrar', 'EntrarController@index')
    ->name('entrar');
Route::post('/entrar', 'EntrarController@entrar');

Route::get('/registrar', 'RegistroController@create');
Route::post('/registrar', 'RegistroController@store');

Route::get('/users', 'UsersController@index')
                        ->name('profile');
Route::post('/users', 'UsersController@update');
Route::post('/users/profile', 'UsersController@upload');
Route::post('/users/profile/remove', 'UsersController@removeAvatar');
Route::get('/users/list', 'UsersController@list')->name('userAll');


Route::get('/sair', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('/entrar');
});

//Route::get('/email', function () {
//
//    return new \App\Mail\NovaSerie(
//        'Teste',
//        '5',
//        '10'
//    );
//});

//Route::get('/enviar-email', function () {
//
////    $email = new \App\Mail\NovaSerie(
////        'Teste',
////        '5',
////        '10'
////    );
//
////    $user = (object)[
////        'email' => 'luan.limarangon@gmail.com',
////        'name' => 'luan'
////    ];
//
////    \Illuminate\Support\Facades\Mail::to($user)->send($email);
////    return 'Email Enviado';
//});


