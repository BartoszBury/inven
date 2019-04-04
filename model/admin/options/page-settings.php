<?php
$available_templates = array(
    'index.php' => 'Default Template',
    'full-width.php' => 'Full width',
    'canvas.php' => 'Canvas',
);
$default_templates = 'index.php';


// -> START Settings Pages
Redux::setSection($opt_name, array(
    'title' => __('Page', 'vine'),
    'id' => 'custom-post-settings',
    'desc' => __('', 'vine'),
    'icon' => 'el el-book'
));

// Portfolio Custom post type
Redux::setSection($opt_name, array(
    'title' => __('Portfolio', 'vine'),
    'id' => 'portfolio',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'portfolio-template',
            'type' => 'select',
            'title' => __('Template', 'vine'),
            'description' => __('Choose template for portfolio'),
            'options' => $available_templates,
            'default' => $default_templates,
        ),
    )
));

// Services Custom post type
Redux::setSection($opt_name, array(
    'title' => __('Services', 'vine'),
    'id' => 'services',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'services-template',
            'type' => 'select',
            'title' => __('Template', 'vine'),
            'description' => __('Choose template for services'),
            'options' => $available_templates,
            'default' => $default_templates,
        ),
    )
));