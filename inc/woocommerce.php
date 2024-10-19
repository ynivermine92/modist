<?php

//проверка на плагин установлин или нет
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    //woocommerce support
    function modis_add_woocommerce_support()
    {
        add_theme_support('woocommerce');
    }
    add_action('after_setup_theme', 'modis_add_woocommerce_support');
}

//удалить хлебные крошки 

remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );


// Персонализируем ХЛебные Крошки 
function custom_breadcrumbs( $defaults ) {
    $defaults['delimiter'] = ' '; // Разделитель
    $defaults['home'] = 'Home'; // Название главной страницы
    return $defaults;
}

add_filter('woocommerce_breadcrumb_defaults', 'custom_breadcrumbs');
