<?php
/*
* Plugin Name: Wp LimitTags  
* Plugin URI: https://github.com/meumairakram/Wp-tag-limiter
* Description: A simple yet Useful Plugin by Umair Akram to Limit the Number of Tags in TagCloud  
* Author: Umair Akram 
* Author URI: http://www.codeivo.com/umair-akram
* Version: 1.12  
* License: GPLv2 or later 
*/



add_action("admin_menu", "addMenu");

function addMenu() {
add_options_page('WP Tags Limiter', 'WP Tag Limiter','delete_posts','co-wp-tag-limiter','codeivo_tag_limiter_func');


};


function codeivo_tag_limiter_func() {

global $wpdb;

$tag_limit_exists = $wpdb->get_row("SELECT * FROM wp_postmeta WHERE meta_key = 'zax_tag_limit'");

$tag_limit_ex = $tag_limit_exists->meta_value;
if (empty($_POST)): 	

$form_action = htmlspecialchars($_SERVER['PHP_SELF']);
$output = 
<<<EOT
<div>
<h1>Wordpress Tag Limiter Plugin </h2>
<p> Enter the Number of Tags you want to Limit too (Only Number)</p>

<p>[ Set to '0' to display all tags, or Leave Empty ]</p>
<form action="$form_action?page=co-wp-tag-limiter" method="POST">
<input type="text" name="tag_limiter_val" value="$tag_limit_ex" class="tag_limiter_class" />
<input type="submit" value="Set Limit" class="button button-primary button-large" >
</form>
</div>
EOT;


echo $output;

else: 




$tag_limit = $_POST['tag_limiter_val'];

if (empty($tag_limit_exists->meta_key)) {

$add_limit = $wpdb->insert($wpdb->postmeta, array(

'post_id' => 1,
'meta_key' => 'zax_tag_limit',
'meta_value' => $tag_limit
	));

if ($add_limit) {
	echo '<p>Limit Set Successfully</p>';

}
else {

	echo '<p>We are unable to set limit</p>';
}

}

else {

	$wpdb->update($wpdb->postmeta, array('post_id' => 1,
'meta_key' => 'zax_tag_limit',
'meta_value' => htmlspecialchars($tag_limit)),array('meta_key' => 'zax_tag_limit'));


	echo '<p>Tag Limit Updated</p><br><a href="javascript:history.go(-1)"> << Go Back </a>';
}


 endif; 


};

include 'functions.php';


