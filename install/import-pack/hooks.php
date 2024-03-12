<?php
/**
 * Import pack hooks
 *
 * @package Import Pack
 */

add_action( 'admin_init', 'autoart_import_pack_defineds' );
add_action( 'admin_menu', 'autoart_register_import_menu' );
