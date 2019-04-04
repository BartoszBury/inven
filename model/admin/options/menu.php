<?php

// Menu
Redux::setSection($opt_name, array(
    'title' => __('Menu', 'vine'),
    'id' => 'menu',
    'icon' => 'el el-lines',
));

// Settings
Redux::setSection($opt_name, array(
    'title' => __('Settings', 'vine'),
    'id' => 'menu_settings',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'desktop-menu-style',
            'type' => 'select',
            'title' => __('Desktop menu', 'vine'),
            'subtitle' => __('Change menu on desktop', 'vine'),
            'description' => __('Choose menu style '),
            'options' => array(
                '1' => 'Menu 1',
                '2' => 'Menu 2',
            ),
            'default' => '1'
        ),
        array(
            'id' => 'mobile-menu-style',
            'type' => 'select',
            'title' => __('Mobile menu', 'vine'),
            'subtitle' => __('Change menu on mobile', 'vine'),
            'description' => __('Choose menu style '),
            'options' => array(
                '1' => 'Menu 1',
                '2' => 'Menu 2',
            ),
            'default' => '1',
        ),
    )
));

// Design
Redux::setSection($opt_name, array(
    'title' => __('Design', 'vine'),
    'id' => 'menu_design',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'nav',
            'title' => __('Nav background', 'redux-framework-demo'),
            'type' => 'color_rgba',
            'description' => __('Choose .nav background color'),
            'default' => array(
                'color' => '#000',
                'alpha' => '1'
            ),
            //'required' => array('desktop-menu-style', '=', '2'),
        ),
        array(
            'id' => 'menu__item',
            'title' => __('Menu item', 'redux-framework-demo'),
            'type' => 'link_color',
            'description' => __('Choose .menu__item background color'),
            'active' => false,
            'regular' => false,
            'default' => array(
                'hover' => '#bbb',
            ),
            //'required' => array('desktop-menu-style', '=', '2'),
        ),
    )
));




