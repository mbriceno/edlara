<!doctype html>
<html>
    <head>
        <title>Edulara</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="test/parallax/css/reset.css">
        @stylesheets('bootstrap')
        @stylesheets('grans')
    </head>
    <body>
        <div class="container-fluid" id='top-heading'>
            <div class="row-fluid" >
                <div id="clouds">
                    <div class="cloud x1"></div>
                    <div class="cloud x2"></div>
                    <div class="cloud x3"></div>
                    <div class="cloud x4"></div>
                    <div class="cloud x5"></div>
                </div>
                <span class="brand-name" id='top-header'> EdLara </span>
            </div>

<<<<<<< Updated upstream
=======
            <div id="main" role="main">

                <!-- Section #1 / Intro -->
                <!-- Section #1 / Intro -->
                <section id="first" class="story" data-speed="8" data-type="background">
                    <div class="smashinglogo" data-type="sprite" data-offsetY="100" data-Xposition="50%" data-speed="-2"></div>
                    <article>
                        <h2>Helpful At All</h2>
                    </article>
                </section>

                <!-- Section #2 / Background Only -->
                <section id="second" class="story" data-speed="4" data-type="background">
                    <article>
                        <h2>Background Only</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo eu deserunt mollit anim id est laborum.
                        </p>

                    </article>
                </section>

                <!-- Section #3 / Photos -->
                <section id="third" class="story" data-speed="6" data-type="background" data-offsetY="250">
                    <div class="photograph" data-type="sprite" data-offsetY="600" data-Xposition="25%" data-speed="3"></div>
                    <article>
                        <h2>Scrolling Sprites</h2>
                        <div class="textbox">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo eu deserunt mollit anim id est laborum.
                            </p>

                        </div>
                    </article>
                </section>

                <!-- Section #4 / HTML5 Video -->
                <section id="fourth" class="story" data-speed="8" data-type="background" data-offsetY="250">
                    <article>
                        <h2>HTML5 Video</h2>
                        <div class="textbox">
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo eu deserunt mollit anim id est laborum.
                            </p>

                        </div>
                    </article>
                    <video controls width="640" width="480" data-type="video" data-offsetY="1800" data-speed="1.5">
                        <source src="video/parallax-test.ogv" type="video/ogg" />
                        <source src="video/parallax-test.mp4" type="video/mp4" />
                        <source src="video/parallax-test.webm" type="video/webm" />
                    </video>
                </section>

            </div>
            <!-- // End of #main -->
>>>>>>> Stashed changes
        </div>

        {{-- Bootstrap JS Compiled --}}
        @javascripts('bootstrap')
        @javascripts('grans')

        <script src="test/parallax/js/libs/jquery-1.6.1.min.js"></script>
        <script src="test/parallax/js/script.js"></script>
        <script type="text/javascript">
            // $("#top-header").fitText(1.0, { minFontSize: '24px', maxFontSize: '480px' });
        </script>
    </body>
</html>