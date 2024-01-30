<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package mcd
 */

 
/**
 * Die Print
 * $value is Array data for print and die
*/
function dd($value){
    echo '<pre>';
    echo print_r($value);
    echo '</pre>';
    exit;
    return;
}

/**
 * Die Print
 * $value is Array data for print 
*/
function pp($value){
    echo '<pre>';
    echo print_r($value);
    echo '</pre>';
    return;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
if (! function_exists('mcd_body_classes')) {
    function mcd_body_classes($classes)
    {
        // Adds a class of hfeed to non-singular pages.
        if (!is_singular()) {
            $classes[] = 'hfeed';
        }
    
        // Adds a class of no-sidebar when there is no sidebar present.
        if (!is_active_sidebar('sidebar-1')) {
            $classes[] = 'no-sidebar';
        }
    
        return $classes;
    }
}

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
if (! function_exists('mcd_pingback_header')) {
    function mcd_pingback_header()
    {
        if (is_singular() && pings_open()) {
            printf('<link rel="pingback" title="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
        }
    }
}

if ( !function_exists( 'mcd_custom_logo' ) ){
    function mcd_custom_logo(){
        $default_logo = get_theme_mod( 'custom_logo' );
        $default_logo = wp_get_attachment_image_url( $default_logo, 'full');

        if ( !empty( $default_logo ) ) : ?>
            <?php if (display_header_text()==true) : ?>
                <a href="<?php echo esc_url( home_url() ); ?>" class="branding branding_logo branding_with_title"
                    alt="<?php echo get_bloginfo( 'name' ); ?>"
                    title="<?php echo get_bloginfo( 'name' ); ?>"
                    >
                    <img class="svg-img branding-logo" src="<?php echo $default_logo; ?>" 
                        width="24.7px"
                        height="19.41px"
                        alt="<?php echo get_bloginfo( 'name' ); ?>"
                        title="<?php echo get_bloginfo( 'name' ); ?>">
                    <h4 class="font-roboto text-[20px] leading-normal text-[#001F22] font-bold"><?php echo get_bloginfo('name') ?></h4>
                </a>
            <?php else : ?>
                <a href="<?php echo esc_url( home_url() ); ?>" class="branding branding_logo"
                    alt="<?php echo get_bloginfo( 'name' ); ?>"
                    title="<?php echo get_bloginfo( 'name' ); ?>">
                    <img class="svg-img branding-logo" src="<?php echo $default_logo; ?>" 
                        width="24.7"
                        height="19.41px"
                        alt="<?php echo get_bloginfo( 'name' ); ?>"
                        title="<?php echo get_bloginfo( 'name' ); ?>">
                </a>
            <?php endif; ?>
            
        <?php else: ?>
            <a class="branding no_logo" href="<?php echo esc_url( home_url(  ) ); ?>"
                alt="<?php echo get_bloginfo( 'name' ); ?>"
                title="<?php echo get_bloginfo( 'name' ); ?>">
                <?php echo esc_html( get_bloginfo( 'name' ) ); ?>
            </a>
    <?php  endif;
    }
}

/**
 * Remap array positions
 * @param array $array is Array data
 * @param array or object $insert Data for inserting to array
 * @param int $position is Integer for array index position
 * 
 * @return array new mapping array
 */
if (! function_exists('mcd_insertArrayAtPosition')) {
    function mcd_insertArrayAtPosition($array, $insert, $position)
    {
        return array_slice($array, 0, $position, true) + $insert + array_slice($array, $position, null, true);
    }
}

/**
 * Remap array posts
 * @param array $posts is Array posts data
 * @param array $imageSize is array widht and hight image size
 * @return array new mapping array
 */
if (! function_exists('mcd_mapping_posts')) {
    function mcd_mapping_posts($posts, $limit = -1){
        if ($posts) {
            $mapping_posts = [];
            if ($limit !== -1) {
                $posts = array_slice($posts, 0, $limit);
            }
            foreach ($posts as $key => $value) {
                array_push($mapping_posts, mcd_post($value));
            }

            return $mapping_posts;
        }
        return false;
    }
}

/**
 * Get attachment media image datas
 * @param int $imageID is media image ID
 * @param array $size is variable for image sizes attributes
 * @param string $resolution is media image size
 * @param boolean $icon is variable for identifier image icon type
 * @return array new mapping image array
 */

if (! function_exists('mcd_get_media_image')) {
    function mcd_get_media_image($imageID, $size = [384,  245], $resolution = "medium", $icon = false){
        $mapping = [];
        $image = wp_get_attachment_image_src( $imageID, $resolution, $icon );
        
        if ($image) {
            $mapping['icon'] = $icon;
            $mapping['src'] = $image[0] ;
            $mapping['width'] = $size[0] ;
            $mapping['height'] = $size[1] ;
            $mapping['srcset'] = wp_get_attachment_image_srcset( $imageID, $size) ;
            $mapping['meta_data'] = [
                'title' => !empty(get_the_title($imageID)) ? get_the_title($imageID) : get_bloginfo( 'name' ),
                'alt' => !empty(get_post_meta( $imageID, '_wp_attachment_image_alt', true )) ? get_post_meta( $imageID, '_wp_attachment_image_alt', true ) : get_bloginfo( 'description' ),
                'captions' => !empty(wp_get_attachment_caption($imageID)) ? wp_get_attachment_caption($imageID) : get_bloginfo( 'description' ),
                'description' => !empty(get_the_content( null, null, $imageID )) ? get_the_content( null, null, $imageID ) : get_bloginfo( 'description' ),
            ];
            return $mapping;
        }
        return false;
    }
}

/**
 * Get attachment media html image
 * @param int $imageID is media image ID
 * @param array $size is variable for image sizes attributes
 * @param string $resolution is media image size
 * @param boolean $icon is variable for identifier image icon type
 * @param string $classes is variable for custom classes
 * @param string $priority is variable fetch priority default low
 * @return string html image
 */
if (! function_exists('mcd_html_image')) {
    function mcd_html_image($imageID, $size = [384,  245], $resolution = "large", $icon = false, $classes = '', $priority = 'low'){
        $image = mcd_get_media_image( $imageID, $size, $resolution, $icon );
        $htmlImage = '';

        if ($image) {
            $htmlImage = '<img loading="lazy"';
            $htmlImage .= 'class="' . $classes . ' ';
            $htmlImage .=  !empty($icon) ? 'svg-img' : '' ;
            $htmlImage .= '" ';
            $htmlImage .= 'src="' . $image["src"] . '" ';
            $htmlImage .= 'width="' . $size[0] . '" ';
            $htmlImage .= 'height="' . $size[1] . '" ';
            $htmlImage .= 'title="' . $image["meta_data"]["title"] . '" ';
            $htmlImage .= 'alt="' . $image["meta_data"]["alt"] . '" ';
            // $htmlImage .= 'decoding="async" ';
            // $htmlImage .= 'fetchpriority="' . $priority . '"';
            $htmlImage .= '>';

            return apply_filters( 'mcd_filter_html_image', $htmlImage, $image );
            }

        return false;
    }
}


if (!function_exists('mcd_get_card_template')) {
    function mcd_get_card_template($template){
        $template_part = locate_template('template-parts/cards/card-' . get_post_type() . '.php');
        $cardTemplate = 'template-parts/cards/card-default';
        if ($template_part) {
            $cardTemplate = 'template-parts/cards/card-'. $template;
        }

        return apply_filters('filter_mcd_get_card_template', $cardTemplate);
    }
}