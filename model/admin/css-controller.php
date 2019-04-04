<?php

add_action('wp_head', function () {
    ob_start();
    global $redux;

    //echo "<pre>";
    //print_r($redux['menu__item']);

    $btn = array(
        'background' => $redux['button-background']['regular'],
        'color' => $redux['button-color']['regular'],
        'hover' => array(
            'background' => $redux['button-background']['hover'],
            'color' => $redux['button-color']['hover'],
        )
    );

    $font = array(
        'family' => $redux['font_body']['font-family'],
        'weight' => $redux['font_body']['font-weight'],
        'size' => $redux['font_body']['font-size'],
        'line_height' => $redux['font_body']['line-height'],
        'color' => $redux['font_body']['color'],
    );

    $nav = array(
        'background' => isset($redux['nav']['rgba']),
    );

    $menu = array(
        'hover' => array(
            'background' => $redux['menu__item']['hover'],
        ),
    );

    //echo "<pre>";
    //print_r($font);

    $context['btn'] = $btn;
    $context['font'] = $font;
    $context['nav'] = $nav;
    $context['menu'] = $menu;

    $templates = array('dynamic_css.twig');
    Timber::render($templates, $context);

    ob_end_flush();
}, 8);
