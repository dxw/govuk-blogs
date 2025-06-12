<?php

// Disable <style id='core-block-supports-inline-css'>

add_action('wp_footer', function () {
	wp_dequeue_style('core-block-supports');
}, 5);
