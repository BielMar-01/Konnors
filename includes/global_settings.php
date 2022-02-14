<?php

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page(array(
		'page_title' 	=> 'Configurações Globais',
		'menu_title'	=> 'Configurações Globais',
		'menu_slug' 	=> 'configuracoes-globais',
        'capability'	=> 'edit_posts',
        'position'      =>  2,
        'icon_url'      => 'dashicons-admin-settings'
    ));
    
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Header',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'configuracoes-globais',
    ));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Footer',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'configuracoes-globais',
    ));

    acf_add_options_sub_page(array(
		'page_title' 	=> 'LGPD',
		'menu_title'	=> 'LGPD',
		'parent_slug'	=> 'configuracoes-globais',
	));
}