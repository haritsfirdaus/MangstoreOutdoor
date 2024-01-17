<?php
$post = new McdPost($args['postID']);
?>


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