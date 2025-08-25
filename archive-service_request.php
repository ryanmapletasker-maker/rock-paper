<?php
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <header class="page-header">
            <h1 class="page-title"><?php _e( 'Service Requests', 'text_domain' ); ?></h1>
        </header><!-- .page-header -->

        <?php if ( have_posts() ) : ?>

            <div class="list-group">
                <?php
                while ( have_posts() ) :
                    the_post();

                    // We can reuse the content-listing.php template part if it's suitable
                    // or create a custom loop here. For now, let's assume we can reuse it.
                    get_template_part( 'content', 'listing' );

                endwhile;
                ?>
            </div>

            <?php
            the_posts_navigation();

        else :

            get_template_part( 'search-noresults' );

        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
