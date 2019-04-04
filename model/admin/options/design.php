<?php

// -> START Color Selection
Redux::setSection($opt_name, array(
    'title' => __('Colors', 'vine'),
    'id' => 'color',
    'desc' => __('', 'vine'),
    'icon' => 'el el-brush'
));

// Button
Redux::setSection($opt_name, array(
    'title' => __('Button', 'vine'),
    'id' => 'button',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'button-background',
            'type' => 'link_color',
            'title' => __('Button background color', 'vine'),
            'active' => false,
            'default' => array(
                'regular' => '#000',
                'hover' => '#aaa',
            )
        ),
        array(
            'id' => 'button-color',
            'type' => 'link_color',
            'title' => __('Button text color', 'vine'),
            'active' => false,
            'default' => array(
                'regular' => '#000',
                'hover' => '#aaa',
            )
        ),
    )
));

