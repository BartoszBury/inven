<?php
/**
 * Template Name: Lunch
 */
$context = Timber::get_context();

$args = array(
    'post_type' => 'lunch',
);
$context['lunch'] = Timber::get_posts($args);
$context['post'] = new Timber\Post();
$templates = array('pages/lunch.twig');
Timber::render($templates, $context);