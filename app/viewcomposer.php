<?php
View::composer('main.menu', function($view)
{
    $view->nest('loginsnippet','account.loginsnippet');
    return $view;
});
View::composer('site.tutoriallogin', function($view)
{
    $view->nest('loginsnippet','account.loginsnippet');
    return $view;
});

View::composer('main.header',function($view){
	$view->nest('clouds','main.clouds');
	$view->nest('menubar','main.menu');
	return $view;
});
View::composer('dashboard.content.box.mainbox',function($view)
{
    $view->nest('contentbox1','dashboard.content.box.1');
    $view->nest('contentbox2','dashboard.content.box.2');
    $view->nest('contentbox6','dashboard.content.box.6');
    return $view;
});


View::composer('dashboard.content.index',function($view)
{
    $view->nest('bigbox','dashboard.content.box.mainbox');
    return $view;
});

View::composer('dashboard.index',function($view)
{
    $view->nest('breadcrumbs','dashboard.breadcrumbs.top');
    $view->nest('topmenu','dashboard.menubar.menu');
    $view->nest('sidebar','dashboard.sidebar.sidebar');
    $view->nest('intro','dashboard.content.intro');
    $view->nest('content','dashboard.content.index');
    $view->nest('status','dashboard.status.statusbox');
    $view->nest('noscript','dashboard.warnings.noscript');
    return $view;
});
View::composer('dashboard.settings',function($view)
{
    $view->nest('breadcrumbs','dashboard.breadcrumbs.top');
    $view->nest('topmenu','dashboard.menubar.menu');
    $view->nest('sidebar','dashboard.sidebar.sidebar');
    $view->nest('intro','dashboard.content.intro');
    $view->nest('content','dashboard.content.index');
    $view->nest('status','dashboard.status.statusbox');
    $view->nest('noscript','dashboard.warnings.noscript');
    return $view;
});
View::composer('dashboard.tutorials',function($view)
{
    $view->nest('breadcrumbs','dashboard.breadcrumbs.top');
    $view->nest('topmenu','dashboard.menubar.menu');
    $view->nest('sidebar','dashboard.sidebar.sidebar');
    $view->nest('intro','dashboard.content.intro');
    $view->nest('content','dashboard.content.index');
    $view->nest('status','dashboard.status.statusbox');
    $view->nest('noscript','dashboard.warnings.noscript');
    return $view;
});

View::composer('dashboard.tutorials.edit',function($view){

    $view->nest('breadcrumbs','dashboard.breadcrumbs.top');
    $view->nest('topmenu','dashboard.menubar.menu');
    $view->nest('sidebar','dashboard.sidebar.sidebar');
    $view->nest('noscript','dashboard.warnings.noscript');
});
View::composer('dashboard.tutorials.view',function($view){

    $view->nest('breadcrumbs','dashboard.breadcrumbs.top');
    $view->nest('topmenu','dashboard.menubar.menu');
    $view->nest('sidebar','dashboard.sidebar.sidebar');
    $view->nest('noscript','dashboard.warnings.noscript');
});
View::composer('dashboard.tutorials.create',function($view){

    $view->nest('breadcrumbs','dashboard.breadcrumbs.top');
    $view->nest('topmenu','dashboard.menubar.menu');
    $view->nest('sidebar','dashboard.sidebar.sidebar');
    $view->nest('noscript','dashboard.warnings.noscript');
});

View::composer('dashboard.users',function($view)
{
    $view->nest('breadcrumbs','dashboard.breadcrumbs.top');
    $view->nest('topmenu','dashboard.menubar.menu');
    $view->nest('sidebar','dashboard.sidebar.sidebar');
    $view->nest('intro','dashboard.content.intro');
    $view->nest('content','dashboard.content.index');
    $view->nest('status','dashboard.status.statusbox');
    $view->nest('noscript','dashboard.warnings.noscript');
    return $view;
});
View::composer('dashboard.assessments',function($view)
{
    $view->nest('breadcrumbs','dashboard.breadcrumbs.top');
    $view->nest('topmenu','dashboard.menubar.menu');
    $view->nest('sidebar','dashboard.sidebar.sidebar');
    $view->nest('intro','dashboard.content.intro');
    $view->nest('content','dashboard.content.index');
    $view->nest('status','dashboard.status.statusbox');
    $view->nest('noscript','dashboard.warnings.noscript');
    return $view;
});
View::composer('dashboard.students',function($view)
{
    $view->nest('breadcrumbs','dashboard.breadcrumbs.top');
    $view->nest('topmenu','dashboard.menubar.menu');
    $view->nest('sidebar','dashboard.sidebar.sidebar');
    $view->nest('intro','dashboard.content.intro');
    $view->nest('content','dashboard.content.index');
    $view->nest('status','dashboard.status.statusbox');
    $view->nest('noscript','dashboard.warnings.noscript');
    return $view;
});
View::composer('dashboard.teachers',function($view)
{
    $view->nest('breadcrumbs','dashboard.breadcrumbs.top');
    $view->nest('topmenu','dashboard.menubar.menu');
    $view->nest('sidebar','dashboard.sidebar.sidebar');
    $view->nest('intro','dashboard.content.intro');
    $view->nest('content','dashboard.content.index');
    $view->nest('status','dashboard.status.statusbox');
    $view->nest('noscript','dashboard.warnings.noscript');
    return $view;
});
View::composer('dashboard.user',function($view)
{
    $view->nest('breadcrumbs','dashboard.breadcrumbs.top');
    $view->nest('topmenu','dashboard.menubar.menu');
    $view->nest('sidebar','dashboard.sidebar.sidebar');
    $view->nest('intro','dashboard.content.intro');
    $view->nest('content','dashboard.content.index');
    $view->nest('status','dashboard.status.statusbox');
    $view->nest('noscript','dashboard.warnings.noscript');
    return $view;
});
View::composer('dashboard.user.view',function($view)
{
    $view->nest('breadcrumbs','dashboard.breadcrumbs.top');
    $view->nest('topmenu','dashboard.menubar.menu');
    $view->nest('sidebar','dashboard.sidebar.sidebar');
    $view->nest('intro','dashboard.content.intro');
    $view->nest('content','dashboard.content.index');
    $view->nest('status','dashboard.status.statusbox');
    $view->nest('noscript','dashboard.warnings.noscript');
    return $view;
});
View::composer('dashboard.user.edit',function($view)
{
    $view->nest('breadcrumbs','dashboard.breadcrumbs.top');
    $view->nest('topmenu','dashboard.menubar.menu');
    $view->nest('sidebar','dashboard.sidebar.sidebar');
    $view->nest('intro','dashboard.content.intro');
    $view->nest('content','dashboard.content.index');
    $view->nest('status','dashboard.status.statusbox');
    $view->nest('noscript','dashboard.warnings.noscript');
    return $view;
});
View::composer('dashboard.assessments.update',function($view)
{
    $view->nest('breadcrumbs','dashboard.breadcrumbs.top');
    $view->nest('topmenu','dashboard.menubar.menu');
    $view->nest('sidebar','dashboard.sidebar.sidebar');
    $view->nest('intro','dashboard.content.intro');
    $view->nest('content','dashboard.content.index');
    $view->nest('status','dashboard.status.statusbox');
    $view->nest('noscript','dashboard.warnings.noscript');
    return $view;
});