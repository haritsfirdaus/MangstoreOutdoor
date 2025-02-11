<?php

/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mcd
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php do_action('before_head') ?>
    <?php wp_head(); ?>
    <?php do_action('after_head') ?>
</head>


<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div class="w-full h-screen flex items-center justify-center absolute top-0 -z-50 opacity-0 transition-opacity duration-300 preloader bg-primary blur-sm">
        <span class="heading-1">..PRELOADER..</span>
    </div>
    <main id="site" class="bg-white"><!-- MAIN START -->
        <?php do_action('before_header'); ?>

        <header id="masthead" class="w-full absolute top-0 left-0 site-header"> <!-- HEADER START -->
            <nav class="flex lg:py-4 max-lg:pt-8 max-lg:pb-[25px] items-center gap-20 container header-primary header-desktop justify-between">
                <?php mcd_custom_logo(); ?>
                <ul>

                </ul>
                <button class="flex items-center justify-center w-[24px] h-[24px] lg:hidden mobile-menu">
                    <img class="svg-img" src="<?php echo _RESOURCES_SVG . '/mobile-menu-gray.svg' ?>" alt="Mobile Menu" title="Mobile Menu">
                </button>
                <div class="flex items-center gap-10 header-actions max-lg:hidden">
                    <button title="Search">
                        <img class="svg-img" src="<?php echo _RESOURCES_SVG . '/ico-search-black.svg' ?>" alt="Search" title="Search">
                    </button>
                    <?php get_template_part('template-parts/elements/link-button', 'black', [
                        'label' => 'Get In Touch',
                        'link' => site_url()
                    ]) ?>
                </div>
            </nav>
                <div class="container w-full lg:hidden">
                    <div class="max-lg:border-b max-lg:border-b-[#001F22] h-1"></div>
                </div>
        </header> <!-- HEADER END -->
        <?php do_action('after_header'); ?>