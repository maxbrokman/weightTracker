{{ Form::open( array( 'route' => 'register' )) }}

    <ul class="errors">
        @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>

    <div class="form-group">
        {{ Form::label('username', 'Username') }}
        {{ Form::text('username', '', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('email', 'Email Address') }}
        {{ Form::email('email', '', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('password_confirmation', 'Confirm Password') }}
        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::submit('Register', array('class' => 'btn btn-block btn-lg btn-danger')) }}
    </div>

{{ Form::close() }}