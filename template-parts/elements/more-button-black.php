<?php

$label = array_key_exists('label', $args) ? $args['label'] : 'Read Detail';
$link = array_key_exists('link', $args) ? $args['link'] : '#';
$target = array_key_exists('target', $args) ? $args['target'] : '_self';
$class = 'body-2 max-md:text-[11.15px] max-md:leading-[21.19px] max-md:tracking-[0.223px] inline-flex items-center gap-2 text-[#001F22] overflow-hidden post-permalink';
if (array_key_exists('classes', $args)) {
    $class .= ' ' . $args['classes'];
}
$defaultAttrs = [
    'title' => get_bloginfo( 'name' )
];
$attr = '';
if (array_key_exists('attrs', $args)) {
    $defaultAttrs = wp_parse_args($args['attrs'], $defaultAttrs);
}

foreach ($defaultAttrs as $key => $value) {
   $attr .= $key . '="' . $value . '" ';
}

?>

<a href="<?php echo esc_url( $link); ?>"
    <?php echo $attr; ?> 
    target="<?php echo $target; ?>" 
    class="group min-w-[109px] min-h-[24px] <?php echo $class; ?>" >
        <?php echo $label; ?>
        <div class="icon-wrapper relative">
            <img src="<?php echo _RESOURCES_SVG . '/ico-link-black.svg'; ?>" class="svg-img icon-black transition-all duration-300 absolute top-1/2 -translate-y-1/2 z-10 group-hover:-translate-y-[150%]" alt="<?php 'Read More'; ?>" width="25" height="25">
            <img src="<?php echo _RESOURCES_SVG . '/ico-link-blue.svg'; ?>" class="svg-img icon-blue transition-all duration-300 absolute top-full translate-y-[125%] group-hover:-translate-y-1/2" alt="<?php 'Read More'; ?>" width="25" height="25">
        </div>
    </a>