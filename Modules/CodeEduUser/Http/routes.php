<?php

Route::group(['middleware' => 'web', 'prefix' => 'codeeduuser', 'namespace' => '\CodeEduUser\Http\Controllers'], function()
{
    Route::get('/', 'CodeEduUserController@index');
});
