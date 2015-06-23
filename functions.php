<?php

function theme_customizer( $wp_customize ) {

    $wp_customize->remove_control('header_image');

    $wp_customize->add_section( 'theme_logo_section' , array(
        'title'       => __( 'Logo', 'themeslug' ),
        'priority'    => 30,
        'description' => 'Upload a logo to replace the default site name and description in the header',
    ) );

    $wp_customize->add_section( 'theme_styles_section' , array(
        'title'       => __( 'Styles', 'themeslug' ),
        'priority'    => 30,
        'description' => 'Customize the site style',
    ) );

    $wp_customize->add_section( 'theme_links_section' , array(
        'title'       => __( 'Links', 'themeslug' ),
        'priority'    => 30,
        'description' => 'Customize outbound links',
    ) );


    $wp_customize->add_setting( 'theme_logo' );
    $wp_customize->add_setting( 'theme_logo_top_spacing' );
    $wp_customize->add_setting( 'theme_logo_bottom_spacing' );

    $wp_customize->add_setting( 'theme_background_color' );
    $wp_customize->add_setting( 'theme_highlight_color' );

    $wp_customize->add_setting( 'theme_link_homepage' );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'theme_logo', array(
        'label'    => __( 'Logo', 'themeslug' ),
        'section'  => 'theme_logo_section',
        'settings' => 'theme_logo',
    ) ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_logo_top_spacing', array(
        'label'          => __( 'Top spacing', 'top_spacing' ),
        'section'        => 'theme_logo_section',
        'settings'       => 'theme_logo_top_spacing'
    ) ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_logo_bottom_spacing', array(
        'label'          => __( 'Bottom spacing', 'bottom_spacing' ),
        'section'        => 'theme_logo_section',
        'settings'       => 'theme_logo_bottom_spacing'
    ) ) );


    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_background_color', array(
        'label'          => __( 'Background Color', 'theme_background_color' ),
        'section'        => 'theme_styles_section',
        'settings'       => 'theme_background_color'
    ) ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_highlight_color', array(
        'label'          => __( 'Highlight Color', 'theme_highlight_color' ),
        'section'        => 'theme_styles_section',
        'settings'       => 'theme_highlight_color'
    ) ) );

    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'theme_link_homepage', array(
        'label'          => __( 'Site Link', 'theme_link_homepage' ),
        'section'        => 'theme_links_section',
        'settings'       => 'theme_link_homepage'
    ) ) );


}


function theme_scripts()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/css/foundation.css');
    wp_enqueue_style('base', get_stylesheet_directory_uri() . '/css/base.css');

    $custom_css = "
                .rs-program-title a {
                        color: " . get_theme_mod('theme_highlight_color') . " ;
                }
                ";

    wp_add_inline_style('base', $custom_css);
}

function rs_before_templates()
{
    ?>
    <div class="row">
    <div class="small-12 large-12 columns bg-white pad-30" role="main"
    style="<?php if (get_theme_mod('theme_highlight_color')) {
        echo "border-top: 3px solid " . get_theme_mod('theme_highlight_color');
    } ?>">
<?php
}

function rs_after_templates()
{
    echo "</div></div>";
}

add_action( 'customize_register', 'theme_customizer' );
add_action( 'wp_enqueue_scripts', 'theme_scripts' );
add_action ( 'rs_before_templates', 'rs_before_templates' );
add_action ( 'rs_after_templates_sidebar', 'rs_after_templates' );
