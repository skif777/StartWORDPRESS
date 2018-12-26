<?php

/**
 * Head
 */
add_action('wp_head', 'my_wp_head_css', 1 );
function my_wp_head_css() {
?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="keywords" content="Кючевые слова"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<!-- profile -->
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<!-- Manifest-->
	<link rel="manifest" href="site.webmanifest"/>
	<!-- Favicon-->
	<link rel="apple-touch-icon" href="img/Favicon/icon.png"/>
	<!-- chrome, firefox OS and opera-->
	<meta name="theme-color" content="#000"/>
	<!-- windows phone-->
	<meta name="msapplication-navbutton-color" content="#000"/>
	<!-- ios safari-->
	<meta name="apple-mobile-web-app-status-bar-style" content="#000"/>
	<!-- Preloading fonts-->
	<link rel="preload" href="#" as="font" type="font/woff2" crossorigin="crossorigin"/>
	<!-- Preload Styles-->
	<style>body{opacity:0;overflow-x:hidden;} html{background-color: #000;}</style>
	<link href="css/theme-style.css" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'"/>
	<script>!function(t){"use strict";t.loadCSS||(t.loadCSS=function(){});var e=loadCSS.relpreload={};if(e.support=function(){var e;try{e=t.document.createElement("link").relList.supports("preload")}catch(t){e=!1}return function(){return e}}(),e.bindMediaToggle=function(t){var e=t.media||"all";function a(){t.media=e}t.addEventListener?t.addEventListener("load",a):t.attachEvent&&t.attachEvent("onload",a),setTimeout(function(){t.rel="stylesheet",t.media="only x"}),setTimeout(a,3e3)},e.poly=function(){if(!e.support())for(var a=t.document.getElementsByTagName("link"),n=0;n<a.length;n++){var o=a[n];"preload"!==o.rel||"style"!==o.getAttribute("as")||o.getAttribute("data-loadcss")||(o.setAttribute("data-loadcss",!0),e.bindMediaToggle(o))}},!e.support()){e.poly();var a=t.setInterval(e.poly,500);t.addEventListener?t.addEventListener("load",function(){e.poly(),t.clearInterval(a)}):t.attachEvent&&t.attachEvent("onload",function(){e.poly(),t.clearInterval(a)})}"undefined"!=typeof exports?exports.loadCSS=loadCSS:t.loadCSS=loadCSS}("undefined"!=typeof global?global:this);</script>
	<?php
}