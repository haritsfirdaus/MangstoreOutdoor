<?php
$settings = [
    'name' => 'mcd/hero-cta-large',
    'title' => __('Large Hero CTA'),
    'description' => __('Mangcoding hero with CTA'),
    'category' => 'layout',
    'icon' => 'dashicons-embed-post',
    'keywords' => array('hero', 'cta', 'large title', 'heading'),
    'post_types' => array(),
    'render_template' => get_template_directory() . '/template-parts/blocks/hero-cta-large/hero-cta-large.php',
    'align' => 'full',
    'supports' => array(
        'anchor' => true,
        'ariaLabel' => true,
        'className' => false
    ),
    'enqueue_assets' => function () {
        if (is_admin()) {
            wp_enqueue_style('Poppins');
            wp_enqueue_style('Darker Grotesque');
        }
        wp_enqueue_style('hero-cta-large');
        wp_enqueue_script('hero-cta-large');
    },
    'example'  => array(
        'attributes' => array(
            'data' => array(
                'meta_title'   => array(
                    array(
                        'content_of_paragraph' => 'Your Digital',
                        'enable_background' => ''
                    ),
                    array(
                        'content_of_paragraph' => 'Excellence',
                        'enable_background' => 1
                    ),
                    array(
                        'content_of_paragraph' => 'Begins Here',
                        'enable_background' => ''
                    )

                ),
                'meta_descriptions' => 'The Mangcoding team will help build a website for your
                                        <br>
                                        company with quality and guaranteed services, with
                                        <br>
                                        custom templates you can create a website as you like.',
                'meta_button' => Array
                (
                    'title' => 'View More',
                    'url' => '#',
                    'target' => ''
                ),
                'meta_insight' => Array
                (
                    Array
                        (
                            'name' => 'Satisfied Client',
                            'count' => '20'
                        ),
                    Array
                        (
                            'name' => 'Project',
                            'count' => '20',
                        ),
                    Array
                        (
                            'name' => 'Hours of work',
                            'count' => '4000'
                        ),
                    Array
                        (
                            'name' => 'Countries',
                            'count' => '7'
                        )
                
                )
            )
        )
    ),
];
acf_register_block_type($settings);
