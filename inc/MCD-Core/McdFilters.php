<?php

/**
 * Register filters - mcd_filter_post_card
 * Remap array post
 * @param array $post is Array post data
 * @param array $imageSize is array widht and hight image size
 * @return array new mapping array
 */
if (! function_exists('mcd_mapping_post_card')) {
    function mcd_mapping_post_card($post){
        $post = get_post($post->ID);
        if ($post) {
            $mapping = [
                'ID' => $post->ID,
                'title' => get_the_title( $post->ID ),
                'publish_date' => get_the_date( null, $post->ID ),
                'excerpt' => get_the_excerpt( $post->ID ),
            ];
            return apply_filters( 'mcd_filter_post_card', $mapping, $post );
        }
        return false;
    }
}

/**
 * Register filters - mcd_filter_get_taxonomies
 * Remap array get_object_taxonomies
 * @param string $post_type is  argument post_type
 * @return array new mapping array
 */
if (! function_exists('mcd_get_taxonomies')) {
    function mcd_get_taxonomies($post_type = 'post'){
        $taxonomies = get_object_taxonomies( $post_type, 'object' );
        if ($taxonomies) {
            $mapping = [];
            foreach ($taxonomies as $key => $taxonomy) {
                if ($taxonomy->name !== 'post_format') {
                    $item = [
                        'name' => $taxonomy->name,
                        'label' => $taxonomy->label,
                        'description' => $taxonomy->description,
                    ];
                    array_push($mapping, $item);
                }
            }
            return apply_filters( 'mcd_filter_get_taxonomies', $mapping, $taxonomies );
        }
        return false;
    }
}

/**
 * Register filters - mcd_filter_get_terms
 * Remap array get_terms
 * @param array $term_args is Array argument get_terms
 * @return array new mapping array
 */
if (! function_exists('mcd_get_terms')) {
    function mcd_get_terms($args = array()){
        $term_args = array (
            'taxonomy' => 'category', 
            'orderby' => 'count',
            'order' => 'DESC',
            'hide_empty' => false,
            'number' => false, 
            'search' => '',
            'name__like' => '',
            'meta_query' => '',
            'meta_key' => array(),
            'meta_value'=> '',
        );

        $args = wp_parse_args($args, $term_args);

        $terms = get_terms( $term_args );
        if ($terms) {
            $mapping = [];
            foreach ($terms as $key => $term) {
                array_push($mapping, $term);
            }
            return apply_filters( 'mcd_filter_get_terms', $mapping, $terms );
        }
        return false;
    }
}