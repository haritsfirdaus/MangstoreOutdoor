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

?>

<article id="site-content" class="min-h-screen overflow-x-hidden mt-[104px] lg:mt-[148px]">
    
<?php /**get_template_part('template-parts/blocks/block-hero');*/ ?>
<?php 
    echo the_content(  );
?>
</article>

<?php


get_footer();
