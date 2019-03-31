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
    return view('welcome');
});

Route::get('/hello', function () {
    return "hello world!!";
});

Route::get('/blog', function(){
    return view('pages.about');
});
Route::get('/user/{id}/{name}', function($id, $n){
    return 'this is user '. $n .'with an id of '. $id;
}); 