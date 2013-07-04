<?php
View::composer('main.menu', function($view)
{
    $view->nest('loginsnippet','account.loginsnippet');
    return $view;
});

View::composer('main.header',function($view){
	$view->nest('clouds','main.clouds');
	$view->nest('menubar','main.menu');
	return $view;
});