{{ Form::open( array( 'route' => 'login' )) }}

    {{ Form::label('username', 'Username') }}
    {{ Form::text('username', '') }}

    {{ Form::label('password', 'Password') }}
    {{ Form::password('password') }}

    {{ Form::label('remember', 'Remember Me') }}
    {{ Form::checkbox('remember', 1) }}

    {{ Form::submit('Login') }}

{{ Form::close() }}
