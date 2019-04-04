<?php
/**
 * Template Name: About us
 */
$context = Timber::get_context();

$context['post'] = new Timber\Post();
$templates = array('pages/about-us.twig');
Timber::render($templates, $context);