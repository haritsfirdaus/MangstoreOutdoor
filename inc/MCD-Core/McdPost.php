<?php 
/**
 * mcd Post Class
 * mapping and manipulating post data
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mcd
 */
class McdPost {
    const ExcerptFormat_MoreTag = 'more_tag';
    const ExcerptFormat_Excerpt = 'excerpt';

    private $post_id;

    public function __construct($post_id = null) {
        if ($post_id === null && is_single()) {
            global $post;
            $post_id = $post->ID;
        }

        $this->post_id = $post_id;
    }

    /**
     * get the post ID
     * @return int post ID 
     */
    public function ID(){
        return $this->post_id;
    }

    /**
     * get the post type
     * @return string post type
     */
    public function get_post_type() {
        return get_post_type($this->post_id);
    }

    /**
     * get post format
     * @return string post format
     */
    public function get_post_format() {
        $post_type = get_post_format($this->post_id);
        if ($post_type) {
            return $post_type;
        } 
        return '';
    }

    /**
     * get the post title
     * @return string post title 
     */
    public function get_title() {
        return get_the_title( $this->post_id );
    }

    /**
     * get the post excerpt with custom display result
     * 
     * @param Enum $format ExcerptFormat_Excerpt|ExcerptFormat_MoreTag
     * if MoreTag on post content must more tag element
     * @param String $more_link_text for change More label
     * @param Boolean $html it work if $format changed Excerpt format
     * and if true this result excerpt with html tag
     */
    public function get_excerpt($format = self::ExcerptFormat_Excerpt, $more_link_text = null, $html = false) {

        if ($format === 'excerpt') {
            if ($html) {
                return the_excerpt( $this->post_id );
            }else{
                return get_the_excerpt( $this->post_id );
            }
        }elseif ($format === 'more_tag') {
            if ((strpos($post_content, '<!--more-->') !== false)) {
                return get_the_content( $more_link_text, false, $this->post_id );
            }else{
                return the_excerpt( $this->post_id );
            }
        }
    }

    /**
     * get the post content
     * @return html post content 
     */
    public function get_content() {
        return the_content(  );
    }

    /**
     * get the post date
     * @param String $date_status publish|modified post default 'publish'
     * @param String $date_format display format date default null
     * @return String post date publish|modified
     */
    public function get_date($date_status = 'publish', $date_format = null) {
        $post_date = get_post_time('U', false, $this->post_id);

        if ($date_status === 'modified') {
            $post_date = get_post_modified_time( 'U', false, $this->post_id );
        }

        $current_time = current_time('U'); // Date Now

        $time_difference = $current_time - $post_date;

        if ($time_difference < 86400) { // < 24 jam
            return human_time_diff($post_date, $current_time) . ' ago';
        } else {
            if ($date_status === 'modified') {
                return get_the_modified_date( $format, $this->post_id );
            }
            return get_the_date($date_format, $this->post_id);
        }
    }

    /**
     * get the post taxonomies
     * @return array taxonomies using mcd_filter_get_taxonomies filters
     */
    public function get_post_taxonomies() {
        return mcd_get_taxonomies(get_post_type($this->post_id));
    }

    /**
     * get the post terms
     * @param string $taxonomy the taxonomy slug
     * @param array $args the terms arguments
     * @return array terms using mcd_filter_get_terms filters
     */
    public function get_post_terms($taxonomy = 'category', $args = array(
        'orderby' => 'count',
        'order' => 'DESC',
        'hide_empty' => false,
        'number' => 0, 
        'search' => '',
        'name__like' => '',
        'meta_query' => '',
        'meta_key' => array(),
        'meta_value'=> '',
    )) {
        $default_args = [
            'orderby' => 'count',
            'order' => 'DESC',
            'hide_empty' => false,
            'number' => 0, 
            'search' => '',
            'name__like' => '',
            'meta_query' => '',
            'meta_key' => array(),
            'meta_value'=> ''
        ];
        $args['taxonomy'] = $taxonomy;

        $args = wp_parse_args($args, $default_args);
        return mcd_mapping_terms($args);
    }

    public function get_permalink() {
        return get_permalink($this->post_id);
    }

    /**
     * Generate atribute seo
     * default create title and alt using post title
     * @param array $args attribute name dan value
     * @return string attribute
     */
    public function permalink_seo($args = []) {
        $default_args = [
            'title' => get_the_title( $this->post_id ),
            'alt' => get_the_title( $this->post_id ),
        ];

        $args = wp_parse_args($args, $default_args);

        $seo = '';
        foreach ($args as $key => $value) {
           $seo .= $key . '="' . $value . '" ';
        }
        
        return $seo;
    }

    public function get_single_image(){
        if (has_post_thumbnail( $this->post_id )) {
            $post_thumbnail_id = get_post_thumbnail_id( $this->post_id );
            add_filter( 'mcd_filter_html_image', function( $htmlImage, $image ){
                $htmlImage = '<img loading="lazy"';
                $htmlImage .= 'class="single-post-thumbnail" ';
                $htmlImage .= 'src="' . $image["src"] . '" ';
                $htmlImage .= 'width="776" ';
                $htmlImage .= 'height="433" ';
                $htmlImage .= 'title="' . get_the_title( $this->post_id ). '" ';
                $htmlImage .= 'alt="' . get_the_excerpt(  ) . '" ';
                $htmlImage .= 'decoding="async" ';
                $htmlImage .= 'fetchpriority="high"';
                $htmlImage .= '>';
                return $htmlImage; 
            }, 10, 2 );

            $html = mcd_html_image($post_thumbnail_id, [776, 433], 'full', false, '', 'high');
            remove_all_filters( 'mcd_filter_html_image', 10 );

            return $html;

            
        }

        return 'oiuoiuouoiu';
    }

}