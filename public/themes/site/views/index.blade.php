<!DOCTYPE html>
<html>
<head>
    <title>{{ Theme::place('title') }}</title>
    <meta charset="utf-8">
    <meta name="keywords" content="{{ Theme::place('keywords') }}">
    <meta name="description" content="{{ Theme::place('description') }}">
    {{ Theme::asset()->styles() }}
    {{ Theme::asset()->scripts() }}
    <script src="/js/jquery-2.0.2.min.js"></script>
    <script src="/lib/caroufredsel/jquery-caroufredsel-6.2.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/lib/caroufredsel/helper-plugins/jquery.touchSwipe.min.js"></script>
    <script src="/lib/caroufredsel/helper-plugins/jquery.mousewheel.min.js"></script>
</head>
<body>
    {{ Theme::partial('header') }}
    {{ Theme::partial('menu') }}

    <div class="container">
        <div class="row">
            <div id="tutorials" class="latest_tutorials">
                <div>
                    <h3>Test</h3>
                </div>
            </div>
                <div id="paginator"></div>
                <button id="next_btn">Next</button>
                <button id="prev_btn">Previous</button>
        </div>
    </div>
    <div class="clearfix"></div>

    <!-- {{ Theme::asset()->container('footer')->scripts() }} -->
    {{ Theme::asset()->container('datatables')->scripts() }}
    <script>
            /*  CarouFredSel: a circular, responsive jQuery carousel.
                Configuration created by the "Configuration Robot"
                at caroufredsel.dev7studios.com
                */
                $("#tutorials").carouFredSel({
                    items: {
                        width: "85%",
                        height: 100
                    },
                    swipe: true,
                    pagination: {
                        container: "#paginator",
                        fx: "crossfade",
                        pauseOnHover: true
                    },
                    next: {
                        button: "#next_btn",
                        key: "right",
                        pauseOnHover: true
                    },
                    prev: {
                        button: "#prev_btn",
                        key: "left",
                        pauseOnHover: true
                    }
                });
            </script>
        </body>
        </html>