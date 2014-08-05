<h3>Log in</h3>

@foreach($errors->all() as $message) 
    <div class='error'>{{ $message }}</div>
@endforeach

{{ Form::open(array('url' => '/login')) }}

    <span class="col-sm-2">{{ Form::label('email', 'Email') }}</span>
    {{ Form::email('email') }}<br /><br />

    <span class="col-sm-2">{{ Form::label('password', 'Password') }}</span>
    {{ Form::password('password') }}<br /><br />

    <span class="col-sm-2">{{ Form::submit('Log in') }}</span>

{{ Form::close() }}