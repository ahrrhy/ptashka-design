<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ptashka.design
 */

if ( !is_active_sidebar( 'sidebar-shop-page-categories' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area shop-categories-sidebar col-12 col-md-3">
    <div class="row">
        <?php dynamic_sidebar( 'sidebar-shop-page-categories' ); ?>
    </div>
</aside><!-- #secondary -->
