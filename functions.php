<?php 

/* =============================================================================
   DEBUG OPTIONS
   ========================================================================== */
	
	//ini_set( 'display_errors', 1);
	//error_reporting( E_ERROR | E_WARNING | E_PARSE | E_NOTICE | E_STRICT );	
	//define('WLT_DEBUG_EMAIL', true);
	 
 
/* =============================================================================
   LOAD IN FRAMEWORK
   ========================================================================== */
 	
	// LOAD IN CLASS FILES
	if(!defined('THEME_VERSION') ){ include("framework/_config.php"); }	

 	
/* =============================================================================
   ADD YOUR CUSTOM CODE BELOW THIS LINE
   ========================================================================== */  

function create_service_request_cpt() {
    $labels = array(
        'name' => _x( 'Service Requests', 'Post Type General Name', 'text_domain' ),
        'singular_name' => _x( 'Service Request', 'Post Type Singular Name', 'text_domain' ),
        'menu_name' => __( 'Service Requests', 'text_domain' ),
        'name_admin_bar' => __( 'Service Request', 'text_domain' ),
        'archives' => __( 'Service Request Archives', 'text_domain' ),
        'attributes' => __( 'Service Request Attributes', 'text_domain' ),
        'parent_item_colon' => __( 'Parent Item:', 'text_domain' ),
        'all_items' => __( 'All Service Requests', 'text_domain' ),
        'add_new_item' => __( 'Add New Service Request', 'text_domain' ),
        'add_new' => __( 'Add New', 'text_domain' ),
        'new_item' => __( 'New Service Request', 'text_domain' ),
        'edit_item' => __( 'Edit Service Request', 'text_domain' ),
        'update_item' => __( 'Update Service Request', 'text_domain' ),
        'view_item' => __( 'View Service Request', 'text_domain' ),
        'view_items' => __( 'View Service Requests', 'text_domain' ),
        'search_items' => __( 'Search Service Request', 'text_domain' ),
        'not_found' => __( 'Not found', 'text_domain' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'text_domain' ),
        'featured_image' => __( 'Featured Image', 'text_domain' ),
        'set_featured_image' => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image' => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item' => __( 'Insert into item', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        'items_list' => __( 'Service Requests list', 'text_domain' ),
        'items_list_navigation' => __( 'Service Requests list navigation', 'text_domain' ),
        'filter_items_list' => __( 'Filter items list', 'text_domain' ),
    );
    $args = array(
        'label' => __( 'Service Request', 'text_domain' ),
        'description' => __( 'Post Type for Service Requests', 'text_domain' ),
        'labels' => $labels,
        'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'comments', 'custom-fields' ),
        'taxonomies' => array( 'service_category', 'service_skill' ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type( 'service_request', $args );

    // Register Custom Taxonomy for Service Category
    $labels_category = array(
        'name' => _x( 'Service Categories', 'Taxonomy General Name', 'text_domain' ),
        'singular_name' => _x( 'Service Category', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name' => __( 'Service Categories', 'text_domain' ),
    );
    $args_category = array(
        'labels' => $labels_category,
        'hierarchical' => true,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy( 'service_category', array( 'service_request' ), $args_category );

    // Register Custom Taxonomy for Service Skill
    $labels_skill = array(
        'name' => _x( 'Service Skills', 'Taxonomy General Name', 'text_domain' ),
        'singular_name' => _x( 'Service Skill', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name' => __( 'Service Skills', 'text_domain' ),
    );
    $args_skill = array(
        'labels' => $labels_skill,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy( 'service_skill', array( 'service_request' ), $args_skill );
}
add_action( 'init', 'create_service_request_cpt', 0 );

function handle_place_bid_form_submission() {
    if ( ! isset( $_POST['place_bid_nonce_field'] ) || ! wp_verify_nonce( $_POST['place_bid_nonce_field'], 'place_bid_nonce' ) ) {
        wp_die( 'Security check failed.' );
    }

    $post_id = intval( $_POST['post_id'] );
    $bid_amount = sanitize_text_field( $_POST['bid_amount'] );
    $bid_message = wp_kses_post( $_POST['bid_message'] );
    $user_id = get_current_user_id();

    $commentdata = array(
        'comment_post_ID'      => $post_id,
        'comment_author'       => get_the_author_meta( 'display_name', $user_id ),
        'comment_author_email' => get_the_author_meta( 'user_email', $user_id ),
        'comment_author_url'   => get_the_author_meta( 'user_url', $user_id ),
        'comment_content'      => $bid_message,
        'user_id'              => $user_id,
        'comment_approved'     => 1,
        'comment_type'         => 'bid', // Custom comment type
    );

    $comment_id = wp_insert_comment( $commentdata );

    if ( $comment_id ) {
        add_comment_meta( $comment_id, 'bid_amount', $bid_amount );
    }

    wp_redirect( get_permalink( $post_id ) );
    exit;
}
add_action( 'admin_post_nopriv_place_bid', 'handle_place_bid_form_submission' );
add_action( 'admin_post_place_bid', 'handle_place_bid_form_submission' );

function custom_bid_comment_callback( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID(); ?>">
        <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            <div class="comment-author vcard">
                <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                <?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
            </div>

            <div class="comment-meta commentmetadata">
                <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>">
                    <?php printf( '%1$s at %2$s', get_comment_date(),  get_comment_time() ); ?>
                </a>
                <?php edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
            </div>

            <?php comment_text(); ?>

            <div class="bid-amount">
                <strong><?php _e( 'Bid:', 'text_domain' ); ?></strong> <?php echo esc_html( get_comment_meta( $comment->comment_ID, 'bid_amount', true ) ); ?>
            </div>

            <div class="reply">
                <?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
            </div>

            <?php
            $post = get_post( $comment->comment_post_ID );
            if ( get_current_user_id() == $post->post_author && ! get_post_meta( $post->ID, 'accepted_bid', true ) ) {
                ?>
                <div class="accept-bid">
                    <a href="<?php echo esc_url( admin_url( 'admin-post.php?action=accept_bid&post_id=' . $post->ID . '&comment_id=' . $comment->comment_ID . '&_wpnonce=' . wp_create_nonce( 'accept_bid_nonce' ) ) ); ?>" class="button"><?php _e( 'Accept Bid', 'text_domain' ); ?></a>
                </div>
                <?php
            }
            ?>
        </div>
    <?php
}

function handle_accept_bid_action() {
    if ( ! isset( $_GET['_wpnonce'] ) || ! wp_verify_nonce( $_GET['_wpnonce'], 'accept_bid_nonce' ) ) {
        wp_die( 'Security check failed.' );
    }

    $post_id = intval( $_GET['post_id'] );
    $comment_id = intval( $_GET['comment_id'] );

    $comment = get_comment( $comment_id );
    $bidder_id = $comment->user_id;

    update_post_meta( $post_id, 'accepted_bid', $comment_id );
    update_post_meta( $post_id, 'accepted_bidder', $bidder_id );

    // Placeholder for sending a notification to the winning bidder
    // For example, you could use wp_mail() to send an email.
    // $user_info = get_userdata($bidder_id);
    // wp_mail( $user_info->user_email, 'Your bid was accepted!', 'Congratulations, your bid was accepted.' );

    wp_redirect( get_permalink( $post_id ) );
    exit;
}
add_action( 'admin_post_accept_bid', 'handle_accept_bid_action' );
?>