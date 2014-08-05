@extends('_master')

@section('title')
	Crush Planner
@stop

@section('content')
	<h1>Hi {{{ Auth::user()->name }}}</h1>
	<p><a href="/create/">Create a Crush Plan</a></p>
	<p><a href="/logout/">Log out</a></p>
@stop