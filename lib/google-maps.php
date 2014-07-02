<?php

function map_shortcode($attr) {

  return '
    <div class="googlemap">
      <iframe width="636" height="450" frameborder="0" src="'.$attr['src'].'"></iframe>
      <small>
        <a href="'.$attr['src'].'">View larger map</a>
      </small>
    </div>
  ';  
}
add_shortcode("map", "map_shortcode");  