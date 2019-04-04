<?php

class TwigContext extends Timber\Site
{


    function __construct()
    {
        parent::__construct();
        add_filter('timber/context', array($this, 'add_to_context'));
    }

    public function add_to_context($context)
    {
        define('ASSETS', get_template_directory_uri() . '/assets');
        global $redux;

        $logo = array(
            'header' => isset($redux['header_logo']),
        );

        $global = array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'icon' => array(
                'google_map' => ASSETS . '/icon/fn/ico_place.png',
                'website' => ASSETS . '/icon/fn/ico_web.svg',
                'telephone' => ASSETS . '/icon/fn/ico_phone.svg',
                'fn' => array(
                    'logo_fto' => ASSETS . '/icon/fn/logo_fto.svg',
                    'logo_atm' => ASSETS . '/icon/fn/logo_atm.svg',
                    'logo_fp' => ASSETS . '/icon/fn/logo_fp.svg',
                ),
                'social' => array(
                    'logo_facebook' => ASSETS . '/icon/social/logo_fb.svg',
                    'logo_instagram' => ASSETS . '/icon/social/logo_instagram.svg',
                    'logo_dvisor' => ASSETS . '/icon/social/logo_dvisor.svg',
                ),
                'general' => array(
                    'at' => ASSETS . '/icon/general/at.svg',
                    'calendar' => ASSETS . '/icon/general/calendar.svg',
                    'cart' => ASSETS . '/icon/general/cart.svg',
                    'clock' => ASSETS . '/icon/general/clock.svg',
                    'clock_brown' => ASSETS . '/icon/general/clock_brown.png',
                    'down_arrow' => ASSETS . '/icon/general/down-arrow.svg',
                    'up_arrow' => ASSETS . '/icon/general/up-arrow.svg',
                    'minus' => ASSETS . '/icon/general/minus.svg',
                    'news' => ASSETS . '/icon/general/news.svg',
                    'place' => ASSETS . '/icon/general/place.svg',
                    'phone_brown' => ASSETS . '/icon/general/phone_brown.png',
                    'plus' => ASSETS . '/icon/general/plus.svg',
                    'tickets' => ASSETS . '/icon/general/tickets.svg',
                ),
            ),
        );

        $menu = array(
            'content' => new Timber\Menu('primary'),
        );

        if (!is_front_page()) {
            $context['breadcrumbs'] = $this->the_breadcrumbs();
        }

        $context['logo'] = $logo;
        $context['menu'] = $menu;

        $context['global'] = $global;

        $context['switcher_lang'] = do_shortcode('[wpml_language_selector_widget]');

        return $context;
    }

    public function the_breadcrumbs(): string
    {
        $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
        $whitelist = array(
            '127.0.0.1',
            '::1'
        );

        $output = '';

        $local_domain = '';
        $separator = '<span><i class="fa fa-angle-double-right"></i></span>';
        $main_path = '';
        $title = '';
        $post_types = get_post_types();

        if (!in_array($_SERVER['REMOTE_ADDR'], $whitelist)) {
            $local_domain = $separator;
        }

        $site = get_site_url();
        $output = '<a class=\'breadcrumbs__item\' href=' . $site . '>' . __('Home', 'vine') . '</a> ' . $local_domain . ' ';

        foreach ($path as $key => $url) {
            $slug = str_replace(Array('.php', '_', '-'), Array('', ' ', ' '), $url);
            $main_path .= $url . '/';

            if ($key < count($path)) {
                foreach ($post_types as $post_type) {
                    $args = array(
                        'name' => $slug,
                        'post_type' => $post_type,
                        'post_status' => 'publish',
                    );
                    $get_post = get_posts($args);
                    if ($get_post) {
                        $title = $get_post[0]->post_title;
                    }
                }
                $output .= "<a href=\"/$main_path\" class='breadcrumbs__item'>$title</a> $separator ";
            }


            if ($key === count($path)) {
                foreach ($post_types as $post_type) {
                    $args = array(
                        'name' => $slug,
                        'post_type' => $post_type,
                        'post_status' => 'publish',
                    );
                    $get_post = get_posts($args);
                    if ($get_post) {
                        $title = $get_post[0]->post_title;
                    }
                }
                $output .= "<a href=\"/$main_path\" class='breadcrumbs__item breadcrumbs__active-page'>$title</a>";
            }
        }

        return $output;
    }
}

new TwigContext();