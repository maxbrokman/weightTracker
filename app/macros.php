<?php
/**
 * Created by PhpStorm.
 * User: maxbrokman
 * Date: 01/05/2014
 * Time: 15:51
 */

/**
 * Macro to provide active nav links
 */
HTML::macro('activeNav', function( $targetRoute, $text)
{
    $class = '';
    $currentRoute = Route::currentRouteName();

    if ( $targetRoute === $currentRoute ) {
        $class = 'class="active"';
    }

    return '<li ' . $class . '>' . HTML::linkRoute( $targetRoute, $text ) . '</li>';
});