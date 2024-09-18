<?php
/**
 * Import pack data package demo
 *
 */
$plugin_includes = array(
  array(
    'name'     => __( 'Elementor Website Builder', 'autoart' ),
    'slug'     => 'elementor',
  ),
  array(
    'name'     => __( 'Elementor Pro', 'autoart' ),
    'slug'     => 'elementor-pro',
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'elementor-pro.zip',
  ),
  array(
    'name'     => __( 'Advanced Custom Fields PRO', 'autoart' ),
    'slug'     => 'advanced-custom-fields-pro',
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'advanced-custom-fields-pro.zip',
  ),
  array(
    'name'     => __( 'Smart Slider 3 Pro', 'autoart' ),
    'slug'     => 'nextend-smart-slider3-pro',
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'nextend-smart-slider3-pro.zip',
  ),
  array(
    'name'     => __( 'Gravity Forms', 'autoart' ),
    'slug'     => 'gravityforms',
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'gravityforms.zip',
  ),
  array(
    'name'     => __( 'Newsletter', 'autoart' ),
    'slug'     => 'newsletter',
  ),
  array(
    'name'     => __( 'WooCommerce', 'autoart' ),
    'slug'     => 'woocommerce',
  ),

);

return apply_filters( 'autoart/import_pack/package_demo', [
    [
        'package_name'  => 'autoart-main',
        'preview'       => get_template_directory_uri() . '/screenshot.jpg',
        'url_demo'      => 'https://autoart.beplusthemes.com/',
        'title'         => __( 'AutoArt Demo', 'autoart' ),
        'description'   => __( 'AutoArt main demo.', 'autoart' ),
        'plugins'       => $plugin_includes,
    ],
] );
