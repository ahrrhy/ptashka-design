<?php

/** Create PORTFOLIO **/

function portfolio_post_type() {
    register_post_type( 'portfolio_work',
        [
            'labels' => [
                'name' => __( 'Portfolio Works' ),
                'singular_name' => __( 'Portfolio Work' )
            ],
            'description' =>  __( 'Portfolio Work Post. Here you add your personal designs' ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'supports' => [
                'title',
                'excerpt',
                'thumbnail',
                'title',
                'editor',
                'author',
                'excerpt',
                'trackbacks',
                'custom-fields',
                'comments',
                'revisions',
                'page-attributes',
                'post-formats'
            ], // 'title','editor','author',,'excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        ]
    );
}
add_action( 'init', 'portfolio_post_type' );

/** Create MAIN SLIDER POSTS **/

function slider_post_type() {
    register_post_type( 'slider_image',
        [
            'labels' => [
                'name' => __( 'Slider Image' ),
                'singular_name' => __( 'Slider Image' )
            ],
            'description' =>  __( 'Slider Image. Here you add slider image. One per Post' ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'supports' => [
                'title',
                'thumbnail',
                'editor'
            ], // 'title','editor','author',,'excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        ]
    );
}
add_action( 'init', 'slider_post_type' );

/** Create TESTIMONIALS POSTS **/

function testimonial_post_type() {
    register_post_type( 'testimonial_post',
        [
            'labels' => [
                'name' => __( 'Testimonials' ),
                'singular_name' => __( 'Testimonial' )
            ],
            'description' =>  __( 'Testimonial. Add customer photography to the Featured Image 
            and write text to main content zone. Add date to field Date' ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => true,
            'supports' => [
                'title',
                'thumbnail',
                'editor',
                'custom-fields'
            ], // 'title','editor','author',,'excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        ]
    );
}
add_action( 'init', 'testimonial_post_type' );