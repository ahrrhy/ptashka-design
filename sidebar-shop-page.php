<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ptashka.design
 */

if ( !is_active_sidebar( 'sidebar-shop-page' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area shop-sidebar col-12">
    <div class="row justify-content-center">
        <?php dynamic_sidebar( 'sidebar-shop-page' ); ?>
    </div>
</aside><!-- #secondary -->
