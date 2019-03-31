<?php

// Route::get('/hello', function () {
//     return "hello world!!";
// });

// Route::get('/user/{id}/{name}', function($id, $n){
//     return 'this is user '. $n .'with an id of '. $id;
// }); 

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::resource('post', 'PostsController');