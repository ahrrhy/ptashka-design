<?php
/**
 * ptashka.design functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ptashka.design
 */

if ( ! function_exists( 'ptashka_design_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ptashka_design_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ptashka.design, use a find and replace
		 * to change 'ptashka-design' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ptashka-design', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'ptashka-design' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ptashka_design_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// woocommerce
        add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
        add_theme_support( 'wc-product-gallery-zoom' );
	}
endif;
add_action( 'after_setup_theme', 'ptashka_design_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ptashka_design_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ptashka_design_content_width', 640 );
}
add_action( 'after_setup_theme', 'ptashka_design_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ptashka_design_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ptashka-design' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ptashka-design' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	/**** SHOP FILTERS SIDEBAR ****/
    register_sidebar( array(
        'name'          => esc_html__( 'Shop Page', 'ptashka-design' ),
        'id'            => 'sidebar-shop-page',
        'description'   => esc_html__( 'Сюда нужно доюавлять фильтр продуктов. 4 штуки', 'ptashka-design' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s col-12 col-md-3">',
        'after_widget'  => '</div>',
        'before_title'  => '<p class="shop-page-widget-title">',
        'after_title'   => '</p>',
    ) );

    /**** CATEGORIES SIDEBAR ****/
    register_sidebar( array(
        'name'          => esc_html__( 'Shop Page Category List', 'ptashka-design' ),
        'id'            => 'sidebar-shop-page-categories',
        'description'   => esc_html__( 'Сюда нужно добавить виджет категории', 'ptashka-design' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s col-12">',
        'after_widget'  => '</div>',
        'before_title'  => '<p class="shop-page-widget-title">',
        'after_title'   => '</p>',
    ) );
}
add_action( 'widgets_init', 'ptashka_design_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ptashka_design_scripts() {
	wp_enqueue_style(
	    'ptashka-design-style',
        get_stylesheet_uri()
    );

	wp_enqueue_script(
	    'ptashka-design-skip-link-focus-fix',
        get_template_directory_uri() . '/js/skip-link-focus-fix.js',
        [],
        '20151215',
        true
    );

// my scripts

    /*** BOOTSTRAP SCRIPTS AND STYLES ***/
    wp_enqueue_script(
        'jq-js',
        get_template_directory_uri().'/libs/jquery/dist/jquery.min.js'
    );

    wp_enqueue_style(
        'tether-css',
        get_template_directory_uri().'/libs/tether/dist/css/tether.min.css'
    );
    wp_enqueue_style(
        'tether-theme-arrows',
        get_template_directory_uri().'/libs/tether/dist/css/tether-theme-arrows.min.css'
    );
    wp_enqueue_style(
        'tether-theme-arrows-dark',
        get_template_directory_uri().'/libs/tether/dist/css/tether-theme-arrows-dark.min.css'
    );
    wp_enqueue_style(
        'tether-theme-basic',
        get_template_directory_uri().'/libs/tether/dist/css/tether-theme-basic.min.css'
    );
    wp_enqueue_script(
        'tether-js',
        get_template_directory_uri().'/libs/tether/dist/js/tether.min.js'
    );

    wp_enqueue_script(
        'bootstrap-js',
        get_template_directory_uri().'/libs/bootstrap/dist/js/bootstrap.min.js'
    );
    wp_enqueue_style(
        'bootstrap-css',
        get_template_directory_uri().'/libs/bootstrap/dist/css/bootstrap.min.css'
    );
    wp_enqueue_style(
        'bootstrap-grid-css',
        get_template_directory_uri().'/libs/bootstrap/dist/css/bootstrap-grid.min.css'
    );
    wp_enqueue_style(
        'bootstrap-reboot-css',
        get_template_directory_uri().'/libs/bootstrap/dist/css/bootstrap-reboot.min.css')
    ;

    /*** MY STYLE.CSS SCRIPTS AND STYLES ***/
    wp_enqueue_style(
        'my-style',
        get_template_directory_uri().'/stylesheets/style.css'
    );
    wp_enqueue_script(
        'main',
        get_template_directory_uri().'/js/main.js'
    );

    /*** FOOTER FORM SCRIPTS ***/
    wp_register_script(
        'footer-form',
        get_template_directory_uri().'/js/footer-form.js',
        [],
        false,
        true
    );
    wp_enqueue_script(
        'footer-form'
    );

    /*** FILTER SIDEBAR SCRIPTS ***/
    wp_register_script(
        'filter-sidebar',
        get_template_directory_uri().'/js/filter-sidebar.js',
        [],
        false,
        true
    );
    wp_enqueue_script(
        'filter-sidebar'
    );

    /*** HEADER MENU SCRIPTS ***/
    wp_register_script(
        'header-menu',
        get_template_directory_uri().'/js/header-menu.js',
        [],
        false,
        true
    );
    wp_enqueue_script(
        'header-menu'
    );

    /*** PRODUCT PAGE SCRIPTS ***/
    wp_register_script(
        'product-page',
        get_template_directory_uri().'/js/product-page.js',
        ['jquery'],
        false,
        true
    );
    wp_enqueue_script(
        'product-page'
    );

    /*** SHOP PAGE SCRIPTS ***/
    wp_register_script(
        'shop-page',
        get_template_directory_uri().'/js/shop-page.js',
        [],
        false,
        true
    );
    wp_enqueue_script(
        'shop-page'
    );


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ptashka_design_scripts' );


// Disable jQuery WordPress
function jquery_another_version() {
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_stylesheet_directory_uri() .'/libs/jquery/dist/jquery.min.js', array(), '');
}
add_action( 'wp_enqueue_scripts', 'jquery_another_version' );

/**
 *  Adding font awesome
 */
function font_awesome() {
    if (!is_admin()) {
        wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css');
        wp_enqueue_style('font-awesome');
    }
}
add_action('wp_enqueue_scripts', 'font_awesome');
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

/**
 * Load Nav-Walker
 */
require_once('wp-bootstrap-navwalker.php');

/**
 * Customizer additions.
 */
require get_template_directory() . '/posttypes/custom-post-types.php';

//***disable contact-form styles *****///
add_filter( 'wpcf7_load_css', '__return_false' );

/*** WOOCOMMERCE  TEMPLATES VISUAL HOOKS ***/
require get_template_directory() . '/inc/woocommerce.php';

require get_template_directory() . '/inc/single-product-customization.php';

function mytheme_enqueue_scripts() {

    wp_enqueue_style ( 'mode-theme-bootstrap', get_template_directory_uri() . '/stylesheets/magnific-popup.css' );
    wp_enqueue_script ( 'magnific', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array ( 'jquery' ), '1.0.0', true );

}

/*** MAGNIFIC POPUP ***/
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_scripts' );
function mytheme_footer_js() { ?>
    <script>
        jQuery(document).ready(function($){
            // Instantiate Magnific Lightbox
            $('.gallery-item a').magnificPopup({
                type:'image',
                image: {
                    verticalFit: true
                },
                gallery: {
                    enabled: true
                }
            });
        });
    </script>
<?php }
add_action ( 'wp_footer', 'mytheme_footer_js' );
