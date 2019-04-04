<?php

/*if (!is_admin() && !function_exists('get_field')) {

    function get_field($key)
    {
        return get_post_meta(get_the_ID(), $key, true);
    }
}
if (!is_admin() && !function_exists('the_field')) {

    function the_field($key)
    {
        return get_post_meta(get_the_ID(), $key, true);
    }
}*/

class ThemeACF
{
    function __construct()
    {
        if (function_exists('acf_add_local_field_group')):

            $this->add_menu_fields();
            $this->add_page_settings();

        endif;
    }

    private function add_menu_fields()
    {

        acf_add_local_field_group(array(
            'key' => 'group_menu',
            'Font' => 'Menu',
            'fields' => array(
                array(
                    'key' => 'field_new_blank',
                    'name' => 'new_blank',
                    'type' => 'true_false',
                    'message' => 'Open link on new blank',
                ),
                array(
                    'key' => 'field_anchor',
                    'name' => 'anchor',
                    'type' => 'text',
                    'instructions' => 'Write name section for to do anchor',
                    'placeholder' => '#contact or .contact',
                ),
                array(
                    'key' => 'field_offset',
                    'name' => 'offset',
                    'type' => 'number',
                    'instructions' => 'Set offset from top ',
                    'conditional_logic' => array(
                        array(
                            array(
                                'field' => 'field_anchor',
                                'operator' => '!=empty',
                            ),
                        ),
                    ),
                    'default' => 0
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'nav_menu_item',
                        'operator' => '==',
                        'value' => 'all',
                    ),
                ),
            ),

            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => 1,
        ));

    }

    private function add_page_settings()
    {

        acf_add_local_field_group(array(
            'key' => 'group_5c9fa4ca950ca',
            'title' => 'Page settings',
            'fields' => array(
                array(
                    'key' => 'field_5c9fa4dbfed79',
                    'label' => 'Settings',
                    'name' => 'settings',
                    'type' => 'group',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => 0,
                    'wrapper' => array(
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ),
                    'layout' => 'row',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_5c9fa501fed7a',
                            'label' => 'Image',
                            'name' => 'image',
                            'type' => 'image',
                            'instructions' => '',
                            'required' => 0,
                            'conditional_logic' => 0,
                            'wrapper' => array(
                                'width' => '',
                                'class' => '',
                                'id' => '',
                            ),
                            'return_format' => 'array',
                            'preview_size' => 'thumbnail',
                            'library' => 'all',
                            'min_width' => '',
                            'min_height' => '',
                            'min_size' => '',
                            'max_width' => '',
                            'max_height' => '',
                            'max_size' => '',
                            'mime_types' => '',
                        ),
                    ),
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'oferta',
                    ),
                ),
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'portfolio',
                    ),
                ),
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'partnerzy',
                    ),
                ),
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'page',
                    ),
                    array(
                        'param' => 'page',
                        'operator' => '!=',
                        'value' => get_option('page_on_front'),
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'active' => 1,
        ));

    }

}

new ThemeACF();