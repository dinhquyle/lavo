<?php
function my_custom_column_post_type() {
  register_post_type('column', array (
    'labels'                  => array (
      'name'                  => __( 'カラム' ),
      'singular_name'         => __( 'カラム' ),
      'add_new'               => __( '新しくカラムを書く' ),
      'add_new_item'          => __( 'カラム記事を書く' ),
      'edit_item'             => __( 'カラム記事を編集' ),
      'new_item'              => __( '新しいカラム記事' ),
      'view_item'             => __( 'カラム記事を見る' ),
      'search_staff'          => __( 'カラム記事を探す' ),
      'not_found'             => __( 'カラム記事はありません' ),
      'not_found_in_trash'    => __( 'ゴミ箱にカラム記事はありません' ),
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
add_action ( 'init', 'my_custom_column_post_type' );