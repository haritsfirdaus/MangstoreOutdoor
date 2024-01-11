<?php

/**
 * Register filters - mcd_filter_post_card
 * Remap array post
 * @param array $post is Array post data
 * @param array $imageSize is array widht and hight image size
 * @return array new mapping array
 */
if (! function_exists('mcd_post')) {
    function mcd_post($post){
        $post = new McdPost($post->ID);
        if ($post) {
            $mapping = [
                'ID' => $post->ID(),
                'title' => $post->get_title(),
                'publish_date' => $post->get_date(),
                'excerpt' => $post->get_excerpt(McdPost::ExcerptFormat_Excerpt, null, false),
            ];
            return apply_filters( 'mcd_filter_post', $mapping, $post );
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

        $termArgs = wp_parse_args($args, $term_args);

        $terms = get_terms( $termArgs );
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