<?php

//проверка на плагин установлин или нет
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

    //woocommerce support
    function modis_add_woocommerce_support()
    {
        add_theme_support('woocommerce');
    }
    add_action('after_setup_theme', 'modis_add_woocommerce_support');


    //удалить хлебные крошки 
    remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

    // remove title 
    remove_action('woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header', 10);

    // Персонализируем ХЛебные Крошки 

    function custom_breadcrumbs()
    {
        return array(
            'delimiter'   => ' &nbsp; ',
            'wrap_before' => '<p class="breadcrumbs"><span>',
            'wrap_after'  => '</span><p/>',
            'before'      => '',
            'after'       => '',
            'home'        =>  'Home',
        );
    }

    add_filter('woocommerce_breadcrumb_defaults', 'custom_breadcrumbs');

    //отключение сайдбар
    remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

    //Product item   link remove
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);



    //Image item add  link  
    add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 5); // start link
    add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15); // end link


    /* discount price default */
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);

    /* discount price custom*/
    function custom_sale_percentage()
    {
        global $product;

        // Проверяем, есть ли скидка
        if ($product->is_on_sale()) {
            $regular_price = (float) $product->get_regular_price(); // Обычная цена
            $sale_price = (float) $product->get_sale_price(); // Скидочная цена

            // Если обычная и скидочная цена существуют, вычисляем процент
            if ($regular_price && $sale_price) {
                $percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
                echo '<span class="status">-' . $percentage . '%</span>';
            }
        }
    }
    add_action('woocommerce_before_shop_loop_item_title', 'custom_sale_percentage', 10);


    //product data
    remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);


    //добавил класс и заменил место h2 на h3  (пример  как менять классы ) 
    function my_custom_title()
    {
        echo '<h3><a class="mytest" href="' . get_the_permalink() . '">' . get_the_title() . '</a></h3>';
    }
    add_action('woocommerce_shop_loop_item_title', 'my_custom_title', 15);



    remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);


    add_action('woocommerce_before_single_product_summary', 'custom_sale_percentage', 10);


    /* popap default  woocommerce_ */
    function ale_woocommerce_plugin_setup()
    {
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-zoom');
    }

    add_action('after_setup_theme', 'ale_woocommerce_plugin_setup');
}





/* пагинация кастом добавление право лево */

function customize_woocommerce_pagination_arrows($args)
{
    // Устанавливаем символы "<" и ">" для предыдущей и следующей кнопок
    $args['prev_text'] = '&lt;'; // Стрелка "<"
    $args['next_text'] = '&gt;'; // Стрелка ">"

    return $args;
}

// Изменяем стандартные кнопки пагинации WooCommerce на стрелки
add_filter('woocommerce_pagination_args', 'customize_woocommerce_pagination_arrows');









/* карточка товара  */

//удаление хука  тайтел карточки h1
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

//дабавления хука тайтел карточки h3
function cart_title()
{
    echo '<h3>' . get_the_title() . '</h3>';
}


add_action('woocommerce_single_product_summary', 'cart_title', 5);

//удалить рейтинг
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

//убарть выбор у селекта выбор товара 

function remove_choose_option_text_completely($args) {
    $args['show_option_none'] = false;
    return $args;
}
add_filter('woocommerce_dropdown_variation_attribute_options_args', 'remove_choose_option_text_completely');








// Удаляет цены из селекта в карточке товра 
remove_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);

add_action('woocommerce_before_variations_form', 'woocommerce_single_variation', 11);


// убирать мета 
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);



// убирать нижние табы 
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);







