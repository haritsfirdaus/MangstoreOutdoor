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

<article id="site-content" class="min-h-screen">
    <!-- Sections Latest Posts -->
    <div class="container w-full h-full flex flex-col gap-6 section-latest-posts">
        <?php
        get_template_part('template-parts/post-elements/side-image-content', null, $latestPosts[0])
        ?>

        <!-- 3 card post section -->
        <?php
        if ($latestPosts > 0) :
            ?>
                <div class="<?php echo wp_is_mobile(  ) ? 'swiper w-screen' : 'grid grid-cols-3 gap-6' ?> card-wrapper">
                    <!-- Card Type Slider -->
                    <?php if (wp_is_mobile(  )) : ?>
                        <div class="swiper-wrapper">
                            <?php for ($i = 1; $i < count($latestPosts); $i++) : ?>
                            <div class="swiper-slide">
                                <?php do_action('mcd-loop-cards', $latestPosts[$i]); ?>
                            </div>
                            <?php endfor; ?>
                        </div>
                    <?php else: ?>
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

</article>

<?php

add_action( 'wp_footer', function(){
    ?>
        <script id="card-wrapper-slider-js">
            document.addEventListener('DOMContentLoaded',function(e){
                let cardSlider = document.querySelector('.swiper');
                const swiper = new Swiper(cardSlider, {
                // Optional parameters
                loop: false,
                slidesPerView: 2.5,
                spaceBetween: 24,
                });
            });
        </script>
    <?php
},100 );

get_footer();
