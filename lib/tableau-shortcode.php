<?php

function tableau_shortcode($attr) {

  return '
    <div class="tableau">
      <iframe width="636" height="720" frameborder="0" src="'.$attr['src'].'"></iframe>
    </div>
  ';  
}
add_shortcode("tableau", "tableau_shortcode");  