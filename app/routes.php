<?php

Route::get('/', function() {
//	If logged in: home, if not: welcome
	if(Auth::check()) {
//		$tasks = Task::where('user_id', '=', Auth::user()->id)->
//			where('done', '=', false)->orderBy('dueDate', 'asc');
//		return View::make('home')->with('tasks', $tasks);
		return View::make('home');
	} else {
		return View::make('welcome');
	}
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

Route::post('/create',
	array(
		'before' => 'csrf',
		function() {
//			$rules = array(
//				'email' => 'email|unique:users,email|required',
//				'password' => 'min:6|required',
//				'name' => 'required'
//			);
//			
//			$validator = Validator::make(Input::all(), $rules);
//			
//			if($validator->fails()) {
//				return Redirect::to('/')
//								->with('error', 'Sign up failed; please fix errors below.')
//								->withInput()
//								->withErrors($validator);
//			}
			
			
			
			$plan = new Plan;
			$plan->name = Input::get('name');
			$plan->user_id = Auth::user()->id;
			$plan->save();
			
			for($i=0;$i<count(Input::get('description'));$i++) {
				$duration = Input::get('duration')[$i];
				if(Input::get('durationUnit')[$i] == 'hr') 
					$duration *= 60; // put it in minutes
//				sdf
				$task = new Task;
				$task->description = Input::get('description')[$i];
				$task->duration = $duration;
				$task->sub_of = Input::get('subOf')[$i];
				$task->due_date = Input::get('submit_dueDate')[$i];
				$task->due_time = Input::get('dueTime')[$i];
				$task->assigned_day = Input::get('submit_assignedDate')[$i*2];
				$task->assigned_time = Input::get('assignedTime')[$i];
				$task->done = false;
				$task->plan_id = $plan->id;
				$task->save();
			}
			
			return Redirect::to('/')->with('success', 'Crush plan '.$plan->name.' created succesfully');
			
//			$user = new User;
//			$user->name = Input::get('name');
//			$user->email = Input::get('email');
//			$user->password = Hash::make(Input::get('password'));
//			$user->ip = Request::getClientIp();
//			
//			try {
//				$user->save();
//			} catch(Exception $e) {
//				 return Redirect::to('/')
//								->with('error', 'Sign up failed; please try again.')
//								->withInput();
//			}
//			
//			Auth::login($user);
//			return Redirect::to('/')->with('success', 'Welcome to Crush Planner');
		}
	)
);

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