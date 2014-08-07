@extends('_master')

@section('title')
	New Crush Plan - Crush Planner
@stop

@section('headers')
	<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/pickadate/default.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/pickadate/default.date.css') }}" />
@stop

@section('content')

<!-- Invisible -->
	<div id="createTaskFormat">
		<div class="taskItem">
			<span class="col-sm-2">{{ Form::label('description[]', 'Description') }}</span>
			{{ Form::text("description[]", '', array('class' => 'textField')) }}
			<br />
			<span class="col-sm-2">{{ Form::label('duration[]', 'Estimated time needed') }}</span>
			{{ Form::text('duration[]', '', array('class' => 'numberInput', 'maxlength' => '4')) }}
			{{ Form::select('durationUnit[]', array('hr' => 'hr', 'min' => 'min'))}}
			<br /><br />
			<span class="col-sm-2">{{ Form::label('due[]', 'Due date') }}</span>
			{{ Form::text('dueDate[]', '', array('class' => 'dateField')) }}&nbsp;&nbsp;
			{{ Form::select('dueTime[]', array('0' => 'Morning', '1' => 'Midday', '2' => 'Afternoon',
				'3' => 'Evening', '4' => 'End of day')) }}
			<br />
			{{ Form::hidden('subOf[]', '-1') }}
			<br /><br />
		</div>
	</div>
	<div id="assignTasksFormat">
		<div class="row">
			<p class="col-md-2 assignDescription"></p>
			<p class="col-md-1 assignDuration"></p>
			<p class="col-md-3 assignDue"></p>
			<span class="col-md-2">{{ Form::text('assignedDate[]', '', array('class' => 'dateField')) }}</span>
			<span class="col-md-2">{{ Form::select('assignedTime[]', array('0' => 'Morning', '1' => 'Midday', '2' => 'Afternoon',
				'3' => 'Evening', '4' => 'End of day')) }}</span>
		</div>
	</div>
<!-- -->
	
	<h1>Create Crush Plan</h1>

	{{ Form::open(array('url' => '/create')) }}
		<h2>Name your Crush Plan: {{ Form::text('name', '', array('id' => 'createName')) }}</h2>
		<div id="createSection2">
			<h2>Add your tasks</h2>
			<div id="createTasksArea"></div>
			{{ Form::button('+Add task', array('id' => 'createNewTaskButton')) }}
			{{ Form::button('Done adding tasks', array('id' => 'createDoneAddingButton')) }}
		</div>
		<div id="createSection3">
			<h2>Plan your Crush schedule</h2>
			<div class="row">
				<h3 class="col-md-2">Task</h3>
				<h3 class="col-md-1">Time</h3>
				<h3 class="col-md-3">Due</h3>
				<h3 class="col-md-2">Assigned Day</h3>
				<h3 class="col-md-2">Assigned Time</h3>
			</div>
			<div id="assignTasksArea"></div>
			{{ Form::submit('Create Crush Plan') }}
		</div>
	{{ Form::close() }}
	<div class="alert alert-danger" id="formErrors" role="alert"></div>

	
@stop

@section('scripts')
	<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
	<script src="{{ URL::asset('js/pickadate/picker.js') }}"></script>
	<script src="{{ URL::asset('js/pickadate/picker.date.js') }}"></script>
	<script src="{{ URL::asset('js/createform.js') }}"></script>
@stop