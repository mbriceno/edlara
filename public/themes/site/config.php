<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Inherit from another theme
    |--------------------------------------------------------------------------
    |
    | Set up inherit from another if the file is not exists,
    | this is work with "layouts", "partials", "views" and "widgets"
    |
    | [Notice] assets cannot inherit.
    |
    */

    'inherit' => null, //default

    /*
    |--------------------------------------------------------------------------
    | Listener from events
    |--------------------------------------------------------------------------
    |
    | You can hook a theme when event fired on activities
    | this is cool feature to set up a title, meta, default styles and scripts.
    |
    | [Notice] these event can be override by package config.
    |
    */

    'events' => array(

        // Before event inherit from package config and the theme that call before,
        // you can use this event to set meta, breadcrumb template or anything
        // you want inheriting.
        'before' => function($theme)
        {
            $theme->setTitle(Setting::get('system.schoolname'));

        },

        // Listen on event before render a theme,
        // this event should call to assign some assets,
        // breadcrumb template.
        'beforeRenderTheme' => function($theme)
        {
            //BEFORE RENDER THEME
        },

        // Listen on event before render a layout,
        // this should call to assign style, script for a layout.
        'beforeRenderLayout' => array(

            'default' => function($theme)
            {
                $theme->asset()->container('footer')->add('jquery','/js/jquery-2.0.2.min.js');
                $theme->asset()->container('footer')->add('bootstrapjs','/lib/bootstrap/js/bootstrap.min.js');
                $theme->asset()->add('core','/css/system/main.css');
                $theme->asset()->add('bootstrap', '/lib/bootstrap/css/bootstrap.min.css');
                $theme->asset()->container('footer')->add('datatables','/lib/datatables/js/jquery.dataTables.min.js');
            }

        )

    )

);