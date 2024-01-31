<?php
// pp($args);
?>

<!-- Wrapper Open -->
<div class="w-full h-full flex flex-col md:flex-row gap-6 justify-start side-image-content image-left">
    <!-- Left Content -->
    <div class="w-full md:w-1/2 overflow-hidden img-wrapper">
        <!-- generate image -->
        <?php
        if (wp_is_mobile(  )) {
            echo mcd_html_image($args['thumbnailID'], [690, 440], 'medium', false, 'h-full', 'high');
        }else{
            echo mcd_html_image($args['thumbnailID'], [690, 440], 'medium', false, 'h-full', 'high');
        }
        ?>
    </div>
    <!-- Righ Content -->
    <div class="w-full md:w-1/2 flex flex-col gap-4 post-content">
        <!-- Meta Category and publish date -->
        <div class="flex gap-2 items-center post-meta">
            <p class="font-poppins md:text-[12px] lg:text-[14px] font-normal leading-[26.6px] tracking-[0.28px] text-[#001F22]">
                <?php echo $args['category']->name; ?>
            </p>
            <span class="w-[5px] h-[5px] rounded-full bg-[#0EC5D7]"></span>
            <p class="font-poppins md:text-[12px] lg:text-[14px] font-normal leading-[26.6px] tracking-[0.28px]">
                <?php echo $args['publish_date']; ?>
            </p>
        </div>
        <!-- Post Content -->
        <div class="flex flex-col gap-4 post-content">
            <h1 class="font-darkerGrotesque font-bold text-[#202020] text-[24px] leading-[24px] lg:text-[48px] lg:leading-[48px]">
                <?php echo $args['title']; ?>
            </h1>
            <p class="font-poppins md:text-[12px] lg:text-[14px] leading-[26.6px] tracking-[0.28px] text-[#202020CC]">
                <?php echo $args['date']; ?>
            </p>
            <p class="body-2 overflow-hidden md:line-clamp-3 lg:line-clamp-5 text-[#202020CC]" style="text-overflow: ellipsis;">
                <?php echo $args['excerpt']; ?>
            </p>
            <?php 
                get_template_part( 'template-parts/elements/more-button', 'black', [
                    'link' => $args['link'],
                    'label' => 'Read More'
                ] );
            ?>
        </div>
    </div>
</div> <!-- Wrapper Close -->