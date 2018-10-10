<?php
/**
 * Created by PhpStorm.
 * User: Swante
 * Date: 01.03.2018
 * Time: 22:52
 */

function customizer_footer($wp_customize){

    $wp_customize->add_section('footer_custom', array(
        'title' => 'Настройки подвала сайта'
    ));

    /***************************************************
     * *************************************************
     * ----------------Adding footer text
     */

    $wp_customize->add_setting('information_footer');

    $wp_customize->add_control('information_footer',
        array(
            'label' => 'Текст в подвале сайта',
            'section' => 'footer_custom',
            'type' => 'text',
        )
    );
    $wp_customize->add_setting('button_callback_footer');

    $wp_customize->add_control('button_callback_footer',
            array(
                'label' => 'Текст в кнопке заказа звонка',
                'section' => 'footer_custom',
                'type' => 'text',
            )
        );

    /***************************************************
     * *************************************************
     * ----------------Adding instagram icon
     */
    $wp_customize->add_setting('insta_icon_footer');

    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'insta_icon_footer', array(
        'label' => 'Иконка instagram',
        'section' => 'footer_custom',
        'settings' => 'insta_icon_footer',
        'width' => '91',
        'height' => '91'
    )));

    /***************************************************
     * *************************************************
     * ----------------Adding facebook icon
     */
    $wp_customize->add_setting('fb_icon_footer');

    $wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'fb_icon_footer', array(
        'label' => 'Иконка facebook',
        'section' => 'footer_custom',
        'settings' => 'fb_icon_footer',
        'width' => '91',
        'height' => '91'
    )));

    /***************************************************
     * *************************************************
     * ----------------Adding instagram link
     */
    $wp_customize->add_setting('insta_link');

    $wp_customize->add_control('insta_link',
        array(
            'label' => 'Ссылка insta',
            'section' => 'footer_custom',
            'type' => 'text',
        )
    );

    /***************************************************
     * *************************************************
     * ----------------Adding facebook link
     */
    $wp_customize->add_setting('facebook_link');

    $wp_customize->add_control('facebook_link',
        [
            'label' => 'Ссылка facebook',
            'section' => 'footer_custom',
            'type' => 'text',
        ]
    );

    /***************************************************
     * *************************************************
     * ----------------Adding phone number
     */
    $wp_customize->add_setting('contact_phone_number');

    $wp_customize->add_control('contact_phone_number',
        [
            'label' => __('Номер телефона'),
            'section' => 'footer_custom',
            'type' => 'text',
        ]
    );

    /***************************************************
     * *************************************************
     * ----------------Adding phone number label
     */
    $wp_customize->add_setting('phone_number_label');

    $wp_customize->add_control('phone_number_label',
        [
            'label' => __('Номер телефона ярлык'),
            'description' => __('Ярлык, который будет выведен на страничке'),
            'section' => 'footer_custom',
            'type' => 'text',
        ]
    );

    /***************************************************
     * *************************************************
     * ----------------Adding email
     */
    $wp_customize->add_setting('contact_email');

    $wp_customize->add_control('contact_email',
        [
            'label' => __('Электронная почта'),
            'section' => 'footer_custom',
            'type' => 'text',
        ]
    );

    /***************************************************
     * *************************************************
     * ----------------Adding email label
     */
    $wp_customize->add_setting('email_label');

    $wp_customize->add_control('email_label',
        [
            'label' => __('Электронная почта ярлык'),
            'description' => __('Ярлык, который будет выведен на страничке'),
            'section' => 'footer_custom',
            'type' => 'text',
        ]
    );

    /***************************************************
     * *************************************************
     * ----------------Adding address
     */
    $wp_customize->add_setting('address');

    $wp_customize->add_control('address',
        [
            'label' => __('Адресс'),
            'section' => 'footer_custom',
            'type' => 'text',
        ]
    );

    /***************************************************
     * *************************************************
     * ----------------Adding address
     */
    $wp_customize->add_setting('address_label');

    $wp_customize->add_control('address_label',
        [
            'label' => __('Адресс ярлык'),
            'description' => __('Ярлык, который будет выведен на страничке'),
            'section' => 'footer_custom',
            'type' => 'text',
        ]
    );

}
add_action( 'customize_register', 'customizer_footer' );

function output_footer_customization(){ ?>
    <style>
        /*
      adding bg to first screen
       */
        .social-link-insta{
            background: url("<?php echo wp_get_attachment_url(get_theme_mod('insta_icon_footer')); ?>") 0 0/cover no-repeat scroll;
        }
        .social-link-fb{
            background: url("<?php echo wp_get_attachment_url(get_theme_mod('fb_icon_footer')); ?>") 0 0/cover no-repeat scroll;
        }
    </style>
<?php }
add_action('wp_head', 'output_footer_customization');