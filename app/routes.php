<?php

Route::get('/', function() {
//	If logged in: home, if not: welcome
	if(Auth::check())
		return View::make('home');
	else
		return View::make('welcome');
});

Route::post('/signup',
	array(
		'before' => 'csrf',
		function() {
			$rules = array(
				'email' => 'email|unique:users,email|required',
				'password' => 'min:6|required',
				'name' => 'required'
			);
			
			$validator = Validator::make(Input::all(), $rules);
			
			if($validator->fails()) {
				return Redirect::to('/')
								->with('error', 'Sign up failed; please fix errors below.')
								->withInput()
								->withErrors($validator);
			}
			
			$user = new User;
			$user->name = Input::get('name');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->ip = Request::getClientIp();
			
			try {
				$user->save();
			} catch(Exception $e) {
				 return Redirect::to('/')
								->with('error', 'Sign up failed; please try again.')
								->withInput();
			}
			
			Auth::login($user);
			return Redirect::to('/')->with('success', 'Welcome to Crush Planner');
		}
	)
);

Route::post('/login', 
	array(
		'before' => 'csrf',
		function() {
			$credentials = Input::only('email', 'password');

            if (Auth::attempt($credentials, $remember = true)) {
                return Redirect::intended('/')->with('success', 'Welcome back '.Auth::user()->name);
            } else {
                return Redirect::to('/')->with('error', 'Log in failed; please try again.');
            }
		}
	)
);

Route::get('/logout', function() {
    Auth::logout();

    return Redirect::to('/');
});

Route::get('/create', 
	array(
		'before' => 'auth', 
		function() {
			return View::make('create');
		}
	)
);

Route::post('/create', function() {
	// idk do something
});

Route::get('/view/{id}', function($id) {
//	return View::make('viewplan')->with($id);
});