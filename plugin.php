<?php
/**
 * Plugin Name: WooCommerce Templates for Oxygen
 * Description: Allows customized WooCommerce templates for Oxygen.
 * Version: 1.0.0
 * Author: Luxibay
 * Author URI: https://luxibay.com/
 */

function wcto2_plugin_path() {

   // gets the absolute path to this plugin directory
 
   return untrailingslashit( plugin_dir_path( __FILE__ ) );
 }

function wcto2_locate_template( $template, $template_name, $template_path ) {
   global $woocommerce;

   $_template = $template;

   if ( ! $template_path ) $template_path = $woocommerce->template_url;

   $plugin_path  = wcto2_plugin_path() . '/woocommerce/';

   // Look within passed path within the theme - this is priority
   $template = locate_template(

   array(
      $template_path . $template_name,
      $template_name
   )
   );

   // Modification: Get the template from this plugin, if it exists
   if ( ! $template && file_exists( $plugin_path . $template_name ) )
   $template = $plugin_path . $template_name;

   // Use default template
   if ( ! $template )
   $template = $_template;

   // Return what we found
   return $template;
}

add_filter( 'woocommerce_locate_template', 'wcto2_locate_template', 10, 3 );
