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

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});