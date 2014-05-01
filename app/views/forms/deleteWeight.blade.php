{{ Form::open( array( 'route' => array( 'weight.destroy', $id ), 'method' => 'delete' )) }}

    {{ Form::submit('Delete') }}

{{ Form::close() }}
