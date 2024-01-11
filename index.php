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
$postCategories = mcd_get_terms(
    [
        'number' => 3
    ]
);
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

// pp($latestPosts);
?>

<article id="site-content" class="min-h-screen">
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

            <!-- 3 card post section -->
            <?php if ($latestPosts > 0) : ?>
                <div class="flex gap-6 card-wrapper">
                    <?php for ($i = 1; $i < count($latestPosts); $i++) : ?>
                        <?php
                        $post = new McdPost($latestPosts[$i]['ID']);
                        ?>
                        <a href="<?php echo esc_url(get_permalink($post->ID())); ?>" title="<?php echo $post->get_title(); ?>" target="_self" class="w-1/3 flex flex-col gap-4 post-item">
                            <?php
                            if (has_post_thumbnail($post->ID())) :
                                echo mcd_html_image($post->get_thumbnail_ID(), [384, 245], 'medium');
                            endif;
                            ?>
                            <div class="px-7 flex flex-col gap-4 post">
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
                                    <p class="body-2 overflow-hidden line-clamp-5 text-[#202020CC]" style="text-overflow: ellipsis;">
                                        <?php echo $post->get_excerpt(McdPost::ExcerptFormat_Excerpt, null, false); ?>
                                    </p>
                                </div>
                                <p class="font-poppins text-[14px] leading-[26.6px] tracking-[0.28px] text-[#202020CC]">
                                    <?php echo get_the_date('j F Y', $post->ID()); ?>
                                </p>
                            </div>
                        </a>
                    <?php endfor; ?>
                </div>

            <?php endif; ?>
        <?php endif; ?>
    </div>
</article>

<?php

get_footer();
