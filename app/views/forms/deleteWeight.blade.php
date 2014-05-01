{{ Form::open( array( 'route' => array( 'weight.destroy', $id ), 'method' => 'delete' )) }}

    {{ Form::submit('Delete', array('class' => 'btn btn-warning')) }}

{{ Form::close() }}
