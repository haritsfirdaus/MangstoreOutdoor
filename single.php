<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mcd
 */

 get_header(  );

 $single = new mcdPost();
 ?>

<main id="site-main" class="min-h-screen">
    <header class="single-header <?php echo 'post-type_'.$single->get_post_type(); ?> <?php echo $single->get_post_format() == '' ? 'post-format_standard' : 'post-format_' . $single->get_post_format(); ?>">
        <div class="container">
            <h1>Pencadangan Website</h1>
        </div>
    </header>
    <!-- SITE CONTENT START -->
    <article id="single-content" class="container flex gap-10 pt-[166px] pb-[100px]">
        <div class="w-4/12 px-3 py-6 aside"></div>
        <div class="w-8/12 content-wrapper">
            <?php 
                // pp ($single->get_single_image()); 
                echo $single->get_single_image();
            ?>
        </div>
    </article>
</main>