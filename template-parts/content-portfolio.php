<?php
/**
 * Template part for displaying page content in page-portfolio.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ptashka.design
 */
?>

<section id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!--	<header class="entry-header">-->
    <!--		--><?php //the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    <!--	</header> -->

    <div class="entry-content row">
        <div class="container">
            <ul class="row portfolio-list">
                <?php
                $portfolio_args = [
                    'numberposts' => 6,
                    'category'    => 0,
                    'orderby'     => 'date',
                    'order'       => 'ASC',
                    'meta_key'    => 'show_work_on_front',
                    'meta_value'  => true,
                    'post_type'   => 'portfolio_work',
                    'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
                ];

                $portfolio_posts = get_posts( $portfolio_args );
                foreach($portfolio_posts as $post){
                    setup_postdata($post);
                    ?>
                    <li class="col-6 col-md-4 portfolio-item">
                        <div class="hover-box">
                            <a href="<?php the_permalink(); ?>">
                                <?php $attr = ['class' => 'img-fluid'];
                                the_post_thumbnail( 'full', $attr );
                                ?>
                                <div class="portfolio-hover">
                                    <h4 class="portfolio-title"><?php the_title(); ?></h4>
                                </div>
                            </a>

                        </div>
                    </li>
                    <?php
                }
                wp_reset_postdata();
                ?>
            </ul>
        </div>
    </div><!-- .entry-content -->

    <?php if ( get_edit_post_link() ) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                        __( 'Edit <span class="screen-reader-text">%s</span>', 'ptashka-design' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                ),
                '<span class="edit-link">',
                '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</section><!-- #post-<?php the_ID(); ?> -->

