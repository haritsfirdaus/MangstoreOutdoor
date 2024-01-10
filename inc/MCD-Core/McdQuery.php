<?php
/**
 * mcd Static Query Class
 * init static wp_query and result wp_query and modifer funtions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package mcd
 */

class McdQuery {
    private static $args = [];
    private static $query = [];

    public static function set($key, $value) {
        self::$args[$key] = $value;
    }

    public static function resetQuery(){
        self::$args = [];
        wp_reset_query(  );
    }

    public static function get_query() {
        self::$query = new WP_Query(self::$args);
        return self::$query;
    }
    

    public static function current_paged() {
        return self::$query->query['paged'] ? (int) self::$query->query['paged'] : 1;
    }

    public static function total_posts() {
        return self::$query->found_posts;
    }

    public static function total_pages() {
        return self::$query->max_num_pages;
    }

    public static function has_next_page() {
        return mcdQuery::current_paged() < mcdQuery::total_pages() ? true : false;
    }

    public static function get_posts() {
        return self::$query->posts;
    }

}