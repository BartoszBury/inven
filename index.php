<?php

$offer = array(
    'post' => Timber::get_posts(array(
        'post_type' => 'oferta',
        'posts_per_page' => -1
    )),
    'slug' => get_post_type_object('oferta')->rewrite['slug'],
);

$portfolio = array(
    'post' => Timber::get_posts(array(
        'post_type' => 'portfolio',
        'posts_per_page' => -1
    )),
);

$reference = array(
    'post' => Timber::get_posts(array(
        'post_type' => 'referencje',
        'posts_per_page' => -1
    )),
);

$partners = array(
    'post' => Timber::get_posts(array(
        'post_type' => 'partnerzy',
        'posts_per_page' => -1
    )),
);


$context = Timber::get_context();
$context['offer'] = $offer;
$context['portfolio'] = $portfolio;
$context['reference'] = $reference;
$context['partners'] = $partners;
$context['post'] = new Timber\Post();
$templates = array('index.twig');
if (is_front_page()) {
    array_unshift($templates, 'pages/front-page.twig');
}
Timber::render($templates, $context);