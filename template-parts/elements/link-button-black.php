<?php

$label = array_key_exists('label', $args) ? $args['label'] : 'Button';
$link = array_key_exists('link', $args) ? $args['link'] : '#';
$target = array_key_exists('target', $args) ? $args['target'] : '_self';
$class = 'btn btn_black';
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
    class="<?php echo $class; ?>" ><?php echo $label; ?></a>