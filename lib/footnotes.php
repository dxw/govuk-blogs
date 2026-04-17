<?php

$footnotes = [];

add_shortcode('footnote', function ($atts, $content) {
	global $footnotes;

	if (isset($atts['id'])) {
		$footnotes[$atts['id']] = $content;
		$footnote_html = '<sup><a class="footnote" href="#footnote_' . esc_attr($atts['id']) . '">' . esc_attr($atts['id']) . '</a></sup>';
	} else {
		$footnote_html = '<sup>?</sup>';
	}
	return $footnote_html;
});

function the_footnotes()
{
	global $footnotes;

	if (!count($footnotes)) {
		return;
	} ?>
	<div class="footnotes">
		<h3>Footnotes</h3>
		<ul><?php foreach ($footnotes as $id => $footnote) { ?>
			<li id="footnote_<?php echo esc_attr($id) ?>"><span class="number"><?php echo esc_html($id) ?>.</span> <span class="footnote"><?php echo $footnote ?></span></li>
			<?php
		} ?>
		</ul>
	</div>
	<?php
}
