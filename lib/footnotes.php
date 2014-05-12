<?php 

$footnotes = array();

add_shortcode('footnote', function ($atts, $content) {
  global $footnotes;

  $footnotes[$atts['id']] = $content;

  return '<sup><a class="footnote" href="#footnote_' . esc_attr($atts['id']) . '">' . esc_attr($atts['id']) . '</a></sup>';
});
 
function the_footnotes() { 
  global $footnotes;

  if(!count($footnotes)) {
    return;
  }
  
  ?><div class="footnotes"><?php
  ?><h3>Footnotes</h3><?php
  ?><ul><?php
  foreach($footnotes as $id => $footnote) {
    ?><li id="footnote_<?php echo esc_attr($id) ?>"><span class="number"><?php echo esc_html($id) ?>.</span> <span class="footnote"><?php echo $footnote ?></span></li><?php
  }
  ?></ul><?php
  ?></div><?php
}
