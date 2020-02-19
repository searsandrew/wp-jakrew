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
                            'category_name' => date('D', time())
                        );
                        // The Query
                        $the_query = new WP_Query( $args );
                        
                        // The Loop
                        if ( $the_query->have_posts() ) {
                            echo sprintf('<h3>Our weekly %s events...</h3>', date('l', time()));
                            echo '<div class="row">';
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                echo '<div class="col-md-6"><div class="card">';
                                if (has_post_thumbnail( $post->ID ) ):
                                    $thumb_id = get_post_thumbnail_id( $post->ID );
                                    $image = wp_get_attachment_image_src( $thumb_id, 'single-post-thumbnail' );
                                    echo sprintf('<img src="%s" class="card-img-top" alt="%s" />', $image[0], get_post_meta($thumb_id, '_wp_attachment_image_alt', true));
                                endif;

                                $costCheck = get_field('jrg_cost') != 0?'<span class="badge badge-success float-right font-reset">$'.get_field('jrg_cost').'.00</span>':'';
                                $guestCheck = get_field('jrg_guests') == 1?'<a href="#" class="card-link">Attend</a>':'';

                                //echo 'Field: '.the_field('jrg_time', $post->ID);

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
                            // no posts found
                        }
                        /* Restore original Post Data */
                        wp_reset_postdata();


                    } else { ?>
                        <div class="card">
                            <?php if (has_post_thumbnail( $post->ID ) ):
                                $thumb_id = get_post_thumbnail_id( $post->ID );
                                $image = wp_get_attachment_image_src( $thumb_id, 'single-post-thumbnail' ); ?>
                                <img src="<?php echo $image[0]; ?>" class="card-img-top" alt="<?php get_post_meta($thumb_id, '_wp_attachment_image_alt', true); ?>" />
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= get_the_title(); ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                <div class="card-text"><?= get_the_content(); ?></div>
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php endwhile; ?>
    </section>
</main>

<!-- Store Hours -->
<div class="modal fade" id="modalStoreHours" tabindex="-1" role="dialog" aria-labelledby="modalStoreHoursTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalStoreHoursTitle">Store Hours</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <table class="table table-sm">
                <tbody>
                    <tr>
                        <th scope="row">Sunday</th>
                        <td>12:00 PM</td>
                        <td>6:00 PM</td>
                    </tr>
                    <tr>
                        <th scope="row">Monday</th>
                        <td>4:00 PM</td>
                        <td>10:00 PM</td>
                    </tr>
                    <tr>
                        <th scope="row">Tuesday</th>
                        <td>4:00 PM</td>
                        <td>10:00 PM</td>
                    </tr>
                    <tr>
                        <th scope="row">Wednesday</th>
                        <td>4:00 PM</td>
                        <td>10:00 PM</td>
                    </tr>
                    <tr>
                        <th scope="row">Thursday</th>
                        <td>3:00 PM</td>
                        <td>10:00 PM</td>
                    </tr>
                    <tr>
                        <th scope="row">Friday</th>
                        <td>3:00 PM</td>
                        <td>1:00 AM</td>
                    </tr>
                    <tr>
                        <th scope="row">Saturday</th>
                        <td>9:00 AM</td>
                        <td>11:00 PM</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Google Map -->
<div class="modal fade" id="modalMapsGoogle" tabindex="-1" role="dialog" aria-labelledby="modalMapsGoogleTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMapsGoogleTitle">Find us on Google</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-4by3">
                    <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1220.1213603616457!2d-88.18113627063299!3d41.82366986683648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880ef9760039547f%3A0x2bfda62a286cbfa8!2sJakrew%20Games%2C%20Inc.!5e0!3m2!1sen!2sus!4v1570668024888!5m2!1sen!2sus" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>