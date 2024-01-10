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

get_header();

$single = new mcdPost();
?>

<article id="site-content" class="container mt-[132px]">
    <header>
        <?php echo $single->get_single_image(); ?>
    </header>
</article>