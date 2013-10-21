<!DOCTYPE html>
<html>
<head>
    <title>{{ Theme::place('title') }}</title>
    <meta charset="utf-8">
    <meta name="keywords" content="{{ Theme::place('keywords') }}">
    <meta name="description" content="{{ Theme::place('description') }}">
    {{ Theme::asset()->styles() }}
    <link rel="stylesheet" type="text/css" href="/css/animate.css"/>
    <link rel="stylesheet" type="text/css" href="/css/liquid-slider.css"/>
    {{ Theme::asset()->scripts() }}
</head>
<body>
    {{ Theme::partial('header') }}
    {{ Theme::partial('menu') }}
    &nbsp;<br>&nbsp;<br>&nbsp;<br>
            <div id='latest_tutorial_wrapper' class="liquid-slider">
                <?php
                echo $latesttutorialslides
                ?>
            <div id='tutorial_wrapper' class="">
                <?php      
                echo $tutorialslides;
                ?>
            </div>
            <div id='topstudent_wrapper' class="">
                <?php 
                echo $topstudents
                ?>
            </div>
    <div class="clearfix"></div>
  {{ Theme::asset()->container('datatables')->scripts() }}
  <script>


  </script>

  <script type="text/javascript">
    // $("#tutorials").carouFredSel({        items: {            width: "25%",            height:"100%"        },        scroll:{            duration:2000,            pauseOnHover:true,            easing:'swing'        },        auto:{            duration:1000,            fx:"scroll",            easing:'swing'        },        swipe: true,        next: {            button: ".tutorial#next_btn",            key: "right",            fx:'scroll',            pauseOnHover: true,            easing:'swing'        },        prev: {            button: ".tutorial#prev_btn",            key: "left",            fx:'scroll',            pauseOnHover: true,            easing:'swing'        }    });    $("#topstudents").carouFredSel({        items: {            visible:3,            width: "25%",            height:"100%"        },        scroll:{            duration:2000,            pauseOnHover:true,            easing:'swing'        },        auto:{            duration:1000,            fx:"scroll",            easing:'swing'        },        swipe: true,        next: {            button: ".topstudent#next_btn",            key: "right",            fx:'scroll',            pauseOnHover: true,            easing:'swing'        },        prev: {            button: ".topstudent#prev_btn",            key: "left",            fx:'scroll',            pauseOnHover: true,            easing:'swing'        }    });    $("#latest_tutorials").carouFredSel({        items: {            width: "85%",            height:"100%"        },        scroll:{            duration:2000,            pauseOnHover:true,            easing:'swing'        },        auto:{            duration:1000,            fx:"scroll",            easing:'swing'        },        swipe: true,        next: {            button: ".latest_tutorial#next_btn",            key: "right",            fx:'scroll',            pauseOnHover: true,            easing:'swing'        },        prev: {            button: ".latest_tutorial#prev_btn",            key: "left",            fx:'scroll',            pauseOnHover: true,            easing:'swing'        }    });
</script>
{{ Theme::asset()->container('footer')->scripts() }}
<script src="./js/jquery.easing.1.3.js"></script>
<script src="./js/jquery.touchSwipe.min.js"></script>
<script src="./js/jquery.liquid-slider.min.js"></script>
<script>
    /* If installing in the footer, you won't need $(function() {} */
   $('#latest_tutorial_wrapper').liquidSlider({
    autoSlide:true,    
  dynamicTabs:          false,
  dynamicTabsHtml:      false,
   });
   </script>
</body>
</html>