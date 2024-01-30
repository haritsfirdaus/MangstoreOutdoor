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

global $wp_query;
add_filter('mcd_filter_post', function ($mapping, $post) {
    $mapping['date'] = get_the_date('j F Y', $post->ID());
    $mapping['category'] = $post->get_primary_post_term('category');
    $mapping['thumbnailID'] = $post->get_thumbnail_ID();
    $mapping['link'] = get_permalink($post->ID());
    $mapping['post_type'] = $post->get_post_type();
    return $mapping;
}, 10, 2);

$latestPosts = mcd_mapping_posts($wp_query->posts, 4);
remove_all_filters('mcd_filter_post', 10);

$latestPostExlude = [];
if (!empty($latestPosts)) {
    $latestPostExlude = array_map(function ($post) {
        return $post['ID'];
    }, $latestPosts);
}

$postCategories = mcd_get_terms([
    'number' => 3
]);
?>

<article id="site-content" class="min-h-screen overflow-x-hidden">
    <!-- Sections Latest Posts -->
    <div class="container w-full h-full flex flex-col gap-6 section-latest-posts">
        <?php
        get_template_part('template-parts/post-elements/side-image-content', null, $latestPosts[0])
        ?>

        <!-- 3 card post section -->
        <?php
        if ($latestPosts > 0) :
        ?>
            <div class="<?php echo wp_is_mobile() ? 'swiper w-screen' : 'grid grid-cols-3 gap-6' ?> card-wrapper">
                <!-- Card Type Slider -->
                <?php if (wp_is_mobile()) : ?>
                    <div class="swiper-wrapper">
                        <?php for ($i = 1; $i < count($latestPosts); $i++) : ?>
                            <div class="swiper-slide">
                                <?php do_action('mcd-loop-cards', $latestPosts[$i]); ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php else : ?>
                    <?php for ($i = 1; $i < count($latestPosts); $i++) : ?>
                        <?php do_action('mcd-loop-cards', $latestPosts[$i]); ?>
                    <?php endfor; ?>
                <?php endif; ?>
                <!-- End Card Type Slider -->
            </div>
        <?php
        endif;
        ?>
        <!-- 3 card post section end -->
    </div>
    <!-- Sections Latest Posts END -->

    <!-- Section Tax - Categories loop -->
    <?php if (!empty($postCategories)) : ?>
        <div class="container w-full h-full mt-12 sections-categories-loop">
            <?php foreach ($postCategories as $key => $category) : ?>
                <div class="flex flex-col gap-6 w-full py-6 lg:py-12 relative category-loop">
                    <?php
                    if (wp_is_mobile()) :
                    ?>
                        <img src="<?php echo _RESOURCES_SVG . '/line-gradient-black-mobile.svg' ?>" class="svg-img absolute top-0 left-1/2 -translate-x-1/2">
                    <?php
                    else :
                    ?>
                        <img src="<?php echo _RESOURCES_SVG . '/line-gradient-black.svg' ?>" class="svg-img absolute top-0 left-1/2 -translate-x-1/2">
                    <?php
                    endif;
                    ?>
                    <div class="flex justify-between w-full items-center category-item">
                        <h2 class="heading-3 max-lg:text-[24px] text-[#001F22] font-bold"><?php echo esc_html__($category->name, _THEMEDOMAIN); ?></h2>
                        <?php
                        get_template_part('template-parts/elements/more-button', 'black', [
                            'link' => esc_url(site_url('/' . $category->taxonomy . '/' . $category->slug)),
                            'label' => 'View More',
                            'attrs' => [
                                'title' => 'Post' . $category->taxonomy . ' ' . $category->name
                            ]
                        ]);
                        ?>
                    </div>
                    <?php
                    add_filter('mcd_filter_post', function ($mapping, $post) {
                        $mapping['post_type'] = $post->get_post_type();
                        return $mapping;
                    }, 10, 2);
                    McdQuery::set('post_type', 'post');
                    McdQuery::set('posts_per_page', 3);
                    McdQuery::set('paged', 1);
                    McdQuery::set('post__not_in', $latestPostExlude);
                    McdQuery::set('cat', $category->term_id);
                    McdQuery::get_query();
                    // $categoryPosts = McdQuery::get_posts();
                    $categoryPosts = mcd_mapping_posts(McdQuery::get_posts(), 4);
                    remove_all_filters('mcd_filter_post', 10);
                    $exclude = array_map(function ($post) {
                        return $post['ID'];
                    }, $categoryPosts);
                    foreach ($exclude as $key => $value) {
                        array_push($latestPostExlude, $value);
                    }
                    McdQuery::resetQuery();
                    ?>
                    <!-- 3 card post section -->
                    <div class="<?php echo wp_is_mobile() ? 'swiper w-screen' : 'flex gap-6' ?> card-wrapper">
                        <?php if (wp_is_mobile()) : ?>
                            <div class="swiper-wrapper">
                                <?php foreach ($categoryPosts as $key => $item) : ?>
                                    <div class="swiper-slide">
                                        <?php do_action('mcd-loop-cards', $item); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php else : ?>
                            <?php foreach ($categoryPosts as $key => $item) : ?>
                                <?php do_action('mcd-loop-cards', $item); ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php

                        ?>
                    </div>
                    <!-- 3 card post section end-->
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <!-- Section Tax - Categories loop End-->

</article>

<?php


get_footer();
