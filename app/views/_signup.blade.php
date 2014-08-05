<h3>Sign up</h3>

@foreach($errors->all() as $message) 
    <div class='error'>{{ $message }}</div>
@endforeach

{{ Form::open(array('url' => '/signup')) }}
	<span class="col-sm-2">{{ Form::label('name', 'Name') }}</span>
	{{ Form::text('name') }}<br /><br />

    <span class="col-sm-2">{{ Form::label('email', 'Email') }}</span>
    {{ Form::email('email') }}<br /><br />

    <span class="col-sm-2">{{ Form::label('password', 'Password') }}</span>
    {{ Form::password('password') }}<br /><br />

    <span class="col-sm-2">{{ Form::submit('Submit') }}</span>

{{ Form::close() }}