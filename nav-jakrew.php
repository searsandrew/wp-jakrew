<?php 
    use Mayfifteenth\Centreforge\Vendor\WP_Bootstrap_Navwalker;
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-bottom">
    <div class="container">
        <a class="navbar-brand" href="<?php bloginfo('url'); ?>">
            <img src="/wp-content/themes/jakrew/img/horizontal-icon.png" class="d-lg-none" />
            <img src="/wp-content/themes/jakrew/img/inverse-icon.png" class="d-none d-lg-block" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                <a class="nav-link" href="#">Home
                    <span class="sr-only">(current)</span>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div> -->
        
        
        <?php
        wp_nav_menu( array(
            'theme_location'  => 'primary',
            'depth'           => 1,
            'container'       => 'div',
            'container_id'    => 'navbarResponsive',
            'container_class' => 'collapse navbar-collapse',
            'menu_class'      => 'nav navbar-nav ml-auto',
            'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
            'walker'          => new WP_Bootstrap_Navwalker()
        ));
        ?>
    </div>
</nav>