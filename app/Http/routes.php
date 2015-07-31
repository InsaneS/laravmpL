<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|

EXAMPPLE

Route::get('/', function () {
    return view('welcome');
});
*/ 

get('/', ['as' => 'posts', 'uses' => 'GlobalController@index']);
get('/home', ['as' => 'posts', 'uses' => 'GlobalController@index']);
get('/WaifuDatabase', ['as' => 'waifus', 'uses' => 'GlobalController@Wdb']);
get('/WaifuDatabase/newwaifu', ['as' => 'waifus', 'uses' => 'GlobalController@makenewwaifu']);
 
get('/ArtDatabase/{artNum}', ['uses' => 'GlobalController@ArtTempPost']);

get('/UserDatabase/getusers/withname/{name}/sorting/{sort}/number/{num}', ['uses' => 'GlobalController@GetUsers']);
get('/UserDatabase/{num}', ['uses' => 'GlobalController@UserPage']);

get('/getpost/{postId}', ['as' => 'posts', 'uses' => 'GlobalController@getpost']);
get('/getpost/{postId}/update/waifus/{waifus}', ['as' => 'posts', 'uses' => 'GlobalController@updatepostW']);
get('/getpost/{postId}/update/hashtags/{hashtags}', ['as' => 'posts', 'uses' => 'GlobalController@updatepostH']);

get('/likepost/{postId}', ['as' => 'posts', 'uses' => 'GlobalController@likepost']);
get('/getpostarraywith/number/{num}/H/{Hfilters}/W/{Wfilters}', ['as' => 'posts', 'uses' => 'GlobalController@getallposts']);

get('/database/getwaifutags/', ['as' => 'waifus', 'uses' => 'GlobalController@getallWaifuTags']);
get('/database/gethashtags/{type}', ['as' => 'waifus', 'uses' => 'GlobalController@getHashTags']);

get('/WaifuDatabase/update', ['as' => 'waifus', 'uses' => 'GlobalController@UpdateWaifuRating']);
get('/WaifuDatabase/{wId}/edit/{what}/value/{value}', ['as' => 'waifus', 'uses' => 'GlobalController@editWaifu']);

get('/ArtDatabase/', ['uses' => 'GlobalController@ArtDatabase']);

get('/database/number/{num}/sort/{sortwith}/H/{Hfilters}/findwithname/{name}/', ['as' => 'waifus', 'uses' => 'GlobalController@getWaifusWith']); 
get('/WaifuDatabase/waifusorgodess/{WofG}/ofuser/{num}', ['as' => 'waifus', 'uses' => 'GlobalController@getWaifusOfUser']); 


get('/database/waifu/{wId}', ['as' => 'waifus', 'uses' => 'GlobalController@waifutemp']);
get('/database/waifu/{wId}/relation/{rId}', ['as' => 'waifus', 'uses' => 'GlobalController@waifunewrel']);
get('/database/waifu/{wId}/updatevotes', ['as' => 'waifus', 'uses' => 'GlobalController@updatevotes']);

get('/UserDatabase/', ['uses' => 'GlobalController@UserDatabase']);

post('/', ['as' => 'post.store', 'uses' => 'GlobalController@poststore']);

post('/makenewwaifu', ['as' => 'waifu.store', 'uses' => 'GlobalController@waifustore']); 

get('/404', ['as' => 'waifus', 'uses' => 'GlobalController@er404']);


//Route::any('/', 'UserController@login');

//Route::get('login', 'SessionsController@create');
//Route::get('logout', 'SessionsController@destroy');
//Route::resource('sessions', 'SessionsController');

//Route::resource('auth', 'Auth\AuthController');
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');


Route::get('img/{path}', function(League\Glide\Server $server, Illuminate\Http\Request $request){
    $server->outputImage($request);
    //dd($request);
})->where('path', '.*');