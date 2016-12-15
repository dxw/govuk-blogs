<?php

/*
 * This module unhooks a twice-daily call that Post Indexer makes to WPMUdev to check for updates
 * This was causing an error through use of is_plugin_active_for_network where the function was not defined
 */

add_action('init', 'unhook_wpmudev_scheduled_jobs', 20);

function unhook_wpmudev_scheduled_jobs()
{
    if ( wp_next_scheduled( 'wpmudev_scheduled_jobs' ) ) {
        $timestamp = wp_next_scheduled( 'wpmudev_scheduled_jobs' );
        wp_unschedule_event( $timestamp, 'wpmudev_scheduled_jobs' );
    }
}
