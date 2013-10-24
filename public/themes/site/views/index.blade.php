<?php

defined('ROOT' )|| die('Restricted Access');

?><!DOCTYPE html>
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
            @if($latesttutorialslides)
            <h2 style="text-align:center;">Latest Tutorials</h2>
            @endif;
            <div id='latest_tutorial_wrapper' class="liquid-slider">
                <?php
                echo $latesttutorialslides
                ?>
            </div>
            @if($tutorialslides)
            <h2 style="text-align:center;">Latest Trending Tutorials</h2>
            @endif;
            <div id='tutorial_wrapper' class="liquid-slider">
                <?php      
                echo $tutorialslides;
                ?>
            </div>
            @if($topstudents)
            <h2 style="text-align:center;">Top Students</h2>
            @endif;
            <div id='topstudent_wrapper' class="liquid-slider">
                <?php 
                echo $topstudents
                ?>
            </div>
  {{ Theme::asset()->container('datatables')->scripts() }}
  <script>


  </script>

{{ Theme::asset()->container('footer')->scripts() }}
<script src="./js/jquery.easing.1.3.js"></script>
<script src="./js/jquery.touchSwipe.min.js"></script>
<script src="./js/jquery.liquid-slider.min.js"></script>
<script>
   $('#latest_tutorial_wrapper').liquidSlider({
    autoSlide:true,    
  dynamicTabs:          false,
  dynamicTabsHtml:      false,
  autoSlideInterval:  6000,
  animateIn:                  "bounceInTop",
  animateOut:                 "bounceOutRight",
  continuous:                 true,
   });
   $('#tutorial_wrapper').liquidSlider({
    autoSlide:true,    
  dynamicTabs:          false,
  dynamicTabsHtml:      false,
  autoSlideInterval:  4000,
  animateIn:                  "bounceInBottom",
  animateOut:                 "bounceOutRight",
  continuous:                 true,
   });
    $('#topstudent_wrapper').liquidSlider({
    autoSlide:true,    
  dynamicTabs:          false,
  dynamicTabsHtml:      false,
  autoSlideInterval:  5000,
  animateIn:                  "bounceInLeft",
  animateOut:                 "bounceOutLeft",
  continuous:                 true,
   });
  </script>
</body>
</html>