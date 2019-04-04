<?php
/**
 * Template Name: Event
 */
$context = Timber::get_context();

$args = array(
    'post_type' => 'event',
);
$context['event'] = Timber::get_posts($args);
$context['post'] = new Timber\Post();
$templates = array('pages/event.twig');
Timber::render($templates, $context);