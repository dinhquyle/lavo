<?php
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true);
remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'automatic_updater_disabled', '__return_true' );
add_filter( 'auto_update_core', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );

if(!defined('APP_URL')) include_once( dirname(ABSPATH) . "/app_config.php" );
include_once( TEMPLATEPATH . '/inc/post-type-init.php' );

//login logo
function custom_login_logo() {
	echo '<style type="text/css">h1 a { background: url('.get_bloginfo('template_directory').'/images/logo.png) 50% 50% no-repeat !important; width:100% !important;}</style>';
}
add_action('login_head', 'custom_login_logo');

// Remove "Thank you for creating with WordPress"
function remove_footer_admin () {
		return '';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// Update CSS within in Admin
function admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri() . '/admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');
function my_enqueue($hook) {
  wp_enqueue_script('my_custom_script', get_template_directory_uri() . '/admin.js');
}
add_action('admin_enqueue_scripts', 'my_enqueue');

// link for logo
function new_wp_login_url() {
	return home_url();
}
add_filter('login_headerurl', 'new_wp_login_url');

// title for logo
function new_wp_login_title() {
	return get_option('blogname');
}
add_filter('login_headertitle', 'new_wp_login_title');

// Theme support
add_theme_support( 'post-thumbnails' );

// Support allow SVG upload
function add_file_types_to_uploads($file_types){
	$file_types['svg'] = 'image/svg+xml';
	$file_types['svgz'] = 'image/svg+xml';
	return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');
function fadupla_svg_enqueue_scripts( $hook ) {
	wp_enqueue_style( 'fadupla-svg-style', get_theme_file_uri( '/assets/css/svg.css' ) );
	wp_enqueue_script( 'fadupla-svg-script', get_theme_file_uri( '/assets/js/svg.js' ), 'jquery' );
	wp_localize_script(
		'fadupla-svg-script', 'script_vars',
		array( 'AJAXurl' => admin_url( 'admin-ajax.php' ) )
	);
}
add_action( 'admin_enqueue_scripts', 'fadupla_svg_enqueue_scripts' );
function fadupla_get_attachment_url_media_library() {
	$url = '';
	$attachmentID = isset( $_REQUEST['attachmentID'] ) ? $_REQUEST['attachmentID'] : '';
	if ( $attachmentID ) $url = wp_get_attachment_url( $attachmentID );
	echo $url;
	die();
}
add_action( 'wp_ajax_svg_get_attachment_url', 'fadupla_get_attachment_url_media_library' );

//timthumb
define('THEME_DIR', get_template_directory_uri());
/* Timthumb CropCropimg */
function thumbCrop($img='', $w=false, $h=false , $zc=1, $a=false, $cc=false ){
	if($h) $h = "&amp;h=$h";
	else $h = "";
	if($w) $w = "&amp;w=$w";
	else $w = "";
	if($a) $a = "&amp;a=$a";
	else $a = "";
	if($cc) $cc = "&amp;cc=$cc";   
	else $cc = "";	

	$img = str_replace(get_bloginfo('url'), '', $img);
	$image_url = THEME_DIR . "/timthumb/timthumb.php?src=" . $img . $h . $w. "&amp;zc=".$zc .$a .$cc;	
	return $image_url;
}

// paging
function my_option_posts_per_page() {
  return 0;
}
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
add_action( 'init', 'my_modify_posts_per_page', 0);

function wp_post_type_archive($post_type = "post", $home_url="", $havecount = false){
	global $wpdb;
	if($home_url == "") $home_url  = home_url("/");
	$html = '';
	$txtCount = "";
	$posttype = get_post_type_object($post_type);
	$slug = $posttype->rewrite['slug'];
	$years = $wpdb->get_col("SELECT DISTINCT YEAR(post_date)
		FROM $wpdb->posts WHERE post_status = 'publish'
		AND post_type = '{$post_type}' ORDER BY post_date DESC");

	foreach($years as $year) :
	if($havecount) {
		$count = $wpdb->get_col("SELECT COUNT(*) countpost
			FROM $wpdb->posts WHERE post_status = 'publish'
			AND post_type = '{$post_type}' and YEAR(post_date) = '".$year."'");
		$txtCount = '('.$count[0].')';
	}
	$html .= '<li id="year'.$year.'"><a href="javascript:void(0);" class="dropdown">'.$year.'年 '.$txtCount.'</a><ul class="sub">';

	$months = $wpdb->get_col("SELECT DISTINCT MONTH(post_date)
		FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = '{$post_type}'
		AND YEAR(post_date) = '".$year."' ORDER BY post_date DESC");

	foreach($months as $month) :
		if($havecount) {
			$count = $wpdb->get_col("SELECT COUNT(*) countpost
				FROM $wpdb->posts WHERE post_status = 'publish'
				AND post_type = '{$post_type}' and YEAR(post_date) = '".$year."' and MONTH(post_date) = '".$month."'");
			$txtCount = '('.$count[0].')';
		}
		$html .= '<li><a href="'.$home_url.$slug."/".$year.'/'.$month.'">'.$month.'月 '.$txtCount.'</a></li>';
	endforeach;
	$html .= '</ul></li>';
	endforeach;
	return $html;
}

// for rewrite - this is alway at bottom of page
add_filter('post_type_link', 'custom_blog_permalink', 1, 3);
 function custom_blog_permalink($post_link, $id = 0, $leavename) {
	if ( strpos('%post_id%', $post_link) === 'FALSE' ) {
		return $post_link;
	}
	$post = get_post($id);
	if ( is_wp_error($post)) {
		return $post_link;
	}
	$post_type = get_post_type_object($post->post_type);
	return home_url($post_type->rewrite['slug'].'/p'.$post->ID.'/');
 }
function add_rewrites_init(){
	global $wp_rewrite;
	$postoj =  get_post_types( '', 'object' );
	foreach ( $postoj as $key=> $ar ) {
		$posttype = $ar->name;
		$slug = $ar->rewrite['slug'];
		$sgc = get_template_directory() . "/single-" . $posttype . ".php";
		$agr = get_template_directory() . "/archive-" . $posttype . ".php";
		if(@file_exists($sgc)){
			add_rewrite_rule($slug.'/p([0-9]+)?$', 'index.php?post_type='.$posttype.'&p=$matches[1]', 'top');
			add_rewrite_rule($slug.'/p([0-9]+)?/confirm/?', 'index.php?post_type='.$posttype.'&p=$matches[1]&actionFlag=confirm', 'top');
			add_rewrite_rule($slug.'/p([0-9]+)?/complete/?', 'index.php?post_type='.$posttype.'&p=$matches[1]&actionFlag=complete', 'top');
			add_rewrite_rule($slug.'/p([0-9]+)?/([0-9]+)/?', 'index.php?post_type='.$posttype.'&p=$matches[1]&page=$matches[2]', 'top');
		}
		if(@file_exists($agr)){
			add_rewrite_rule($slug.'/([0-9]{4})/([0-9]{1,2})/?$', 'index.php?post_type='.$posttype.'&year=$matches[1]&monthnum=$matches[2]', 'top');
			add_rewrite_rule($slug.'/([0-9]{4})/([0-9]{1,2})/page/([0-9]{1,})/?$', 'index.php?post_type='.$posttype.'&year=$matches[1]&monthnum=$matches[2]&paged=$matches[3]', 'top');
		}
	}
	$wp_rewrite->flush_rules(false);
}
add_action('init', 'add_rewrites_init');
//end for rewrite - this is alway at bottom of page

// Remove Attachment URL
add_action( 'parse_request', 'custom_remove_attachment_url' );
function custom_remove_attachment_url ($wp) {
	if ( array_key_exists( 'attachment', $wp->query_vars ) ) unset( $wp->query_vars['attachment'] );
}

add_filter( 'query_vars', 'custom_query_vars_filter' );
function custom_query_vars_filter($vars) {
	$vars[] .= 'actionFlag';
	return $vars;
}

// Disable auto redirect with same post_name
remove_action('template_redirect', 'redirect_canonical'); 



//get image from content 
function catch_that_image($noimg = true) {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches[1][0];

	if((empty($first_img) || $first_img == "") && $noimg) $first_img = APP_URL . "assets/img/common/other/img_nophoto.jpg";
	elseif(empty($noimg)) return false;
	return $first_img;
}