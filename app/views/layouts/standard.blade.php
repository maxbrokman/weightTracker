@extends('layouts.base')

@section('body')
<div class="container">
    <header class="header">
        <ul class="nav nav-pills pull-right">
            @if ( Auth::guest() )
                {{ HTML::activeNav('home', 'Home') }}

                {{ HTML::activeNav('login', 'Login') }}
            @else
                {{ HTML::activeNav('me', 'Home') }}

                {{ HTML::activeNav('logout', 'Logout') }}
            @endif
        </ul>
        <h3 class="text-muted">WTPro</h3>
    </header>

    @if ( Session::get('error') )
        <div class="alert alert-danger">
            {{{ Session::get('error') }}}
        </div>
    @endif

    @if ( Session::get('message') )
        <div class="alert alert-success">
            {{{ Session::get('message') }}}
        </div>
    @endif

    <main>
        @yield('main')
    </main>

    <footer class="footer">
        Built as a Laravel learning exercise
    </footer>
</div>
@stop