<?php
/*
Plugin Name: Simple Bookmarking
Plugin URI: http://www.savetheurl.com/
Description: This is a simple social bookmarking sharing widget, which will be available in each post & pages with link icon to share your post and pages with popular social bookmarking engines.
Author: Thamizhchelvan
Version: 1.0
Author URI: http://submit-article.co.uk/
*/


function add_bookmark_icons($content)
{

if(is_page() || is_single())
{
//site & data
global $post;
$posttitle = urlencode($post->post_title);
$posturl = urlencode(get_permalink($post->ID));
$social_sites = array(
"delicious" => "http://del.icio.us/post?url=".$posturl."&title=".$posttitle,
"digg" => "http://digg.com/submit?phase=2&url=".$posturl."&title=".$posttitle,
"reddit" => "http://reddit.com/submit?url=".$posturl."&title=".$posttitle,
"facebook" => "http://www.facebook.com/share.php?u=".$posturl,
"technorati" => "http://technorati.com/faves?add=".$posturl,
"stumbleupon" => "http://www.stumbleupon.com/submit?url=".$posturl."&title=".$posttitle,
"savetheurl" => "http://www.savetheurl.com/submit?url=".$posturl
);

//build the widget
$bwidget = '<div>';
$site_url = get_option('siteurl');

foreach($social_sites as $site => $data)
{

$bwidget .= '<a rel="nofollow" onclick="javascript:window.open(\''.$data.'\'); return false;" href="http://www.'.$site.'.com/" title="'.$site.'"><img src="'.$site_url.'/wp-content/plugins/simple-bookmarking/images/'.$site.'.gif" alt="'.$site.'" ></a> | ';
}

$bwidget = substr($bwidget,0,strlen($bwidget)-4);
$bwidget .= '</div>';
$content .= $bwidget;
}
return $content;
}

add_action('the_content', 'add_bookmark_icons');

?>