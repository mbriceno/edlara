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
                <div class="span8 offset2">
                    <h5>If Any Problems persist. Contact our team at </h5>
                        <?php
                        if(Sentry::check()){
                            ?>
                        <a href='mailto:gransjhc@gmail.com'>gransjhc@gmail.com</a></h4>
                        <?php } else {
                            echo "TO SEE EMAIL. PLEASE LOGIN.";
                        } ?>
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