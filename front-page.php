<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ptashka.design
 */

get_header(); ?>

    <div id="primary" class="content-area container-fluid">
        <main id="main" class="site-main">
            <div class="carousel slide row" id="main-slider">
                <?php
                    $slider_args = [
                        'order'       => 'ASC',
                        'post_type'   => 'slider_image',
                        'posts_per_page' => 6,
                    ];
                    $slider = new WP_Query($slider_args);
                    if($slider->have_posts()):
                        $slider_count = $slider->found_posts;
                    ?>
                    <ol class="carousel-indicators">
                        <?php for($i = 0; $i < $slider_count ;  $i++) { ?>
                            <li data-target="#main-slider"
                                data-slide-to="<?php echo $i; ?>"
                                class="<?php echo ($i == 0) ? 'active' : ''?>">
                            </li>
                        <?php } ?>
                    </ol> <!--.carousel-indicators-->

                    <ul class="carousel-inner reset-list" role="listbox">
                        <?php $i = 0; while($slider->have_posts()): $slider->the_post(); ?>
                            <li class="carousel-item text-center <?php echo ($i == 0) ? 'active' : ''?>">
                                <?php
                                $attr = ['class' => 'img-fluid slider-img'];
                                the_post_thumbnail( 'full', $attr );
                                ?>
                            </li><!--.carousel-item-->
                            <?php $i++; endwhile; ?>
                    </ul> <!--.carouse-inner-->

                <a href="#main-slider" class="carousel-control-prev" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a href="#main-slider" class="carousel-control-next" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>

                <?php endif;  wp_reset_postdata(); ?>
            </div>

            <?php

            /** Show second screen */

            if (get_field('show_second_section')) : ?>

                <section class="row second-screen">
                    <div class="container">
                        <div class="row justify-content-between">
                            <h3 class="section-header normal-font col-12 text-center">
                                <?php the_field('second_screen_title') ?>
                            </h3>
                            <?php the_content(); ?>
                        </div>
                    </div>
                </section>

            <?php endif; ?>

            <?php

            if (get_field('show_third_section')): ?>

                <section class="row third-screen">
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
                </section>
            <?php endif; ?>
            <?php
            $testimonials_args = [
                        'order'       => 'ASC',
                        'post_type'   => 'testimonial_post',
                        'posts_per_page' => 6,
                        'suppress_filters' => true,
                    ];
            $testimonials = new WP_Query($testimonials_args);
            if($testimonials->have_posts()):
                $count = $testimonials->found_posts;
                ?>
            <section class="row testimonial-section">
                <div class="container-fluid">
                    <h5 class="text-center testimonial-section-title"><?php echo __('Отзывы клиентов'); ?></h5>
                    <div class="carousel slide row justify-content-center" id="testimonial-slider">
                        <ul class="carousel-inner reset-list col-8 col-xl-6" role="listbox">
                            <?php $j = 0; while($testimonials->have_posts()): $testimonials->the_post(); ?>
                                <li class="carousel-item <?php echo ($j == 0) ? 'active' : ''?>">
                                    <div class="testimonial-box">
                                            <?php
                                            $attr = array('class' => 'testimonial-img');
                                            the_post_thumbnail( ['90', '90'], $attr );
                                            ?>
                                            <?php the_content('class => "testim"'); ?>
                                            <p class="testemonial-title"><?php the_title(); ?></p>
                                    </div>

                                </li><!--.carousel-item-->
                                <?php $j++; endwhile; ?>
                        </ul> <!--.carouse-inner-->

                        <a href="#testimonial-slider" class="carousel-control-prev" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a href="#testimonial-slider" class="carousel-control-next" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </section>
            <?php endif;  wp_reset_postdata(); ?>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
