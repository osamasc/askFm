<?php

use App\Http\Controllers\QuestController;

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/account/wall', 'HomeController@index');

Route::get('/account/settings', 'SettingsController@getIndex');

Route::post('/account/settings', 'SettingsController@postSettings');

Route::post('/question', 'QuestController@postQuestion');

Route::get('/{username}', 'PagesController@getUser');

Route::get('/account/questions', 'QuestController@getQuestions');

Route::post('/account/delete', 'QuestController@postDeleteQuestion');

Route::get('/account/question/{id}', 'QuestController@getQuestion');

Route::post('/account/question', 'QuestController@postAnswer');

Route::post('/relations', 'RelationsController@postFollow');

Route::post('/answer/delete', 'AnswerController@removeAnswer');

Route::post('/answer/like', 'LikeController@postLike');

Route::get('/account/friends', 'FriendsController@getFriends');

Route::get('/{username}/ask', 'QuestController@singleQuestion');

Route::post('/search', 'FriendsController@search');