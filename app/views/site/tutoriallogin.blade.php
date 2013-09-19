<!doctype html>
<html>
    <head>
        <title>{{ Setting::get('system.schoolname') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @stylesheets('bootstrap')
        @stylesheets('grans')
    </head>
    <body>
        {{ $header }}
        <div class='container-fluid'>
            <div class='row-fluid'>

            	<div class="span5 offset4">
            		<div class="alert-success">You Need to Login Before Continue. Create a Account If you donot have one</div>
            	{{$loginsnippet}}
            	</div>
            </div>
        </div>
        {{-- Bootstrap JS Compiled --}}
        @javascripts('bootstrap')
        @javascripts('grans')
        <script type="text/javascript">
            $('#navbar').scrollspy();
        </script>
    </body>
</html>