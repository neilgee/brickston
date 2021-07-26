<?php

add_shortcode('my_shortcode','my_shortcode');
// Shortcode Example
function my_shortcode() {
	ob_start();
echo 'HELLO - SQUEEZE ME IN HERE';
	return ob_get_clean();
}

