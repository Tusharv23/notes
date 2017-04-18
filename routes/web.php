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



Auth::routes();



Route::get('/chat','ChatController@index')->middleware('auth');
Route::post('/sendmessage','ChatController@sendMessage');
Route::get('/home',function(){
	return view('home');
});
Route::get('/retrieve','ChatController@retrieve');

// Route::post('/chat','ChatController@sendMessage');
// Route::post('/typing','ChatController@typing');
// Route::post('/nottyping','ChatController@nottyping');
// Route::post('/retrieveChatMessage','ChatController@retrieveChatMessage');
// Route::post('/retrieveTypingStatus','ChatController@retrieveTypingStatus');

Route::get('/instafeed/',['uses'=>'InstaController@feed','as'=>'instafeed'])->middleware('auth');
// Route::post('/instafeed',['uses'=>'InstaController@feed','as'=>'instafeed'])->middleware('auth');
Route::get('/event',function(){
	event(new MessageRegistered(new App\Message([
			'text'=>'sucker', 
			'sender_name'=>'tushar',
			'receiver_name'=>'rohan'
		])));
});
Route::get('/send','MailController@send');