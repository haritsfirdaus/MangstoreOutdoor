<?php 
add_action( 'mcd-loop-cards', function($args){
     $templatePart =
    locate_template('template-parts/cards/card', $args['post_type'] . 'php');
    if ($templatePart) {
        get_template_part('template-parts/cards/card', $args['post_type'], $args['ID']);
    } else {
        get_template_part('template-parts/cards/card-default', null, ['postID' => $args['ID']]);
    }
}, 10, 1 );