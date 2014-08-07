@extends('_master')

@section('title')
	Crush Planner Beta
@stop

@section('content')
	<h1>Crush your tasks</h1>
	<p>Crush Planner is an online task management system that allows you to not just finish your work, but demolish it.
		Create crush plans for homework assignments, projects, presentations, chores, or anything else and make it whimper
		in pain as you show it no mercy.</p>
	<div class="row">
		<div class="col-md-6">@include('_signup')</div>
		<div class="col-md-6">@include('_login')</div>
	</div>
@stop