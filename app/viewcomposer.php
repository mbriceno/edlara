<?php
View::composer('main.menu', function($view)
{
    $view->nest('loginsnippet','account.loginsnippet');
    return $view;
});