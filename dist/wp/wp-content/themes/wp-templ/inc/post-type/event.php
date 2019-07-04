<?php
function my_custom_event_post_type() {
  register_post_type('event', array (
    'labels'                  => array (
      'name'                  => __( 'イベント' ),
      'singular_name'         => __( 'イベント' ),
      'add_new'               => __( '新しくイベントを書く' ),
      'add_new_item'          => __( 'イベント記事を書く' ),
      'edit_item'             => __( 'イベント記事を編集' ),
      'new_item'              => __( '新しいイベント記事' ),
      'view_item'             => __( 'イベント記事を見る' ),
      'search_staff'          => __( 'イベント記事を探す' ),
      'not_found'             => __( 'イベント記事はありません' ),
      'not_found_in_trash'    => __( 'ゴミ箱にイベント記事はありません' ),
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
add_action ( 'init', 'my_custom_event_post_type' );