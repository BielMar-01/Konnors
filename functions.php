<?php

  // Funções para Limpar o Header
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'start_post_rel_link', 10, 0 );
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');


  //Habilitar menu
    add_theme_support('menus'); 

    function nav_register(){
        register_nav_menus(
            'primary_menu' =>  'Primary Menu' 
        ) ;
    }
    add_action('after_setup_theme', 'nav_register');

    //Opções Globais

    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page(array(
            'page_title'     => 'Opções Globais',
            'menu_title'    => 'Opções Globais',
            'menu_slug'     => 'opcoes-globais',
            'capability'    => 'edit_posts',
            'position'      =>  2,
            'icon_url'      => 'dashicons-admin-settings'
        ));
        acf_add_options_sub_page(array(
            'page_title'     => 'Editar - Header',
            'menu_title'    => 'Editar - Header',
            'parent_slug'    => 'opcoes-globais',
        ));
        acf_add_options_sub_page(array(
            'page_title'     => 'Editar - Footer',
            'menu_title'    => 'Editar - Footer',
            'parent_slug'    => 'opcoes-globais',
        ));
        acf_add_options_sub_page(array(
            'page_title'     => 'Editar - Banner Fale com RI',
            'menu_title'    => 'Editar - Banner Fale com RI',
            'parent_slug'    => 'opcoes-globais',
        ));
    }