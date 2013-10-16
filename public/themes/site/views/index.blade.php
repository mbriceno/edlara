<!DOCTYPE html>
<html>
<head>
    <title>{{ Theme::place('title') }}</title>
    <meta charset="utf-8">
    <meta name="keywords" content="{{ Theme::place('keywords') }}">
    <meta name="description" content="{{ Theme::place('description') }}">
    {{ Theme::asset()->styles() }}
    {{ Theme::asset()->scripts() }}
    <link rel="stylesheet" href="/css/system/home.css"/>
    <script src="/js/jquery-2.0.2.min.js"></script>
    <script src="/lib/caroufredsel/jquery-caroufredsel-6.2.1.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="/lib/caroufredsel/helper-plugins/jquery.touchSwipe.min.js"></script>
    <script src="/lib/caroufredsel/helper-plugins/jquery.mousewheel.min.js"></script>
</head>
<body>
    {{ Theme::partial('header') }}
    {{ Theme::partial('menu') }}
    &nbsp;<br>&nbsp;<br>&nbsp;<br>
    <div class="container">
        <div class="row">
            <div class='col-md-1 hidden-sm hidden-xs'>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                <a class="latest_tutorial left pull-left" id="prev_btn" style="font-size:200%;">&laquo;</a>
            </div>
            <div id='latest_tutorial_wrapper' class="col-xs-12 col-sm-12 col-md-10" style="border-bottom:1px solid #000000;border-radius:20px;">
                <div class="latest_tutorials_title" style="overflow:hidden;">
                    Latest Tutorials
                </div>
                <div id="latest_tutorials" class="latest_tutorials">
                    <?php
                    echo $latesttutorialslides
                    ?>
                </div>
            </div>
            <div class='col-md-1 hidden-sm hidden-xs'>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                <a class="latest_tutorial right pull-right" id="next_btn" style="font-size:200%;">&raquo;</a>
            </div>
        </div>&nbsp;<br>&nbsp;<br>&nbsp;<br>
        <div class="row">
            <div class='col-md-1 hidden-sm hidden-xs'>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                <a class="tutorial left pull-left" id="prev_btn" style="font-size:200%;">&laquo;</a>
            </div>
            <div id='tutorial_wrapper' class="col-xs-12 col-sm-12 col-md-10" style="border-bottom:1px solid #000000;border-radius:20px;">
                <div class="tutorials_title" style="overflow:hidden;">
                    Latest Trending Tutorials
                </div>
                <div id="tutorials" class="latest_trending_tutorials">
                    <?php
                    echo $tutorialslides;
                    ?>
                </div>
            </div>
            <div class='col-md-1 hidden-sm hidden-xs'>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                <a class="tutorial right pull-right" id="next_btn" style="font-size:200%;">&raquo;</a>
            </div>
        </div>&nbsp;<br>&nbsp;<br>&nbsp;<br>
        <div class="row">
            <div class='col-md-1 hidden-sm hidden-xs'>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                <a class="topstudent left pull-left" id="prev_btn" style="font-size:200%;">&laquo;</a>
            </div>
            <div id='topstudent_wrapper' class="col-xs-12 col-sm-12 col-md-10" style="border-bottom:1px solid #000000;border-radius:20px;">
                <div class="topstudents_title" style="overflow:hidden;">
                    Top Students of System
                </div>
                <div id="topstudents" class="topstudents">
                    <?php
                    echo $topstudents
                    ?>
                </div>
            </div>
            <div class='col-md-1 hidden-sm hidden-xs'>&nbsp;<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>
                <a class="topstudent right pull-right" id="next_btn" style="font-size:200%;">&raquo;</a>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<script src="/lib/bootstrap/js/bootstrap.min.js"></script>
<!-- {{ Theme::asset()->container('footer')->scripts() }} -->
{{ Theme::asset()->container('datatables')->scripts() }}
<script>

    $("#tutorials").carouFredSel({
        items: {
            width: "25%",
            height:"100%"
        },
        scroll:{
            duration:2000,
            pauseOnHover:true,
            easing:'swing'
        },
        auto:{
            duration:1000,
            fx:"scroll",
            easing:'swing'
        },
        swipe: true,
        next: {
            button: ".tutorial#next_btn",
            key: "right",
            fx:'scroll',
            pauseOnHover: true,
            easing:'swing'
        },
        prev: {
            button: ".tutorial#prev_btn",
            key: "left",
            fx:'scroll',
            pauseOnHover: true,
            easing:'swing'
        }
    });
    $("#topstudents").carouFredSel({
        items: {
            visible:3,
            width: "25%",
            height:"100%"
        },
        scroll:{
            duration:2000,
            pauseOnHover:true,
            easing:'swing'
        },
        auto:{
            duration:1000,
            fx:"scroll",
            easing:'swing'
        },
        swipe: true,
        next: {
            button: ".topstudent#next_btn",
            key: "right",
            fx:'scroll',
            pauseOnHover: true,
            easing:'swing'
        },
        prev: {
            button: ".topstudent#prev_btn",
            key: "left",
            fx:'scroll',
            pauseOnHover: true,
            easing:'swing'
        }
    });
    $("#latest_tutorials").carouFredSel({
        items: {
            width: "85%",
            height:"100%"
        },
        scroll:{
            duration:2000,
            pauseOnHover:true,
            easing:'swing'
        },
        auto:{
            duration:1000,
            fx:"scroll",
            easing:'swing'
        },
        swipe: true,
        next: {
            button: ".latest_tutorial#next_btn",
            key: "right",
            fx:'scroll',
            pauseOnHover: true,
            easing:'swing'
        },
        prev: {
            button: ".latest_tutorial#prev_btn",
            key: "left",
            fx:'scroll',
            pauseOnHover: true,
            easing:'swing'
        }
    });
</script>
</body>
</html>