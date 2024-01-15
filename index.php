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
    $mapping['singleImage'] = $post->get_single_image();
    $mapping['link'] = get_permalink($post->ID());
    return $mapping;
}, 10, 2);

$latestPosts = mcd_mapping_posts($wp_query->posts, 4);
remove_all_filters('mcd_filter_post', 10);

$latestPostExlude = array_map(function ($post) {
    return $post['ID'];
}, $latestPosts);

$postCategories = mcd_get_terms([
    'number' => 3
]);
?>

<article id="site-content" class="min-h-screen">
    <!-- Sections Latest Posts -->
    <div class="container w-full h-full flex flex-col gap-6 section-latest-posts">
        <?php if (!empty($latestPosts)) : ?>
            <!-- large post section -->
            <div class="w-full h-full flex gap-6 justify-start large-post">
                <div class="w-1/2 img-wrapper">
                    <?php
                    echo $latestPosts[0]['singleImage'];
                    ?>
                </div>
                <div class="w-1/2 flex flex-col gap-4 post-content">
                    <div class="flex gap-2 items-center">
                        <p class="font-poppins text-[14px] font-normal leading-[26.6px] tracking-[0.28px] text-[#001F22]">
                            <?php echo $latestPosts[0]['category']->name; ?>
                        </p>
                        <span class="w-[5px] h-[5px] rounded-full bg-[#0EC5D7]"></span>
                        <p class="font-poppins text-[14px] font-normal leading-[26.6px] tracking-[0.28px]">
                            <?php echo $latestPosts[0]['publish_date']; ?>
                        </p>
                    </div>
                    <h1 class="font-darkerGrotesque text-[48px] font-bold leading-[48px] text-[#202020]">
                        <?php echo $latestPosts[0]['title']; ?>
                    </h1>
                    <p class="font-poppins text-[14px] leading-[26.6px] tracking-[0.28px] text-[#202020CC]">
                        <?php echo $latestPosts[0]['date']; ?>
                    </p>
                    <p class="body-2 overflow-hidden line-clamp-5 text-[#202020CC]" style="text-overflow: ellipsis;">
                        <?php echo $latestPosts[0]['excerpt']; ?>
                    </p>
                    <a href="<?php echo esc_url($latestPosts[0]['link']); ?>" class="body-2 inline-flex items-center gap-2 text-[#001F22] post-permalink" title="<?php echo $latestPosts[0]['title']; ?>" target="_self">
                        Read Details
                        <img src="<?php echo _RESOURCES_SVG . '/ico-link-black.svg'; ?>" class="svg-img" alt="<?php 'Read More ' . $latestPosts[0]['title']; ?>" width="25" height="25">
                    </a>
                </div>
            </div>
            <!-- large post section end -->

            <!-- 3 card post section -->
            <?php if ($latestPosts > 0) : ?>
                <div class="flex gap-6 card-wrapper">
                    <?php for ($i = 1; $i < count($latestPosts); $i++) : ?>
                        <?php $post = new McdPost($latestPosts[$i]['ID']); ?>
                        <a href="<?php echo esc_url(get_permalink($post->ID())); ?>" title="<?php echo $post->get_title(); ?>" target="_self" class="w-1/3 flex flex-col gap-4 post-item">
                            <?php
                            if (has_post_thumbnail($post->ID())) :
                                echo mcd_html_image($post->get_thumbnail_ID(), [384, 245], 'medium');
                            endif;
                            ?>
                            <div class="flex flex-col gap-4 post">
                                <div class="flex flex-col gap-2">
                                    <div class="flex gap-2 items-center">
                                        <p class="font-poppins text-[14px] font-normal leading-[26.6px] tracking-[0.28px] text-[#001F22]">
                                            <?php echo $post->get_primary_post_term('category')->name; ?>
                                        </p>
                                        <span class="w-[5px] h-[5px] rounded-full bg-[#0EC5D7]"></span>
                                        <p class="font-poppins text-[14px] font-normal leading-[26.6px] tracking-[0.28px]">
                                            <?php echo $post->get_date(); ?>
                                        </p>
                                    </div>
                                    <h2 class="font-bold heading-5 text-[#202020]"> <?php echo $post->get_title(); ?></h2>
                                    <p class="body-2 overflow-hidden line-clamp-3 text-[#202020CC]" style="text-overflow: ellipsis;">
                                        <?php echo $post->get_excerpt(McdPost::ExcerptFormat_Excerpt, null, false); ?>
                                    </p>
                                </div>
                                <p class="font-poppins text-[14px] leading-[26.6px] tracking-[0.28px] text-[#202020CC]">
                                    <?php echo get_the_date('j F Y', $post->ID()); ?>
                                </p>
                            </div>
                        </a>
                        <?php unset($post); ?>
                    <?php endfor; ?>
                </div>

            <?php endif; ?>
            <!-- 3 card post section end -->
        <?php endif; ?>
    </div>
    <!-- Sections Latest Posts END -->

    <!-- Section Tax - Categories loop -->
    <?php if (!empty($postCategories)) : ?>
        <div class="container w-full h-full mt-12 sections-categories-loop">
            <!-- Categori loop -->
            <?php foreach ($postCategories as $key => $category) : ?>
                <div class="flex flex-col gap-6 w-full py-12 relative category-loop">
                    <img src="<?php echo _RESOURCES_SVG . '/line-gradient-black.svg' ?>" class="svg-img absolute top-0 left-1/2 -translate-x-1/2">
                    <div class="flex justify-between w-full items-center category-item">
                        <h2 class="heading-3 text-[#001F22] font-bold"><?php echo esc_html__($category->name, _THEMEDOMAIN); ?></h2>
                        <a href="<?php echo esc_url(site_url('/' . $category->taxonomy . '/' . $category->slug)); ?>" class="body-2 leading-normal inline-flex items-center gap-2 text-[#001F22] category-permalink" title="<?php echo 'Post' . $category->taxonomy . ' ' . $category->name; ?>" target="_self">
                            View More
                            <img src="<?php echo _RESOURCES_SVG . '/ico-link-black.svg'; ?>" class="svg-img" alt="<?php 'View More ' . 'All Posts HTML'; ?>" width="25" height="25">
                        </a>
                    </div>
                    <?php
                        McdQuery::set('post_type', 'post');
                        McdQuery::set('posts_per_page', 3);
                        McdQuery::set('paged', 1);
                        McdQuery::set('post__not_in', $latestPostExlude); 
                        McdQuery::set('cat', $category->term_id); 
                        $query = McdQuery::get_query();
                        $categoryPosts = McdQuery::get_posts();
                        $exclude = array_map(function($post){
                                return $post->ID;
                        }, $categoryPosts);
                        foreach ($exclude as $key => $value) {
                            array_push($latestPostExlude, $value);
                        }
                        McdQuery::resetQuery();
                    ?>
                    <!-- 3 card post section -->
                    <div class="flex gap-6 card-wrapper">
                    <?php foreach ($categoryPosts as $key => $item) : ?>
                        <?php $post = new McdPost( $item->ID ); ?>
                        <a href="<?php echo esc_url(get_permalink( $post->ID())); ?>" 
                            title="<?php echo $post->get_title(); ?>" 
                            target="_self" class="w-1/3 flex flex-col gap-4 post-item">
                            <?php
                            if (has_post_thumbnail($post->ID())) :
                                echo mcd_html_image($post->get_thumbnail_ID(), [384, 245], 'medium');
                            endif;
                            ?>
                            <div class="flex flex-col gap-4 post">
                                <div class="flex flex-col gap-2">
                                    <div class="flex gap-2 items-center">
                                        <p class="font-poppins text-[14px] font-normal leading-[26.6px] tracking-[0.28px] text-[#001F22]">
                                            <?php echo $post->get_primary_post_term('category')->name; ?>
                                        </p>
                                        <span class="w-[5px] h-[5px] rounded-full bg-[#0EC5D7]"></span>
                                        <p class="font-poppins text-[14px] font-normal leading-[26.6px] tracking-[0.28px]">
                                            <?php echo $post->get_date(); ?>
                                        </p>
                                    </div>
                                    <h2 class="font-bold heading-5 text-[#202020]"> <?php echo $post->get_title(); ?></h2>
                                    <p class="body-2 overflow-hidden line-clamp-3 text-[#202020CC]" style="text-overflow: ellipsis;">
                                        <?php echo $post->get_excerpt(McdPost::ExcerptFormat_Excerpt, null, false); ?>
                                    </p>
                                </div>
                                <p class="font-poppins text-[14px] leading-[26.6px] tracking-[0.28px] text-[#202020CC]">
                                    <?php echo get_the_date('j F Y', $post->ID()); ?>
                                </p>
                            </div>
                        </a>
                        <?php unset($post); ?>
                    <?php endforeach; ?>
                    </div>
                    <!-- 3 card post section end-->
                </div>
            <?php endforeach; ?>
            <!-- Categori loop End-->
        </div>
        <!-- Section Tax - Categories loop End-->
    <?php endif; ?>
</article>

<?php

get_footer();
