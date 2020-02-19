<?php

/**
 * Store Is Open takes an array of times and checks to see if the current time is within it.
 * 
 * @todo Pull data from Database
 * @return string
 */
function storeIsOpen() {
    $storeSchedule = [
        'Sun' => ['12:00 PM' => '06:00 PM'],
        'Mon' => ['04:00 PM' => '10:00 PM'],
        'Tue' => ['04:00 PM' => '10:00 PM'],
        'Wed' => ['04:00 PM' => '10:00 PM'],
        'Thu' => ['03:00 PM' => '10:00 PM'],
        'Fri' => ['03:00 PM' => '12:00 AM'],
        'Sat' => ['12:00 AM' => '01:30 AM', '09:00 AM' => '11:00 PM']
    ];
    // current or user supplied UNIX timestamp
    $timestamp = time();

    // default status
    $status = FALSE;

    // get current time object
    $currentTime = (new DateTime('America/Chicago'))->setTimestamp($timestamp);

    // loop through time ranges for current day
    foreach ($storeSchedule[date('D', $timestamp)] as $startTime => $endTime) {

        // create time objects from start/end times
        $startTime = DateTime::createFromFormat('h:i A', $startTime, new DateTimeZone('America/Chicago'));
        $endTime   = DateTime::createFromFormat('h:i A', $endTime, new DateTimeZone('America/Chicago'));

        // check if current time is within a range
        if (($startTime < $currentTime) && ($currentTime < $endTime)) {
            return 'We are Open until '.$endTime->format('g:i A');
        }

        // set status to open time
        if (($startTime > $currentTime) && ($currentTime < $endTime)) {
            return 'Open today at '.$startTime->format('g:i A');
        } elseif (($startTime < $currentTime) && ($currentTime > $endTime)) {
            return 'Open tomorrow at ';
        } else {
            return 'We are currently Closed.';
        }
    }

    return $status;
}

if ( ! function_exists('jrg_weekly_schedule_post_type') ) {

    // Register Custom Post Type
    function jrg_weekly_schedule_post_type() {
    
        $labels = array(
            'name'                  => 'Scheduled Events',
            'singular_name'         => 'Scheduled Event',
            'menu_name'             => 'Weekly Schedule',
            'name_admin_bar'        => 'Weekly Schedule',
            'archives'              => 'Scheduled Events Archives',
            'attributes'            => 'Scheduled Events Attributes',
            'parent_item_colon'     => 'Parent Scheduled Event:',
            'all_items'             => 'All Scheduled Events',
            'add_new_item'          => 'Add New Scheduled Event',
            'add_new'               => 'Add New',
            'new_item'              => 'New Scheduled Event',
            'edit_item'             => 'Edit Scheduled Events',
            'update_item'           => 'Update Scheduled Event',
            'view_item'             => 'View Scheduled Event',
            'view_items'            => 'View Scheduled Events',
            'search_items'          => 'Search Scheduled Events',
            'not_found'             => 'Not found',
            'not_found_in_trash'    => 'Not found in Trash',
            'featured_image'        => 'Scheduled Event Featured Image',
            'set_featured_image'    => 'Set featured image',
            'remove_featured_image' => 'Remove featured image',
            'use_featured_image'    => 'Use as featured image',
            'insert_into_item'      => 'Insert into Scheduled Events',
            'uploaded_to_this_item' => 'Uploaded to this item',
            'items_list'            => 'Scheduled Events list',
            'items_list_navigation' => 'Scheduled Events list navigation',
            'filter_items_list'     => 'Filter items list',
        );
        $args = array(
            'label'                 => 'Scheduled Event',
            'description'           => 'Weekly Scheduled Events Posts',
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
            'taxonomies'            => array( 'category' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 10,
            'menu_icon'             => 'dashicons-tickets',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type( 'schedule', $args );
    
    }
add_action( 'init', 'jrg_weekly_schedule_post_type', 0 );

}