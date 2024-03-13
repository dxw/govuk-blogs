<?php

function setDefaultLinkType()
{
	if (get_option('image_default_link_type') !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}

add_action('admin_init', 'setDefaultLinkType', 10);
