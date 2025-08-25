<?php
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        while ( have_posts() ) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    <?php
                    the_content();

                    $budget = get_post_meta( get_the_ID(), 'service_budget', true );
                    if ( ! empty( $budget ) ) {
                        echo '<p><strong>' . __( 'Budget:', 'text_domain' ) . '</strong> ' . esc_html( $budget ) . '</p>';
                    }

                    echo '<p><strong>' . __( 'Category:', 'text_domain' ) . '</strong> ' . get_the_term_list( get_the_ID(), 'service_category', '', ', ', '' ) . '</p>';
                    echo '<p><strong>' . __( 'Skills:', 'text_domain' ) . '</strong> ' . get_the_term_list( get_the_ID(), 'service_skill', '', ', ', '' ) . '</p>';
                    ?>
                </div><!-- .entry-content -->

                <footer class="entry-footer">
                    <?php
                    if ( is_user_logged_in() ) { // In a real-world scenario, you should also check for the 'tasker' role
                        ?>
                        <div id="bidding-form">
                            <h3><?php _e( 'Place Your Bid', 'text_domain' ); ?></h3>
                            <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
                                <p>
                                    <label for="bid_amount"><?php _e( 'Bid Amount', 'text_domain' ); ?></label>
                                    <input type="text" name="bid_amount" id="bid_amount" required>
                                </p>
                                <p>
                                    <label for="bid_message"><?php _e( 'Message', 'text_domain' ); ?></label>
                                    <textarea name="bid_message" id="bid_message" rows="5"></textarea>
                                </p>
                                <input type="hidden" name="action" value="place_bid">
                                <input type="hidden" name="post_id" value="<?php echo get_the_ID(); ?>">
                                <?php wp_nonce_field( 'place_bid_nonce', 'place_bid_nonce_field' ); ?>
                                <p>
                                    <input type="submit" value="<?php _e( 'Place Bid', 'text_domain' ); ?>">
                                </p>
                            </form>
                        </div>
                        <?php
                    } else {
                        echo '<p>' . __( 'Please log in to place a bid.', 'text_domain' ) . '</p>';
                    }
                    ?>
                </footer><!-- .entry-footer -->
            </article><!-- #post-<?php the_ID(); ?> -->

            <?php
            // Display the bids
            $comments = get_comments( array(
                'post_id' => get_the_ID(),
                'type'    => 'bid',
                'status'  => 'approve',
            ) );

            if ( $comments ) {
                echo '<div id="bids-list">';
                echo '<h3>' . __( 'Bids', 'text_domain' ) . '</h3>';
                wp_list_comments( array(
                    'callback' => 'custom_bid_comment_callback',
                ), $comments );
                echo '</div>';
            }

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
