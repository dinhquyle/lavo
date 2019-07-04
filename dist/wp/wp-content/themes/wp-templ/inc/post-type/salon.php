<?php
function my_custom_salon_post_type() {
	register_post_type('salon', array (
		'labels'                  => array (
			'name'                  => __( '店舗情報' ),
			'singular_name'         => __( '店舗情報' ),
			'add_new'               => __( '新しく店舗情報を書く' ),
			'add_new_item'          => __( '店舗情報記事を書く' ),
			'edit_item'             => __( '店舗情報記事を編集' ),
			'new_item'              => __( '新しい店舗情報記事' ),
			'view_item'             => __( '店舗情報記事を見る' ),
			'search_staff'          => __( '店舗情報記事を探す' ),
			'not_found'             => __( '店舗情報記事はありません' ),
			'not_found_in_trash'    => __( 'ゴミ箱にsample記事はありません' ),
			'parent_item_colon'     => ''
		),
		'public'                  => true,
		'rewrite'                 => true,
		'show_ui'                 => true,
		'supports'                => array ( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions' ),
		'query_var'               => true,
		'menu_icon'               => 'dashicons-welcome-write-blog',
		'taxonomies'              => array ( 'post_tag' ),
		'has_archive'             => true,
		'hierarchical'            => false,
		'menu_position'           => 5,
		'capability_type'         => 'post',
		'show_in_admin_bar'       => true,
		'publicly_queryable'      => true,
	));
}
add_action ( 'init', 'my_custom_salon_post_type' );