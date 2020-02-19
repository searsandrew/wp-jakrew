<?php get_header();
get_template_part('nav','jakrew'); ?>
<main role="main" class="container">
    <section class="content content-home">
        <div class="row">
            <div class="col-md-4 text-center">
                <?php echo '<div class="d-none d-lg-block">'.get_custom_logo().'</div>';
                while ( have_posts() ) : the_post();
                    if(is_front_page())
                    {
                        echo '<h1 class="page-title">'.get_the_title().'</h1>';
                        the_content();
                    }
                    echo '<hr/>';
                endwhile; ?>
                <h4 class="text-center"><?= storeIsOpen()?'We are currently Open':'Visit us tomorrow at'; ?></h4>
                <p class="text-center"> 
                    28W571 Batavia Road<br/>
                    Warrenville, IL<br/>
                    <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalMapsGoogle">
                        Find us on Google
                    </button>
                </p>
                <hr/>
                
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
            </div>
            <div class="col-md-9">
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>