<?php

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('mysql-test', function() {

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

	print_r($results);
});