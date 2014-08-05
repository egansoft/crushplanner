@extends('_master')

@section('title')
	Crush Planner
@stop

@section('content')
	<div class="row">
		<div class="col-md-6">@include('_signup')</div>
		<div class="col-md-6">@include('_login')</div>
	</div>
@stop