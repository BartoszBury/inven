<?php

class UseConfig
{

    function __construct()
    {
        add_filter('template_include', array($this, 'setCustomPostTemplate'));
    }

    function setCustomPostTemplate($template)
    {
        global $redux;

        switch (get_post_type()) {
            case "vine-services":
                $template = get_template_directory() . '/controllers/' . $redux['services-template'];
                break;
            case "vine-portfolio":
                $template = get_template_directory() . '/controllers/' . $redux['portfolio-template'];
                break;
        }

        return $template;

    }

}

new UseConfig();

