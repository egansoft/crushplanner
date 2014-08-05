@extends('_master')

@section('title')
	New Crush Plan - Crush Planner
@stop

@section('headers')
	<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
@stop

@section('content')
	
	<h1>Create Crush Plan</h1>

	{{ Form::open(array('url' => '/signup')) }}
		<h2>Name your Crush Plan: {{ Form::text('name', '', array('id' => 'createName')) }}</h2>
		<div id="createSection2">
			<h2>Add your tasks</h2>
			<div id="createTasksArea"></div>
			{{ Form::button('+Add task', array('id' => 'createNewTaskButton')) }}
			{{ Form::button('Done adding tasks', array('id' => 'createDoneAddingButton')) }}
		</div>
		<div id="createSection3">
		</div>

		<div id="createTaskFormat">
			<!-- Invisible, but used when adding tasks -->
			<span class="col-sm-2">{{ Form::label('description[]', 'Description') }}</span>
			{{ Form::text("description[]") }}
			<br />
			<span class="col-sm-2">{{ Form::label('duration[]', 'Estimated time needed') }}</span>
			{{ Form::text('duration[]', '', array('class' => 'numberInput', 'maxlength' => '2')) }}
			{{ Form::select('durationUnit[]', array('minutes' => 'min', 'hours' => 'hr'))}}
			<br /><br />
			<span class="col-sm-2">{{ Form::label('due[]', 'Due date') }}</span>
			{{ Form::text('due[]', '', array('class' => 'dateField')) }}
			<br />
			{{ Form::hidden('subOf[]', '-1') }}
			<br /><br />
		</div>
	{{ Form::close() }}

	
@stop

@section('scripts')
	<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
	<script src="{{ URL::asset('js/createform.js') }}"></script>
@stop