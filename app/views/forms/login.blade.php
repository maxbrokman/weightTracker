@extends('layouts.standard')

@section('main')

@if ( $form_errors )
@foreach( $form_errors as $error )
    <div class="alert alert-danger">
        {{{ $error }}}
    </div>
@endforeach
@endif

{{ Form::open( array( 'route' => 'login' )) }}

    <div class="form-group">
        {{ Form::label('username', 'Username') }}
        {{ Form::text('username', '', array( 'class' => "form-control" )) }}
    </div>

    <div class="form-group">
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', array( 'class' => "form-control" )) }}
    </div>

    <div class="checkbox">
        {{ Form::label('remember', 'Remember Me') }}
        {{ Form::checkbox('remember', 1) }}
    </div>

    <div class="form-group">
        {{ Form::submit('Login', array( 'class' => "btn btn-primary" )) }}
    </div>

{{ Form::close() }}
@stop
