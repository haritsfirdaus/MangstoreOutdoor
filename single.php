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

<article id="site-content" class="mt-[132px]">
    <!-- Single Wrapper -->
    <!-- single header -->
    <header class="mb-12 container single-header">
        <!-- single thumbnail image -->
        <?php echo $single->get_single_image(); ?>
        <!-- single thumbnail image end -->
    </header>
    <!-- single header end -->
    <!-- Single Wrapper -->
    <div class="single-wrapper">
        <!-- Single Content Wrapper -->
        <div class="container flex flex-col gap-12 relative single-content-wrapper">
            <!-- Post Top Meta -->
            <div class="max-w-[792px] flex flex-col items-start gap-2 post-top-meta">
                <!-- Post Date Meta -->
                <div class="flex gap-2 post__meta-date">
                    <p class="body-1 text-[#969696] "><?php echo get_the_date('j F Y', $single->ID()); ?></p>
                    <span class="body-1 text-[#0EC5D7]">-</span>
                    <p class="body-1 text-[#969696] "><?php echo $single->get_date(); ?></p>
                </div>
                <!-- Post Date Meta End-->
                <!-- Single Title -->
                <div class="flex flex-col gap-6 item-start post__meta-title">
                    <h1 class="heading-2 font-bold text-[#001F22]"><?php echo $single->get_title(); ?></h1>
                    <div class="flex gap-8 social-share">
                        <button class="share__instagram w-8 h-8 rounded-full bg-[#F5F5F5] inline-flex items-center justify-center" title="Share To Instagram">
                            <img src="<?php echo _RESOURCES_SVG . '/ico-instagram-primary.svg'; ?>" alt="Instagram" class="svg-img">
                        </button>
                        <button class="share__twitter w-8 h-8 rounded-full bg-[#F5F5F5] inline-flex items-center justify-center" title="Share To Instagram">
                            <img src="<?php echo _RESOURCES_SVG . '/ico-twitter-primary.svg'; ?>" alt="twitter" class="svg-img">
                        </button>
                        <button class="share__facebook w-8 h-8 rounded-full bg-[#F5F5F5] inline-flex items-center justify-center" title="Share To Instagram">
                            <img src="<?php echo _RESOURCES_SVG . '/ico-facebook-primary.svg'; ?>" alt="facebook" class="svg-img">
                        </button>
                        <button class="share__link w-8 h-8 rounded-full bg-[#F5F5F5] inline-flex items-center justify-center" title="Share To Instagram">
                            <img src="<?php echo _RESOURCES_SVG . '/ico-link-primary.svg'; ?>" alt="copy link" class="svg-img">
                        </button>
                    </div>
                </div>
                <!-- Single Title End -->
            </div>
            <!-- Post Top Meta End -->
    
            <!-- Post sidebar -->
            <aside class="absolute top-0 left-1/2 transform translate-x-[75%] w-[333px] mt-[240px] single-side">
                <h3 class="heading-3 text-[#001F22] font-bold mb-7">Latest news</h3>
                <?php 
                    McdQuery::set('posts_per_page', 4);
                    McdQuery::set('paged', 1);
                    McdQuery::set('post__not_in', [get_the_ID()]);
                    $query = McdQuery::get_query();
                    $latestPosts = McdQuery::get_posts();
                    McdQuery::resetQuery();
                ?>
                <?php if(!empty($latestPosts)) : ?>
                    <div class="flex flex-col gap-4 items-start latest-posts-side-wrapper">
                        <?php foreach ($latestPosts as $key => $value) : 
                            $post = new McdPost($value->ID); ?>
                            <a href="<?php echo esc_url(get_permalink( $post->ID())); ?>" 
                                title="<?php echo $post->get_title(); ?>" 
                                target="_self"
                                class="flex flex-col items-start justify-center gap-4 pb-4 relative latest-item">
                                <div class="flex flex-col gap-2 items-start">
                                    <?php if (!empty($post->get_primary_post_term('category'))) : ?>
                                        <span class="font-poppins text-[#0EC5D7] text-[14px] font-semibold leading-normal"><?php echo $post->get_primary_post_term('category')->name ; ?></span>
                                    <?php endif; ?>
                                    <h4 class="heading-5 font-semibold text-[#001F22] leading-[28.8px]"><?php echo $post->get_title() ?></h4>
                                </div>
                                <p><?php echo get_the_date( 'j F Y', $post->ID() ) ?></p>
                                <img src="<?php echo _RESOURCES_SVG . '/line-gradient-black.svg' ?>" class="svg-img absolute bottom-0 left-0 right-0">
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

            </aside>
            <!-- Post sidebar end-->
    
            <!-- Post Content -->
            <div class="max-w-[792px] single-content">
                <?php echo $single->get_content(); ?>
            </div>
            <!-- Post Content End -->
        </div>
        <!-- Single Content Wrapper end-->
    </div>
    <!-- Single Wrapper End -->

</article>