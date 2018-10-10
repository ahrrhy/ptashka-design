<?php
/**** ADD TEXT FIELD TO ORDER ****/
/**
 * Output engraving field.
 */
function output_name_text_field() {
    global $product;

    $product_category = $product->get_category_ids();
    if ( 18 !== $product_category[0] ) {
        return;
    }

    ?>
    <div class="invitations-name-text">
        <label for="invitations-name-text">
            <?php _e( 'Вписать текст и имена гостей', 'ptashka-design' ); ?>
        </label>
        <textarea type="text" id="invitations-name-text" name="invitations-name-text"></textarea>
    </div>
    <?php
}
add_action( 'woocommerce_before_add_to_cart_button', 'output_name_text_field', 15 );

/**
 * Add engraving text to cart item.
 *
 * @param array $cart_item_data
 * @param int   $product_id
 * @param int   $variation_id
 *
 * @return array
 */
function add_invitation_text_to_cart_item( $cart_item_data, $product_id, $variation_id ) {
    $invitation_text = filter_input( INPUT_POST, 'invitations-name-text' );

    if ( empty( $invitation_text ) ) {
        return $cart_item_data;
    }

    $cart_item_data['invitations-name-text'] = $invitation_text;

    return $cart_item_data;
}
add_filter( 'woocommerce_add_cart_item_data', 'add_invitation_text_to_cart_item', 10, 3 );

/**
 * Display engraving text in the cart.
 *
 * @param array $item_data
 * @param array $cart_item
 *
 * @return array
 */
function iconic_display_engraving_text_cart( $item_data, $cart_item ) {
    if ( empty( $cart_item['invitations-name-text'] ) ) {
        return $item_data;
    }

    $item_data[] = [
        'key'     => __( 'Текст и имена пригласительных', 'ptashka-design' ),
        'value'   => wc_clean( $cart_item['invitations-name-text'] ),
        'display' => '',
    ];

    return $item_data;
}
add_filter( 'woocommerce_get_item_data', 'iconic_display_engraving_text_cart', 10, 2 );

/**
 * Add engraving text to order.
 *
 * @param WC_Order_Item_Product $item
 * @param string                $cart_item_key
 * @param array                 $values
 * @param WC_Order              $order
 */
function iconic_add_engraving_text_to_order_items( $item, $cart_item_key, $values, $order ) {
    if ( empty( $values['invitations-name-text'] ) ) {
        return;
    }

    $item->add_meta_data( __( 'Текст и имена пригласительных', 'ptashka-design' ), $values['invitations-name-text'] );
}
add_action( 'woocommerce_checkout_create_order_line_item', 'iconic_add_engraving_text_to_order_items', 10, 4 );

/**** ADD CROSS SELLS PRODUCT TO PRODUCT ****/
add_action('woocommerce_after_single_product', 'showProduct', 20);
function showProduct() {
    global $product;

    $cross_sells_products = new WP_Query(['post_type' => 'product', 'include' => $product->get_cross_sell_ids()]);

    if ($cross_sells_products->have_posts()) : ?>
        <div class="custom-cross-sells-section container-fluid">
            <div class="container">
                <ul class="cross-sells-product-list reset-list row">
                    <?php while ($cross_sells_products->have_posts()) :
                        $cross_sells_products->the_post();
                        global $post;
                        ?>
                        <li class="col-3">
                            <div class="product-box">
                                <p class="product-name"><?php the_title()?></p>
                                <?php
                                $attr = ['class' => 'img-fluid'];
                                the_post_thumbnail( [200,200], $attr );
                                ?>
                                <p class="cross-sell-price">
                                    <span class="cost">
                                        <?php echo get_post_meta( get_the_ID(), '_regular_price', true); ?>
                                    </span>
                                    <span class="per-item"> <?php _e('грн') ?>/<?php _e('шт') ?></span>
                                </p>
                            </div>
                        </li>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </ul>
            </div>

        </div>
    <?php endif;
}

/*** REMOVE PRICE FROM TOP ***/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );


/*** ADD CLOTHING_ELEMENT ATTRIBUTE ***/
add_action( 'woocommerce_before_add_to_cart_button', 'product_attribute_closing_element', 5 );
function product_attribute_closing_element() {
    global $product;

    $taxonomy = 'pa_closing_element';
    $value = $product->get_attribute( $taxonomy );

    if ( $value ) {
        $label = get_taxonomy( $taxonomy )->labels->singular_name;
        echo '<p class="closing-element">' . $value . '</p>';
    }
}

add_action('woocommerce_before_add_to_cart_button', 'add_text_under_cart_btn', 30);
function add_text_under_cart_btn() {
    echo '<p class="under-cart-btn">Минимальный заказ 10шт</p>';
}

/*** REMOVE PRODUCT META FROM PRODUCT PAGE ***/
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

/*** REMOVE TABS FROM PRODUCT PAGE ***/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

/*** STOP ADDING PRODUCTS ON PRODUCT PAGE REFRESH ***/
add_action('add_to_cart_redirect', 'resolve_dupes_add_to_cart_redirect');

function resolve_dupes_add_to_cart_redirect($url = false) {

    // If another plugin beats us to the punch, let them have their way with the URL
    if(!empty($url)) { return $url; }

    // Redirect back to the original page, without the 'add-to-cart' parameter.
    // We add the `get_bloginfo` part so it saves a redirect on https:// sites.
    return get_bloginfo('wpurl').add_query_arg(array(), remove_query_arg('add-to-cart'));
}

/*** SHOW MINIMAL PRICE ***/
add_filter('woocommerce_variable_price_html', 'custom_variation_price', 10, 2);

function custom_variation_price( $price, $product ) {
    $price = '';
    $price .= wc_price($product->get_price());
    return $price;
}

/*** REPLACE FIRST OPTION VALUE FOR ATTRIBUTES SELECT OPTIONS ***/
add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'attributes_select_filter' );
function attributes_select_filter( $args ) {
    $args['show_option_none'] = __( 'выбрать', 'ptashka-design' );
    return $args;
}

/*** CHANGE START PRODUCTS QUANTITY ***/
// Simple products
add_filter( 'woocommerce_quantity_input_args', 'pd_woocommerce_quantity_input_args', 10, 2 );
function pd_woocommerce_quantity_input_args( $args, $product ) {
    //$args['input_value'] = 10; // Starting value
    $args['max_value'] = 200; // Maximum value
    $args['min_value'] = 10; // Minimum value
    $args['step'] = 1; // Quantity steps
    return $args;
}

// Variations
add_filter( 'woocommerce_available_variation', 'pd_woocommerce_available_variation' );
function pd_woocommerce_available_variation( $args ) {
    $args['max_qty'] = 200; // Maximum value (variations)
    $args['min_qty'] = 10; // Minimum value (variations)
    return $args;
}

/*** REMOVE RELATED PRODUCTS FROM PRODUCT PAGE ***/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
