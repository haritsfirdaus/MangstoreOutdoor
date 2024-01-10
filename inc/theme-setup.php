<?php
/**
 * Themes Setup
 *
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mcd
 */


 if (!function_exists('themesdev_setup')) {
    /**
	 * Sets up theme defaults and registers support for various
	 * WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme
	 * hook, which runs before the init hook. The init hook is too late
	 * for some features, such as indicating support post thumbnails.
	 */
    function themesdev_setup(){
        /**
		 * Add default posts and comments RSS feed links to <head>.
		 */
        add_theme_support( 'automatic-feed-links' );

        /**
		 * Add support navigation menus.
		 */
        register_nav_menus( array(
            'primary'   => __( 'Primary Menu', 'themesdev' ),
            'secondary' => __( 'Secondary Menu', 'themesdev' )
        ) );

        /**
		 * Enable support for post thumbnails and featured images.
		 */
        add_theme_support( 'post-thumbnails' );

        /**
		 * Enable support for the following post formats:
		 * aside, gallery, quote, image, and video
		 */
        add_theme_support( 'post-formats',  array( 'aside', 'gallery', 'quote', 'image', 'video', 'link' ) );

        add_theme_support( 'html5', array( 
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script' 
            ) 
        );

        add_theme_support( 'editor-styles' );

        add_theme_support( 'responsive-embeds' );

        add_theme_support( 'align-wide' );

        if ( ! isset ( $content_width) ) {
            $content_width = 800;
        }
        
        /*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
        add_theme_support( 'title-tag' );

        add_theme_support( 'custom-logo', array(
            'height'               => 35.26,
            'width'                => 34,
            'flex-height'          => true,
            'flex-width'           => true,
            'header-text'          => array( 'site-title', 'site-description' ),
            'unlink-homepage-logo' => true,
            )
        );

        add_theme_support( 'custom-header', array(
            'default-text-color' => '000',
            'width'              => 1200,
            'height'             => 375,
            'flex-width'         => true,
            'flex-height'        => true,
        ));

        add_theme_support( 'customize-selective-refresh-widgets' );
    }
}

add_action( 'after_setup_theme', 'themesdev_setup' );

add_filter('excerpt_length', function($length){
    $length = 15;
    return $length;
});
add_filter( 'excerpt_more', function ($more){
    return ' ...';
} ); 

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
    }
    show_admin_bar(false);
}

add_filter('body_class', 'mcd_body_classes');

add_action('wp_head', 'mcd_pingback_header');

add_filter('wp_lazy_loading_enabled', '__return_true');

add_action('after_header', function () {
    if (is_home(  )) {
        get_template_part( 'template-parts/elements/search-form', 'black' );
    }
}, 10);


