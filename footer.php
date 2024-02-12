<?php

/**
 * The template for displaying the footer
 *
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package mcd
 */
global $post;
?>


</main> <!-- MAIN END -->

<footer class="py-[100px] bg-[#001F22] footer">
    <div class="container grid grid-cols-1 max-md:gap-y-[72px] md:grid-cols-2 lg:grid-cols-3 footer-wrapper">
        <div class="max-md:hidden flex flex-col justify-between items-start h-full footer-column-1">
            <div class="flex flex-col gap-4 items-start justify-start max-w-[227px] company-info-wrapper">
                <p class="company-info company-info__address font-darkerGrotesque text-[24px] font-bold leading-[24px] text-[#DDDDDD]">
                    PT Anugrah Kreasi Digital. karang tengah, Cibadak - Sukabumi
                </p>
                <p class="company-info company-info__contact font-darkerGrotesque text-[24px] font-bold leading-[24px] text-[#DDDDDD]">
                    <a href="mailto:hello@mangcoding.com" class="company-info__email">hello@mangcoding.com</a>
                    0266-6532078
                    WA:0857-5940-2332
                </p>
            </div>

            <button class="footer-logo" title="<?php echo get_bloginfo('name') . ' White Logo'; ?>">
                <img class="svg-img" src="<?php echo _RESOURCES_SVG . '/logo-white.svg' ?>" alt="<?php echo get_bloginfo('name') . 'White Logo'; ?>" title="<?php echo get_bloginfo('name') . 'White Logo'; ?>">
            </button>
        </div>
        <div class="flex flex-col justify-between lg:-ml-20 footer-column-2">
            <p class="max-md:hidden font-darkerGrotesque text-[16px] font-bold leading-normal text-white label mb-[41px]">
                How can we help ?
            </p>
            <?php
            $menus = [
                [
                    'label' => "Home",
                    'path'  => get_home_url()
                ],
                [
                    'label' => "About",
                    'path'  => get_home_url()
                ],
                [
                    'label' => "Services",
                    'path'  => get_home_url()
                ],
                [
                    'label' => "Blog",
                    'path'  => get_home_url()
                ],
                [
                    'label' => "Work",
                    'path'  => get_home_url()
                ]
            ];
            ?>
            <ul class="flex flex-col max-md:items-center gap-8 md:gap-4 footer-menus">
                <?php foreach ($menus as $key => $menu) : ?>
                    <li class="footer-menu-item">
                        <a href="<?php echo $menu['path']; ?>" class="max-md:text-center font-darkerGrotesque text-[64px] leading-[24px] font-medium tracking-[65] text-[#DDDDDD]" alt="<?php echo $menu['label'] . " Page"; ?>" title="<?php echo $menu['label'] . " Page"; ?>" target="_self"><?php echo $menu['label']; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="flex flex-col justify-between items-end footer-column-3">
            <div class="trusted-partner">
                <p class="font-darkerGrotesque text-[16px] font-bold leading-normal text-white label mb-5 ">
                    Trusted partner
                </p>
                <?php 
                    $partners = [
                        ['label' => 'Orely', 'path'=> _RESOURCES_IMAGES . '/orely.png', 'url' => 'https://orely.co' ],
                        ['label' => 'Kiwa', 'path'=> _RESOURCES_IMAGES . '/kiwa.png', 'url' => '#' ],
                        ['label' => 'Sans Broters', 'path'=> _RESOURCES_IMAGES . '/sans-brothers.png', 'url' => '#' ],
                    ];
                ?>

                <ul class="flex flex-wrap gap-4 max-w-[224px] partners">
                    <?php foreach ($partners as $key => $partner) : ?>
                        <li class="partner-item">
                            <a href="<?php echo $partner['url'] ?>" 
                                alt="<?php echo $partner['label'] . ' partner' ?>"
                                title="<?php echo $partner['label'] . ' partner' ?>"
                                <?php echo $partner['url'] !== '#' ? 'target="_blank" ' : 'target="_self" ' ?> >
                                <img src="<?php echo $partner['path']; ?>" alt="<?php echo $partner['label'] . ' partner' ?>" title="<?php echo $partner['label'] . ' partner' ?>">
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</footer>




<?php wp_footer(); ?>
</body>

</html>