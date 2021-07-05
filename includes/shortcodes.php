<?php

add_shortcode('my_shortcode','my_shortcode');
// Shortcode Example
function my_shortcode() {
	ob_start();
// Code goes here
	return ob_get_clean();
}

