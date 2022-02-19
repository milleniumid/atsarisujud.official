<?php
return array(
    // Product
    'product' => array(
        'name'        => 'Atsari Sujud',
        'description' => 'Atsa',
        'preview'     => '#',
        'home'        => '#',
        'purchase'    => '#',
        'licenses'    => array(
            'terms' => '#',
            'types' => array(),
        ),
        'demos'       => array(),
    ),

    // Meta
    'meta'    => array(
        'title'       => env('APP_NAME'),
        'description' => '#',
        'keywords'    => '#',
        'canonical'   => '#',
    ),

    // General
    'general' => array(
        'website'             => 'https://keenthemes.com',
        'about'               => '#',
        'contact'             => 'mailto:#',
        'support'             => '#',
        'bootstrap-docs-link' => 'https://getbootstrap.com/docs/5.0',
        'licenses'            => '#',
        'social-accounts'     => array(
            // array(
            //     'name' => 'Youtube', 'url' => 'https://www.youtube.com/c/KeenThemesTuts/videos', 'logo' => 'svg/social-logos/youtube.svg', "class" => "h-20px",
            // ),
            // array(
            //     'name' => 'Github', 'url' => 'https://github.com/KeenthemesHub', 'logo' => 'svg/social-logos/github.svg', "class" => "h-20px",
            // ),
            // array(
            //     'name' => 'Twitter', 'url' => 'https://twitter.com/keenthemes', 'logo' => 'svg/social-logos/twitter.svg', "class" => "h-20px",
            // ),
            // array(
            //     'name' => 'Instagram', 'url' => 'https://www.instagram.com/keenthemes', 'logo' => 'svg/social-logos/instagram.svg', "class" => "h-20px",
            // ),

            // array(
            //     'name' => 'Facebook', 'url' => 'https://www.facebook.com/keenthemes', 'logo' => 'svg/social-logos/facebook.svg', "class" => "h-20px",
            // ),
            // array(
            //     'name' => 'Dribbble', 'url' => 'https://dribbble.com/keenthemes', 'logo' => 'svg/social-logos/dribbble.svg', "class" => "h-20px",
            // ),
        ),
    ),

    // Layout
    'layout'  => array(
        // Docs
        'docs'          => array(
            'logo-path'  => array(
                'default' => 'logos/logo-1.svg',
                'dark'    => 'logos/logo-1-dark.svg',
            ),
            'logo-class' => 'h-25px',
        ),

        // Illustration
        'illustrations' => array(
            'set' => 'sketchy-1',
        ),

        // Engage
        'engage'        => array(
            'demos'    => array(
                'enabled'   => false,
                'direction' => 'end',
            ),
            'explore'  => array(
                'enabled'   => false,
                'direction' => 'end',
            ),
            'help'     => array(
                'enabled'   => false,
                'direction' => 'end',
            ),
            'purchase' => array(
                'enabled' => false,
            ),
        ),
    ),

);
