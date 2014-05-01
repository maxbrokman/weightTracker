{{ Form::open( array( 'route' => 'register' )) }}

    <ul class="errors">
        @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>

    {{ Form::label('username', 'Username') }}
    {{ Form::text('username', '') }}

    {{ Form::label('email', 'Email Address') }}
    {{ Form::email('email', '') }}

    {{ Form::label('password', 'Password') }}
    {{ Form::password('password') }}

    {{ Form::label('password_confirmation', 'Confirm Password') }}
    {{ Form::password('password_confirmation') }}

    {{ Form::submit('Register') }}

{{ Form::close() }}