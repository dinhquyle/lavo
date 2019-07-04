<?php
function my_custom_coupon_post_type() {
  register_post_type('coupon', array (
    'labels'                  => array (
      'name'                  => __( 'クーポン' ),
      'singular_name'         => __( 'クーポン' ),
      'add_new'               => __( '新しくクーポンを書く' ),
      'add_new_item'          => __( 'クーポン記事を書く' ),
      'edit_item'             => __( 'クーポン記事を編集' ),
      'new_item'              => __( '新しいクーポン記事' ),
      'view_item'             => __( 'クーポン記事を見る' ),
      'search_staff'          => __( 'クーポン記事を探す' ),
      'not_found'             => __( 'クーポン記事はありません' ),
      'not_found_in_trash'    => __( 'ゴミ箱にクーポン記事はありません' ),
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
add_action ( 'init', 'my_custom_coupon_post_type' );