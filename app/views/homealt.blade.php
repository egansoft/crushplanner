@extends('_master')

@section('title')
	Crush Planner
@stop

@section('content')
	@if(Session::get('success'))
		<div class="alert alert-success" role="alert">{{ Session::get('success') }}</div>
	@endif
	@if(Session::get('info'))
		<div class="alert alert-info" role="alert">{{ Session::get('info') }}</div>
	@endif
	@if(Session::get('error'))
		<div class="alert alert-error" role="alert">{{ Session::get('error') }}</div>
	@endif
	@if(Session::get('warning'))
		<div class="alert alert-warning" role="alert">{{ Session::get('warning') }}</div>
	@endif

	<h1>Hi {{{ Auth::user()->name }}}</h1>
	<p><a href="/create/">Create a Crush Plan</a></p>
	<p><a href="/logout/">Log out</a></p>

	<h2>Tasks to crush</h2>
	<div class="row">
		<h3 class="col-md-2">Task</h3>
		<h3 class="col-md-1">Time</h3>
		<h3 class="col-md-3">Due</h3>
		<h3 class="col-md-2">Assigned Time</h3>
		<h3 class="col-md-2">Crushed</h3>
	</div>
	
	{{ Form::open(array('url' => '/crush')) }}
		@foreach($tasks as $task)
			<div class="row">
				<p class="col-md-2">{{ $task->description }}</p>
				<p class="col-md-1">{{ $task->duration }} min</p>
				<p class="col-md-3">{{ date('D, M j', strtotime($task->due_date)) }}</p>
				<p class="col-md-2">{{ date('D, M j', strtotime($task->assigned_day)) }}</p>
				<p class="col-md-2">{{ Form::checkBox('crush[]', $task->id) }}</p>
			</div>
		@endforeach
		{{ Form::submit('Crush!') }}
	{{ Form::close() }}

@stop