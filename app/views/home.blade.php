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
	@foreach($task as Session::get('tasks'))
		{{ echo $task->description }}
	@endforeach
@stop