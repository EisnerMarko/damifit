<?php

function enqueue_theme_assets() {
    wp_enqueue_style(
        'styles',
        get_template_directory_uri() . '/css/style.css',
        array(),
        filemtime(get_template_directory() . '/css/style.css')
    );

    wp_enqueue_script(
        'scroll-to',
        get_template_directory_uri() . '/js/scrollTo.js',
        array(),
        filemtime(get_template_directory() . '/js/scrollTo.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_theme_assets');


function plp_disable_gutenberg() {
    remove_post_type_support('page', 'editor');
}
add_action('init', 'plp_disable_gutenberg');


function plp_register_strings() {
    pll_register_string('Home', 'Home');
    pll_register_string('Testimonial', 'Submit');
    pll_register_string('Testimonial', 'Name');
    pll_register_string('Testimonial', 'Rating');
    pll_register_string('Testimonial', 'Text');
    pll_register_string('Testimonial', 'Button');
    pll_register_string('Testimonial', 'Submition');
    pll_register_string('Testimonial', 'Register');
}
add_action('plugins_loaded', 'plp_register_strings');


function damifit_enqueue_iconify() {
    wp_enqueue_script(
        'iconify',
        'https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js',
        array(),
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'damifit_enqueue_iconify');


/* SCRIPTS*/
function theme_scripts() {

    // SWIPER CSS
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css'
    );

    // SWIPER JS
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        null,
        true
    );

    // HERO SLIDER
    wp_enqueue_script(
        'hero-slider',
        get_template_directory_uri() . '/js/slider.js',
        array('swiper-js'),
        null,
        true
    );

    // ZONES SCRIPT
    wp_enqueue_script(
        'zones-script',
        get_template_directory_uri() . '/js/zones.js',
        array(),
        null,
        true
    );
}

add_action('wp_enqueue_scripts', 'theme_scripts');

function handle_testimonial_submission() {
    if ( ! is_user_logged_in() ) {
        $login_url    = wp_login_url( wp_get_referer() ?: home_url() );
        $register_url = wp_registration_url();
        wp_die(
            sprintf(
                'Musíte byť prihlásený/á, aby ste mohli zanechať recenziu. You must be logged in to submit a testimonial. <a href="%1$s">Log in</a> or <a href="%2$s">Register</a>.',
                esc_url( $login_url ),
                esc_url( $register_url )
            ),
            'Login required',
            array( 'response' => 403 )
        );
    }

    if (
        ! isset( $_POST['testimonial_nonce'] ) ||
        ! wp_verify_nonce( $_POST['testimonial_nonce'], 'submit_testimonial_action' )
    ) {
        wp_die( 'Security check failed', 'Invalid request', array( 'response' => 403 ) );
    }

    $name    = isset( $_POST['testimonial_name'] ) ? sanitize_text_field( wp_strip_all_tags( $_POST['testimonial_name'] ) ) : '';
    $rating  = isset( $_POST['testimonial_rating'] ) ? intval( $_POST['testimonial_rating'] ) : 5;
    $rating  = min( 5, max( 1, $rating ) );
    $content = isset( $_POST['testimonial_content'] ) ? wp_kses_post( $_POST['testimonial_content'] ) : '';

    $current_user = wp_get_current_user();

    $testimonial_id = wp_insert_post( array(
        'post_type'    => 'testimonial',
        'post_title'   => $name ?: 'Anonymous',
        'post_content' => $content,
        'post_status'  => 'pending',
        'post_author'  => $current_user->ID,
    ) );

    if ( $testimonial_id && ! is_wp_error( $testimonial_id ) ) {
        if ( function_exists( 'update_field' ) ) {
            update_field( 'testimonial_name', $name, $testimonial_id );
            update_field( 'testimonial_rating', $rating, $testimonial_id );
        } else {
            update_post_meta( $testimonial_id, 'testimonial_name', $name );
            update_post_meta( $testimonial_id, 'testimonial_rating', $rating );
        }
    }

    $redirect = wp_get_referer() ? wp_get_referer() : home_url();
    wp_safe_redirect( add_query_arg( 'testimonial', 'success', $redirect ) );
    exit;
}

add_action('admin_post_nopriv_submit_testimonial', 'handle_testimonial_submission');
add_action('admin_post_submit_testimonial', 'handle_testimonial_submission');

function damifit_register_testimonial_cpt() {
    register_post_type('testimonial', [
        'labels' => [
            'name' => 'Testimonials',
            'singular_name' => 'Testimonial'
        ],
        'public' => true,
        'capability_type' => 'testimonial',
        'has_archive' => false,
        'supports' => ['title', 'editor', 'thumbnail', 'custom-fields'],
    ]);
}
add_action('init', 'damifit_register_testimonial_cpt');

function damifit_add_testimonial_meta_boxes() {
    add_meta_box(
        'damifit_testimonial_meta',
        'Testimonial details',
        'damifit_render_testimonial_meta_box',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'damifit_add_testimonial_meta_boxes');

function damifit_render_testimonial_meta_box( $post ) {
    wp_nonce_field( 'damifit_save_testimonial_meta', 'damifit_testimonial_meta_nonce' );

    $name = get_post_meta( $post->ID, 'testimonial_name', true );
    $rating = get_post_meta( $post->ID, 'testimonial_rating', true );
    $rating = $rating ? intval( $rating ) : 5;
    ?>
    <p>
        <label for="testimonial_name"><strong>Name</strong></label><br />
        <input type="text" id="testimonial_name" name="testimonial_name" value="<?php echo esc_attr( $name ); ?>" class="widefat" />
    </p>
    <p>
        <label for="testimonial_rating"><strong>Rating</strong></label><br />
        <input type="number" id="testimonial_rating" name="testimonial_rating" min="1" max="5" value="<?php echo esc_attr( $rating ); ?>" class="small-text" />
    </p>
    <?php
}

function damifit_save_testimonial_meta( $post_id ) {
    if ( ! isset( $_POST['damifit_testimonial_meta_nonce'] ) ) {
        return;
    }

    if ( ! wp_verify_nonce( $_POST['damifit_testimonial_meta_nonce'], 'damifit_save_testimonial_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['testimonial_name'] ) ) {
        update_post_meta( $post_id, 'testimonial_name', sanitize_text_field( wp_unslash( $_POST['testimonial_name'] ) ) );
    }

    if ( isset( $_POST['testimonial_rating'] ) ) {
        $rating = intval( $_POST['testimonial_rating'] );
        $rating = min( 5, max( 1, $rating ) );
        update_post_meta( $post_id, 'testimonial_rating', $rating );
    }
}
add_action( 'save_post_testimonial', 'damifit_save_testimonial_meta' );

add_filter('use_block_editor_for_post_type', function($use_block_editor, $post_type) {
    if ($post_type === 'testimonial') {
        return false;
    }
    return $use_block_editor;
}, 10, 2);

function damifit_testimonial_caps() {
    $roles = ['administrator'];
    
    $caps = [
        'edit_testimonial',
        'read_testimonial',
        'delete_testimonial',
        'edit_testimonials',
        'edit_others_testimonials',
        'publish_testimonials',
        'read_private_testimonials',
        'delete_testimonials',
        'delete_private_testimonials',
        'delete_published_testimonials',
        'delete_others_testimonials',
        'edit_private_testimonials',
        'edit_published_testimonials',
    ];

    foreach ($roles as $role_name) {
        $role = get_role($role_name);
        if (! $role) {
            continue;
        }

        foreach ($caps as $cap) {
            $role->add_cap($cap);
        }
    }
}
add_action('init', 'damifit_testimonial_caps');

add_action('admin_post_nopriv_custom_contact_form', 'handle_custom_contact_form');
add_action('admin_post_custom_contact_form', 'handle_custom_contact_form');

function handle_custom_contact_form() {

    if (
        !isset($_POST['custom_contact_nonce']) ||
        !wp_verify_nonce($_POST['custom_contact_nonce'], 'custom_contact_form_action')
    ) {
        wp_die('Security check failed');
    }

    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $service = sanitize_text_field($_POST['service']);
    $message = sanitize_textarea_field($_POST['message']);

    $to = 'admin@markosdesign.com'; // CHNAGE MAIL

    $subject = 'Nový kontaktný formulár';

    $body = "
    Meno: $name

    Email: $email

    Telefón: $phone

    Služba: $service

    Správa:
    $message
    ";

    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $email,
        'From: Damifit Web <admin@markosdesign.com>' // CHNAGE MAIL
    ];

    wp_mail($to, $subject, $body, $headers);

    wp_redirect( add_query_arg('contact', 'success', wp_get_referer()) );
    exit;
}