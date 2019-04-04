<?php

class CreateCustomPostType
{

    public function __construct()
    {
        add_action('init', array($this, 'init'));

        //add_filter('template_include', array($this, 'includeTemplateTaxonomyPortfolio'));
    }

    public function init()
    {
        register_post_type('oferta', $this->offertArgs());
        register_post_type('portfolio', $this->projectsArgs());
        register_post_type('referencje', $this->referenceArgs());
        register_post_type('partnerzy', $this->partnersArgs());

        remove_post_type_support('partnerzy', 'editor');
        remove_post_type_support('portfolio', 'editor');

        //register_taxonomy('months', 'eve', $this->taxonomyEvent());
    }

    /*
     *  ==========================
     *   Register post args
     *  ==========================
     */

    public function offertArgs()
    {

        $post_slug = __('oferta', 'coders');

        $args = array(
            'labels' => array(
                'name' => __('Oferta', 'coders'),
                'singular_name' => __('Oferta', 'coders'),
            ),
            'public' => true,
            'has_archive' => false,
            'show_in_menu' => true,
            'rewrite' => array('slug' => $post_slug),
            'menu_position' => 4,
            'menu_icon' => 'dashicons-portfolio',
        );

        return $args;
    }

    public function projectsArgs()
    {
        $post_slug = __('portfolio', 'vine');

        $args = array(
            'labels' => array(
                'name' => __('Portfolio', 'vine'),
                'singular_name' => __('Portfolio', 'vine'),
                'edit_item' => __('Edytuj portfolio', 'vine'),
            ),
            'public' => true,
            'has_archive' => false,
            'show_in_menu' => true,
            'rewrite' => array(
                'slug' => $post_slug,
                'hierarchical' => true
            ),
            'menu_position' => 4,
            'menu_icon' => 'dashicons-list-view',
        );

        return $args;

    }

    public function referenceArgs()
    {
        $post_slug = __('referencje', 'vine');

        $args = array(
            'labels' => array(
                'name' => __('Referencje', 'vine'),
                'singular_name' => __('Referencje', 'vine'),
            ),
            'public' => true,
            'has_archive' => false,
            'show_in_menu' => true,
            'rewrite' => array('slug' => $post_slug),
            'menu_position' => 4,
            'menu_icon' => 'dashicons-heart',
        );

        return $args;
    }

    public function partnersArgs()
    {
        $post_slug = __('partnerzy', 'vine');

        $args = array(
            'labels' => array(
                'name' => __('Partnerzy', 'vine'),
                'singular_name' => __('Partnerzy', 'vine'),
            ),
            'public' => true,
            'has_archive' => false,
            'show_in_menu' => true,
            'rewrite' => array('slug' => $post_slug),
            'menu_position' => 4,
            'menu_icon' => 'dashicons-groups',
        );

        return $args;
    }

    /*
     *  ==========================
     *   Taxonomy
     *  ==========================
     */

    public function taxonomyEvent()
    {
        $category_slug = __('months', 'vine');
        // create a new taxonomy
        $args = array(
            'label' => __('Months', 'vine'),
            'rewrite' => array(
                'slug' => $category_slug
            ),
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'hierarchical' => true,
            'public' => true,
        );

        return $args;

    }


    /*
     *  ==========================
     *   Additional functions
     *  ==========================
     */

}

new CreateCustomPostType();