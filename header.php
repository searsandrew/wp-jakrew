<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title><?php
        	global $page, $paged;
            
            wp_title( '|', true, 'right' );
        	bloginfo( 'name' );

        	$site_description = get_bloginfo( 'description', 'display' );
            if ( $site_description && ( is_home() || is_front_page() ) )
                echo " | $site_description";

            if ( $paged >= 2 || $page >= 2 )
                echo ' | ' . sprintf( __( 'Page %s', '_s' ), max( $paged, $page ) );
        ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <!--[if lt IE 9]>
            <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
            <script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
            <script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
        <![endif]--> 

        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>