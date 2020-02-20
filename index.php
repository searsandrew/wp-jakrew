<?php get_header();
get_template_part('nav','jakrew'); ?>
<main role="main" class="container">
    <section class="content content-home">
        <div class="row d-none d-lg-block">
            <div class="col-md-4 text-center">
                <?php the_custom_logo(); ?>
            </div>
        </div>
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="row">
                <div class="col-md-4 text-center mt-5 mt-lg-0">
                    <?php if(is_front_page())
                    {
                        echo '<h1 class="page-title">'.get_the_title().'</h1>';
                        the_content();
                        echo '<hr/>';
                    } ?>
                    <h4 class="text-center"><?= storeIsOpen(); ?></h4>
                    <p class="text-center"> 
                        28W571 Batavia Road<br/>
                        Warrenville, IL<br/>
                        <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalStoreHours">
                            Store Hours
                        </button> • 
                        <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalMapsGoogle">
                            Find us on Google
                        </button>
                    </p>
                </div>
                <div class="col-md-8 mb-3">
                    <?php if(is_front_page())
                    {
                        $args = array(
                            'post_type' => 'schedule',
                            'category_name' => current_time('D')
                        );
                        // The Query
                        $the_query = new WP_Query( $args );
                        
                        // The Loop
                        if ( $the_query->have_posts() ) {
                            echo sprintf('<h3>Our weekly %s events...</h3>', current_time('l'));
                            echo '<div class="row">';
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                echo '<div class="col-md-6"><div class="card">';
                                if (has_post_thumbnail( $post->ID ) ):
                                    $thumb_id = get_post_thumbnail_id( $post->ID );
                                    $image = wp_get_attachment_image_src( $thumb_id, 'card-top-feature' );
                                    echo sprintf('<img src="%s" class="card-img-top" alt="%s" />', $image[0], get_post_meta($thumb_id, '_wp_attachment_image_alt', true));
                                endif;

                                $costCheck = get_field('jrg_cost') != 0?'<span class="badge badge-success float-right font-reset">$'.get_field('jrg_cost').'.00</span>':'';
                                $guestCheck = get_field('jrg_guests') == 1?'<a href="#" class="card-link">Attend</a>':'';

                                echo sprintf('<div class="card-body">
                                    <h5 class="card-title">%1$s %2$s</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">%3$s</h6>
                                    <a href="%4$s" class="card-link">Learn More</a>
                                    %5$s
                                </div>',
                                get_the_title(),
                                $costCheck,
                                get_field('jrg_time'),
                                get_the_permalink(),
                                $guestCheck);
                            }
                            echo '</div>';
                        } else {
                            echo sprintf('<h3>No events this %s</h3>', current_time('l'));
                        }
                        /* Restore original Post Data */
                        wp_reset_postdata();


                    } else { 
                        get_template_part('content', get_post_format());
                        ?>
                        <div class="card">
                            <?php if (has_post_thumbnail( $post->ID ) ):
                                $thumb_id = get_post_thumbnail_id( $post->ID );
                                $image = wp_get_attachment_image_src( $thumb_id, 'card-top-feature' ); ?>
                                <img src="<?php echo $image[0]; ?>" class="card-img-top" alt="<?php get_post_meta($thumb_id, '_wp_attachment_image_alt', true); ?>" />
                            <?php endif;
                            $costCheck = get_field('jrg_cost') != 0?'<span class="badge badge-success float-right font-reset">$'.get_field('jrg_cost').'.00</span>':'';
                            $guestCheck = get_field('jrg_guests') == 1?'<a href="#" class="card-link">Attend</a>':'';

                            echo sprintf('<div class="card-body">
                                <h5 class="card-title">%1$s %2$s</h5>
                                <h6 class="card-subtitle mb-2 text-muted">%3$s</h6>
                                <div class="card-text">%4$s</div>
                                %5$s
                            </div>',
                            get_the_title(),
                            $costCheck,
                            get_field('jrg_time'),
                            get_the_content(),
                            $guestCheck); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php endwhile; ?>
    </section>
</main>

<?php get_footer(); ?>