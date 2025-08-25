<?php
/*
Template Name: Add Service Request
*/

// Handle form submission
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && $_POST['action'] == 'add_service_request' ) {

    // Check for nonce security
    if ( ! wp_verify_nonce( $_POST['add_service_request_nonce'], 'add_service_request_action' ) ) {
        die( 'Security check failed' );
    }

    $title = sanitize_text_field( $_POST['service_title'] );
    $description = wp_kses_post( $_POST['service_description'] );
    $budget = sanitize_text_field( $_POST['service_budget'] );
    $category = intval( $_POST['service_category'] );
    $skills = array_map( 'intval', $_POST['service_skills'] );

    $post_data = array(
        'post_title'    => $title,
        'post_content'  => $description,
        'post_status'   => 'publish',
        'post_type'     => 'service_request',
    );

    // Insert the post into the database
    $post_id = wp_insert_post( $post_data );

    if ( $post_id ) {
        // Set the budget
        update_post_meta( $post_id, 'service_budget', $budget );

        // Set the category
        wp_set_post_terms( $post_id, array( $category ), 'service_category' );

        // Set the skills
        wp_set_post_terms( $post_id, $skills, 'service_skill' );

        // Redirect to the new post
        wp_redirect( get_permalink( $post_id ) );
        exit;
    }
}

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <form id="add-service-request-form" action="" method="POST">

            <h2><?php _e( 'Add New Service Request', 'text_domain' ); ?></h2>

            <p>
                <label for="service_title"><?php _e( 'Title', 'text_domain' ); ?></label>
                <input type="text" id="service_title" name="service_title" required>
            </p>

            <p>
                <label for="service_description"><?php _e( 'Description', 'text_domain' ); ?></label>
                <textarea id="service_description" name="service_description" rows="5" required></textarea>
            </p>

            <p>
                <label for="service_budget"><?php _e( 'Budget', 'text_domain' ); ?></label>
                <input type="text" id="service_budget" name="service_budget">
            </p>

            <p>
                <label for="service_category"><?php _e( 'Category', 'text_domain' ); ?></label>
                <?php
                wp_dropdown_categories( array(
                    'taxonomy'         => 'service_category',
                    'name'             => 'service_category',
                    'show_option_none' => __( 'Select a category', 'text_domain' ),
                    'hierarchical'     => true,
                    'required'         => true,
                ) );
                ?>
            </p>

            <p>
                <label for="service_skills"><?php _e( 'Skills', 'text_domain' ); ?></label>
                <?php
                $skills = get_terms( array(
                    'taxonomy'   => 'service_skill',
                    'hide_empty' => false,
                ) );
                if ( ! empty( $skills ) ) {
                    echo '<ul>';
                    foreach ( $skills as $skill ) {
                        echo '<li><label><input type="checkbox" name="service_skills[]" value="' . $skill->term_id . '"> ' . $skill->name . '</label></li>';
                    }
                    echo '</ul>';
                }
                ?>
            </p>

            <?php wp_nonce_field( 'add_service_request_action', 'add_service_request_nonce' ); ?>

            <input type="hidden" name="action" value="add_service_request">

            <p>
                <input type="submit" value="<?php _e( 'Submit Request', 'text_domain' ); ?>">
            </p>

        </form>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
