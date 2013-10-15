<!DOCTYPE html>
<html>
    <head>
        <title>{{ Theme::place('title') }}</title>
        <meta charset="utf-8">
        <meta name="keywords" content="{{ Theme::place('keywords') }}">
        <meta name="description" content="{{ Theme::place('description') }}">
        {{ Theme::asset()->styles() }}
        {{ Theme::asset()->scripts() }}
    </head>
    <body>
        {{ Theme::partial('header') }}
        {{ Theme::partial('menu') }}

        <div class="container">
        </div>
        <div class="clearfix"></div>
       
        {{ Theme::asset()->container('footer')->scripts() }}
        {{ Theme::asset()->container('datatables')->scripts() }}
    </body>
</html>