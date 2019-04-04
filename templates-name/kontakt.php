<?php
/**
 * Template Name: Contact
 */
$context = Timber::get_context();
$context['post'] = new Timber\Post();
$templates = array('pages/regulations.twig');
Timber::render($templates, $context);