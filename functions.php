<?php



global $wpdb;
$get_zax_tag_limit = $wpdb->get_row("SELECT * FROM $wpdb->postmeta WHERE meta_key = 'zax_tag_limit'");

//Limit number of tags inside widget
function zaxara_tag_widget_limiter($args){

global $wpdb;

$get_zax_tag_limit = $wpdb->get_row("SELECT * FROM $wpdb->postmeta WHERE meta_key = 'zax_tag_limit'");

if (!empty($get_zax_tag_limit->meta_value) && $get_zax_tag_limit->meta_value != 0 ) {


 //Check if taxonomy option inside widget is set to tags
 if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){
  $args['number'] = $get_zax_tag_limit->meta_value; //Limit number of tags
 }

 return $args;
}
}


if (!empty($get_zax_tag_limit->meta_value) && $get_zax_tag_limit->meta_value != 0 ) {

add_filter('widget_tag_cloud_args', 'zaxara_tag_widget_limiter');

}

// We Are testing git

