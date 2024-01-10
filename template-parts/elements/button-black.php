<?php

$label = array_key_exists('label', $args) ? $args['label'] : 'Button';
$class = 'btn btn_black';
if (array_key_exists('classes', $args)) {
    $class .= ' ' . $args['classes'];
}
$defaultAttrs = [
    'title' => get_bloginfo( 'name' ),
    'type' => 'button'
];
$attr = '';
if (array_key_exists('attrs', $args)) {
    $defaultAttrs = wp_parse_args($args['attrs'], $defaultAttrs);
}
foreach ($defaultAttrs as $key => $value) {
   $attr .= $key . '="' . $value . '" ';
}

?>

<button
    <?php echo $attr; ?>
    class="<?php echo $class; ?>" ><?php echo $label; ?></button>