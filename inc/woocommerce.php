<?php

/*** HIDE SHOP PAGE TITLE ***/
add_filter( 'woocommerce_show_page_title' , 'woo_hide_page_title' );
function woo_hide_page_title() {
    return false;
}

/*** HIDE PRODUCTS COUNT ON SHOP PAGE ***/
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

/*** DONT REMEMBER ***/
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

/*** HIDE SELECT OPTIONS BUTTON FROM SHOP PAGE FOR VARIABLE PRODUCTS ***/
add_filter( 'woocommerce_loop_add_to_cart_link', function( $product ) {
    global $product;
    if ( is_shop() && 'variable' === $product->product_type ) {
        return '';
    } else {
        sprintf( '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            esc_html( $product->add_to_cart_text() )
        );
    }
} );

/*** REPLACE FIRST OPTION VALUE FOR FILTER SELECT OPTIONS ***/
add_filter( 'woocommerce_layered_nav_any_label', 'edit_filter_label', 10, 3 );
function edit_filter_label( $sprintf, $taxonomy_label, $taxonomy ){
    $sprintf = sprintf( __( 'выбрать', 'ptashka-design' ), $taxonomy_label);

    return $sprintf;
}

/*** ADD SHOP PAGE SIDEBAR TO SHOP PAGE WITH FILTERS***/
add_action( 'woocommerce_before_shop_loop', 'add_shop_page_sidebar', 15 );

function add_shop_page_sidebar() {
    get_sidebar('shop-page');
    get_sidebar('shop-page-categories');
}

/*** ADD SECOND THUMBNAIL TO SHOP PAGE ***/
add_action( 'woocommerce_before_shop_loop_item_title', 'add_second_thumbnail', 15 );

function add_second_thumbnail() {
    $image = get_field('second_thumbnail');
    if( $image ) : ?>
        <img class="hover-thumbnail" src="<?php echo $image['url']; ?>" alt="<?php echo $image['caption']; ?>">
    <?php endif;
}

/**
 * Add Item Count to cart icon
 * Source: http://wordpress.org/plugins/woocommerce-menu-bar-cart/
 */

add_filter('wp_nav_menu_items','sk_wcmenucart', 10, 2);

function sk_wcmenucart($menu, $args) {
    // Проверяем, установлен ли и активирован плагин WooCommerce и добавляем новый элемент в меню, назначенному основным меню навигации

    if ( !in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option( 'active_plugins' )))
        || 'primary' !== $args->theme_location) {
        return $menu;
    }

    ob_start();
    global $woocommerce;
    $viewing_cart = __('Посмотреть корзину', 'ptashka-design');
    $start_shopping = __('Начать покупки', 'ptashka-design');
    $cart_url = $woocommerce->cart->get_cart_url();
    $shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
    $cart_contents_count = $woocommerce->cart->cart_contents_count;
    $cart_contents = sprintf(_n('%d', '%d', $cart_contents_count, 'ptashka-design'), $cart_contents_count);
    //$cart_total = $woocommerce->cart->get_cart_total();
    // Раскомментируйте строку ниже для того, чтобы скрыть иконку корзины в меню, когда нет добавленных товаров в корзине.
    // if ( $cart_contents_count > 0 ) {

    if ($cart_contents_count == 0) {

        $menu_item = '<li class="nav-item col"><a class="wcmenucart-contents" href="'. $shop_page_url .'" title="'. $start_shopping .'">';

    } else {

        $menu_item = '<li class="nav-item col"><a class="wcmenucart-contents" href="'. $cart_url .'" title="'. $viewing_cart .'">';

    }

    if ($cart_contents === '0') {
        $cart_contents = '';
    }

    $menu_item .= '<i class="fa fa-shopping-cart cart-count-icon"></i> ';
    $menu_item .= '<span class="cart-count">' . $cart_contents . '</span>'; //.' - '. $cart_total;
    $menu_item .= '</a></li>';

    // Раскомментируйте строку ниже для того, чтобы скрыть иконку корзины в меню, когда нет добавленных товаров в корзине.
    //}
    echo $menu_item;
    $social = ob_get_clean();
    return $menu . $social;
}

/*** REMOVE WOOCOMMERCE TERM DESCRIPTION ***/
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );

/**** SHOW ONLY INVITATIONS ON SHOP PAGE ****/
add_action( 'pre_get_posts', 'custom_pre_get_posts_query' );

function custom_pre_get_posts_query( $q ) {
    if ( ! $q->is_main_query() ) return;
    if ( ! $q->is_post_type_archive() ) return;
    if ( ! is_admin() && is_shop() ) {

        $q->set( 'tax_query', array(array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => array( 'invatoins_templates' ), // change 'black' with your cat slug
            'operator' => 'IN'
        )));
    }
    remove_action( 'pre_get_posts', 'custom_pre_get_posts_query' );
}

/**** ADD OPENING TAGS FOR CONTAINER AND ROW ****/
add_action( 'woocommerce_before_shop_loop', 'add_container_row_opening_tags', 5 );

function add_container_row_opening_tags() {
    echo '<div class="container"><div class="row">';
}

/**** ADD CLOSING TAGS FOR CONTAINER AND ROW ****/
add_action( 'woocommerce_after_shop_loop', 'add_container_row_closing_tags', 50 );

function add_container_row_closing_tags() {
    echo '</div></div>';
}
