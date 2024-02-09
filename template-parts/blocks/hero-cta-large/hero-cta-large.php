<?php 
    $metaTitle = !empty(get_field('hero_cta_large__cta_title')) ? get_field('hero_cta_large__cta_title') : $block['example']['attributes']['data']['meta_title'];
    $metaDescription = !empty(get_field('hero_cta_large__descriptions')) ? get_field('hero_cta_large__descriptions') : $block['example']['attributes']['data']['meta_descriptions'];
    $metaButton = !empty(get_field('hero_cta_large__more_link')) ? get_field('hero_cta_large__more_link') : $block['example']['attributes']['data']['meta_button'];
    $metaInsight = !empty(get_field('hero_cta_large__insight')) ? get_field('hero_cta_large__insight') : $block['example']['attributes']['data']['meta_insight'];

    $id = 'hcl-' . $block['id'];
    if( !empty($block['anchor']) ) {
        $id = $block['anchor'];
    }

    $className = 'hero-cta-large';
    if( !empty($block['className']) ) {
        $className .= ' ' . $block['className'];
    }

    // pp($metaInsight);
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?> container pb-12">
    <div class="flex flex-col justify-between relative pb-12 text-center lg:flex-row lg:text-start lg:pb-32">
        <div class="justify-center pt-52 md:pt-36 xl:pt-44 order-2 lg:order-1">
        <h4 class="pb-6"><?php echo wp_kses_post($metaDescription) ?></h4>
            <?php
            get_template_part('template-parts/elements/more-button', 'primary', [
                'link' => $metaButton['url'],
                'label' => $metaButton['title'],
                'target' => !empty($metaButton['target']) ? $metaButton['target'] : '_self',
                'classes' => 'cta-button max-lg:justify-center'
            ]);
            ?>
        </div>
        <img src="<?php echo _RESOURCES_SVG . '/icon-line.svg' ?>" class="svg-img w-20 mt-72 md:mt-64 absolute rotate-90 ml-[40%] md:ml-[45%] lg:w-28 lg:mt-40 lg:ml-[40%] max-xl:-translate-x-1/2 lg:rotate-0 xl:w-40 xl:mt-48 xl:ml-[36%]">

        <h1 class="order-1 lg:order-2 flex flex-col items-center lg:items-end pb-5 lg:pb-0">
            <?php foreach ($metaTitle as $key => $value) : ?>
                <span class="<?php echo 'line-' . $key+1; ?> <?php echo !empty($value['enable_background']) ? 'line-bg-enable' : ''; ?> content-of-paragraph"><?php echo $value['content_of_paragraph'] ?></span>
            <?php endforeach; ?>
        </h1>
    </div>

    <div class="grid grid-cols-2 max-md:gap-4 md:grid-cols-4 justify-items-center border-y-2 pt-4 pb-[31px] border-y-[#D9D9D9] meta-insights">
        <?php foreach ($metaInsight as $key => $value) : ?>
            <div class="flex flex-col gap-2 lg:gap-[14px] item-insight">
                <h5 class="heading-1 font-bold max-lg:text-[36px] max-lg:leading-none"><?php echo $value['count'] ; ?> <span class="heading-1 max-lg:text-[36px] max-lg:leading-none text-primary"> + </span> </h5>
                <p class="font-darkerGrotesque text-xs lg:text-[14px]"><?php echo $value['name'] ; ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>