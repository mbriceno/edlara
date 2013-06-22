<!DOCTYPE html>
<html>
    <head>
        <title>Edlara -Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @stylesheets('bootstrap')
        @stylesheets('grans')
    </head>
    <body>
        <h1>Login Page</h1>

        {{ Form::open(array('url' => 'login','method'=>'post')) }}

        {{ Form::text('email', 'example@gmail.com');}}
        {{ Form::password('password') }}
        {{ Form::submit('Click Me!') }}
        {{--TOKEN FOR THE FORM--}}
        {{ Form::token() }}
        {{ Form::close() }}

        {{-- Bootstrap JS Compiled --}}
        @javascripts('bootstrap')
        @javascripts('grans')
    </body>

</html>