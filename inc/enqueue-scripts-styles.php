<?php
add_action('wp_head', function () {
    echo '<meta name="robots" content="index, archive" />';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
    echo '<script rel="preconnect" type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js" crossorigin></script>';
    if (!is_archive(  ) || !is_home(  )) {
        echo '<meta name="description" content="'. get_the_title(  ) .'">';
    }
});

add_action('wp_enqueue_scripts', function () {
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_style('Roboto');
    wp_enqueue_style('Plus Jakarta Sans');
    wp_enqueue_style('Poppins');
    wp_enqueue_style('Darker Grotesque');
    wp_enqueue_style('inter');

    wp_enqueue_style('app');
    // wp_enqueue_script( 'app' );

    if (is_single(get_the_ID())) {
        if ('post' == get_post_type(get_the_ID())) {
            wp_enqueue_style('Single');
        }
    }



    //remove block library
    if (!is_admin()) {
        // Disable Gutenberg editor.
        add_filter('use_block_editor_for_post_type', '__return_false', 10);
        // Don't load Gutenberg-related stylesheets.
        add_action('wp_enqueue_scripts', 'remove_block_css', 100);
        function remove_block_css()
        {
            wp_dequeue_style('wp-block-library'); // Wordpress core
            wp_dequeue_style('wp-block-library-theme'); // Wordpress core
            wp_dequeue_style('wc-block-style'); // WooCommerce
            wp_dequeue_style('storefront-gutenberg-blocks'); // Storefront theme
        }
    }
});
