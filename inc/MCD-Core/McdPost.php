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
        return esc_html__( get_the_title( $this->post_id ), _THEMEDOMAIN );
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
            return esc_html__(human_time_diff($post_date, $current_time) . ' ago', _THEMEDOMAIN);
        } else {
            if ($date_status === 'modified') {
                return esc_html__(get_the_modified_date( $format, $this->post_id ), _THEMEDOMAIN);
            }
            return esc_html__(get_the_date($date_format, $this->post_id), _THEMEDOMAIN);
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
     * @return array terms using mcd_filter_term filters
     */
    public function get_post_terms($taxonomy = 'category', $limit = -1 ) {
        $terms = get_the_terms($this->post_id, $taxonomy);
        if ($terms && is_array($terms)) {
            if ($limit !== -1) {
                $terms = array_slice($terms, 0, $limit);
            }
            return $terms;
        } 
        return ;
    }

    /**
     * get the post primary terms
     * @param string $taxonomy the taxonomy slug
     * @return array terms using mcd_filter_terms filters
     */
    public function get_primary_post_term($taxonomy = 'category') {
        $terms = $this->get_post_terms($taxonomy);

        if (empty($terms)) {
            return null;
        }

        $primary_term_id = get_post_meta($this->post_id, '_'.$taxonomy.'_id', true);

        if (!empty($primary_term_id)) {
            foreach ($terms as $term) {
                if ($term->term_id == $primary_term_id) {
                    return $term;
                }
            }
        }

        return $terms[0];
    }

    /**
     * get the post single thumbnail ID
     * @return int post thumbnail ID
     */
    public function get_thumbnail_ID(){
        if (has_post_thumbnail( $this->post_id )) {
            return get_post_thumbnail_id( $this->post_id );
        }

        return false;
    }

    /**
     * get the post single thumbnail Url
     * @param string $resolution ex: thumbnail, medium, large, full
     * default large
     * @return url post thumbnail Url
     */
    public function get_thumbnail_url($resolution = 'large'){
        if (has_post_thumbnail( $this->post_id )) {
            return get_the_post_thumbnail_url( $this->post_id, $resolution );
        }
        return false;
    }

    /**
     * get the post single thumbnail image
     * @return string HTML post thumbnail
     */
    public function get_single_image(){
        if (has_post_thumbnail( $this->post_id )) {
            $post_thumbnail_id = get_post_thumbnail_id( $this->post_id );
            add_filter( 'mcd_filter_html_image', function( $htmlImage, $image ){
                $htmlImage = '<img loading="lazy"';
                $htmlImage .= 'class="single-post-thumbnail" ';
                $htmlImage .= 'src="' . $image["src"] . '" ';
                $htmlImage .= 'width="1200" ';
                $htmlImage .= 'height="675" ';
                $htmlImage .= 'title="' . get_the_title( $this->post_id ). '" ';
                $htmlImage .= 'alt="' . get_the_excerpt(  ) . '" ';
                $htmlImage .= 'decoding="async" ';
                $htmlImage .= 'fetchpriority="high"';
                $htmlImage .= '>';
                return $htmlImage; 
            }, 10, 2 );

            $html = mcd_html_image($post_thumbnail_id, [1200, 675], 'large', false, '', 'high');
            remove_all_filters( 'mcd_filter_html_image', 10 );

            return $html;

            
        }

        return false;
    }

}