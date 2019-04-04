<?php

/*
 *  ==========================
 *   Load domain
 *  ==========================
 */
add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup()
{
    load_theme_textdomain('coders');
}

function add_file_types_to_uploads($file_types)
{
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg+xml';
    $file_types = array_merge($file_types, $new_filetypes);
    return $file_types;
}

add_action('upload_mimes', 'add_file_types_to_uploads');

/*
 *  ==========================
 *   Include Scripts
 *  ==========================
 */
add_action('wp_enqueue_scripts', 'massage_script_enqueue', 0);
function massage_script_enqueue()
{
    wp_enqueue_style('fancy-box', get_template_directory_uri() . '/assets/css/fancy.box.min.css', '', '', 'all');
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css', '', '', 'all');
    wp_enqueue_style('theme-style', get_template_directory_uri() . '/style.css', null, time(), 'all');


    wp_enqueue_script('jquery');
    wp_enqueue_script('fancy', get_template_directory_uri() . '/assets/js/fancy.box.min.js');
    wp_enqueue_script('owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js');
    wp_enqueue_script('theme', get_template_directory_uri() . '/assets/js/theme.js', '', time());

}

add_action('admin_enqueue_scripts', 'vine_load_script_to_admin_panel');
function vine_load_script_to_admin_panel()
{
    wp_enqueue_style('admin', get_template_directory_uri() . '/assets/admin.css', 'Admin css panel', time(), 'all');
    wp_enqueue_script('vine_admin', get_template_directory_uri() . '/assets/js/admin-panel.js', 'Admin panel', time(), true);
}

/*
 *  ==========================
 *   Twig || Timber
 *  ==========================
 */
if (in_array('timber-library/timber.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    Timber::$dirname = array('templates', 'visual_composer/templates', 'model/theme_settings');
}

/*
 *  ==========================
 *   Redux Framework ude
 *  ==========================
 */
if (!isset($redux_demo) && file_exists(dirname(__FILE__) . '/model/admin/config.php')) {
    require_once(dirname(__FILE__) . '/model/admin/config.php');
    require_once 'model/admin/css-controller.php';
    require_once 'model/admin/UseConfig.php';
}

/*
 *  ==========================
 *   Theme init
 *  ==========================
 */
add_action('init', 'wordpress_ready');
function wordpress_ready()
{
    add_theme_support('menus');
    register_nav_menu('primary', 'Primary Header Navigation');
    add_theme_support('post-thumbnails', array('post')); // Posts and Movies

}

function event_ajax()
{


    $month = $_POST['month'];
    $year = $_POST['year'];

    $args_event = array(
        'post_type' => 'event',
        'post_per_page' => -1,
        'post_status' => 'publish',
        'meta_key' => 'date_event',
        'orderby' => 'meta_value',
        'order' => 'ASC',
        'meta_query' => array(
            'relation' => 'AND',
            array(
                'key' => 'date_event',
                'value' => $year . $month . '01',
                'compare' => '>=',
            ),
            array(
                'key' => 'date_event',
                'value' => $year . $month . '31',
                'compare' => '<=',
            ),
            array(
                'key' => 'date_event',
                'value' => date('Ymd'),
                'type' => 'DATE',
                'compare' => '>=',
            ),
        ),
    );

    $context = Timber::get_context();
    $event_post = get_post_type_object('event');
    $context['general'] = array(
        'event' => array(
            'slug' => $event_post->rewrite['slug'],
        )
    );

    $context['event'] = Timber::get_posts($args_event);
    $templates = array('view/event/base.twig');
    Timber::render($templates, $context);
    die();
}

add_action('wp_ajax_event_ajax', 'event_ajax');
add_action('wp_ajax_nopriv_event_ajax', 'event_ajax');


/*
 *  ==========================
 *   Theme add plugin, panel admin, class
 *  ==========================
 */

include_all_files_from_directory(get_template_directory() . '/model/');


/*
 *  ==========================
 *   WP Functions
 *  ==========================
 */

function get_file_from_directory(string $directory): array
{
    $files = scandir(get_template_directory() . "/$directory");
    $files_array = array();

    foreach ($files as $file) {
        if ('.' !== $file && '..' !== $file) {
            $file_name = $file;
            $file_slug = str_replace('.php', '', $file);

            array_push($files_array, array(
                'name' => $file_name,
                'slug' => $file_slug,
            ));
        }
    }

    return $files_array;

}

function include_all_files_from_directory(string $absolute_path, $type = false)
{
    $files = scandir($absolute_path);
    foreach ($files as $file) {
        if (strpos($file, '.php')) { // check if is file .php
            if ('.' !== $file && '..' !== $file) {

                $file_slug = str_replace('.php', '', $file);

                $path = $absolute_path . '/' . $file;
                require_once($path);

            }
        }
    }
}

function get_post_type_slug_url()
{
    $post_type = get_post_type();
    $home_url = get_site_url();
    if ($post_type) {
        $post_type_data = get_post_type_object($post_type);
        $post_type_slug = $post_type_data->rewrite['slug'];
        $url = "$home_url/$post_type_slug";

        return $url;
    }

    return null;
}

function get_value_from_categories($taxonomy, $return): array
{
    $cats = get_terms($taxonomy, array(
        'orderby' => 'name',
        'order' => 'ASC'
    ));

    $category_array = array();
    foreach ($cats as $cat => $value) {
        array_push($category_array, $value->{$return});
    }

    return $category_array;
}

function vc_find_style_in_custom_class($custom_css)
{
    if ($custom_css) {
        preg_match_all('/{(.*)}/x', $custom_css, $matches, PREG_SET_ORDER, 0);
        $el_style = $matches[0][1];
        $el_style = str_replace(' !important', '', $el_style);
        $el_style = str_replace(';', '; ', $el_style);

        return $el_style;
    }


    return $custom_css;
}