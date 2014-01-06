<?php
/*
Plugin Name: PMPro Levels as UL Layout
Plugin URI: http://www.paidmembershipspro.com/wp/pmpro-ul-levels/
Description: Display your Membership Levels page in a UL Layout (includes classes for Foundation by ZURB Pricing table).
Version: .1
Author: Stranger Studios / Tweaked by Lasse Larsen
Author URI: http://www.seventysixnyc.com
*/

//use our levels template
function pmproul_pmpro_pages_shortcode_levels($content)
{
	ob_start();
	include(plugin_dir_path(__FILE__) . "templates/levels.php");
	$temp_content = ob_get_contents();
	ob_end_clean();
	return $temp_content;
}
add_filter("pmpro_pages_shortcode_levels", "pmproul_pmpro_pages_shortcode_levels");

