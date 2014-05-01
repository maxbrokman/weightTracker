{{ Form::open( array( 'route' => 'weight.store' )) }}


    <ul class="errors">
        @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>

    <div class="form-group">
        {{ Form::label('weight', 'Weight (kgs)') }}
        {{ Form::text('weight', '', array('class' => 'form-control' )) }}
    </div>

    <div class="form-group">
        {{ Form::submit('Add', array('class' => 'btn btn-default')) }}
    </div>

{{ Form::close() }}
