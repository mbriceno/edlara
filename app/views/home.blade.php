<!doctype html>
<html>
    <head>
        <title>Edulara</title>        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @stylesheets('bootstrap')
        @stylesheets('grans')
    </head>
    <body>
        <div class="container-fluid" id='top-heading'>
            <div class="row-fluid" >
                <!--
So we will have an animated background with 5 clouds moving across the screen.
Steps: 
1. create the clouds
2. Animate them to move across the screen
3. Stylize the clouds(can be done as step #2 also)
-->
<div id="clouds">
	<div class="cloud x1"></div>
	<!-- Time for multiple clouds to dance around -->
	<div class="cloud x2"></div>
	<div class="cloud x3"></div>
	<div class="cloud x4"></div>
	<div class="cloud x5"></div>
</div>
<!-- Thats the markup! -->
<!-- That looks cool. We are done!! -->
                <span class="brand-name" id='top-header'>
                    EdLara
                </span>
            </div>
            
        </div>

        {{-- Bootstrap JS Compiled --}}
        @javascripts('bootstrap')
        @javascripts('grans')
        <script type="text/javascript">
       // $("#top-header").fitText(1.0, { minFontSize: '24px', maxFontSize: '480px' });
        </script>
    </body>
</html>