{{ Form::open( array( 'route' => 'weight.store' )) }}


    <ul class="errors">
        @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>

    {{ Form::label('weight', 'Weight (kgs)') }}
    {{ Form::text('weight', '') }}

    {{ Form::submit('Add') }}

{{ Form::close() }}
