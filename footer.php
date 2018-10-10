<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ptashka.design
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer container-fluid">
		<div class="site-info row justify-content-center">
            <p class="text-center"><?php echo get_theme_mod('information_footer'); ?></p>
		</div><!-- .site-info -->
        <div class="form-wrap hidden" id="form-wrap">
            <?php echo do_shortcode('[contact-form-7 id="46" title="Контактная форма 1333"]'); ?>
        </div>
        <div class="row justify-content-center">
            <button id="call-form" class="col-xs-12 col-md-4 blue-btn">
                <?php echo get_theme_mod('button_callback_footer'); ?>
            </button>
        </div>
        <ul class="row justify-content-center socials-list reset-list">
            <li class="social-item col-1">
                <a href="<?php echo get_theme_mod('insta_link'); ?>"
                   class="social-link-insta hover-scale"
                   target="_blank">
                </a>
            </li>
            <li class="social-item col-1">
                <a href="<?php echo get_theme_mod('facebook_link'); ?>"
                   class="social-link-fb hover-scale"
                   target="_blank">
                </a>
            </li>
        </ul>
        <ul class="contacts-list reset-list text-center">
            <li class="contact-item">
                <a href="tel:<?php echo get_theme_mod('contact_phone_number'); ?>">
                    <?php echo get_theme_mod('phone_number_label'); ?>
                </a>
            </li>
            <li class="contact-item">
                <a href="mailto:<?php echo get_theme_mod('contact_email'); ?>">
                    <?php echo get_theme_mod('email_label'); ?>
                </a>
            </li>
            <li class="contact-item">
                <a href="<?php echo get_theme_mod('address'); ?>">
                    <?php echo get_theme_mod('address_label'); ?>
                </a>
            </li>
        </ul>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
