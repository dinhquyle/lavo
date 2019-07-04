<?php
function my_custom_blog_post_type() {
  register_post_type('blog', array (
    'labels'                  => array (
      'name'                  => __( 'ブログ' ),
      'singular_name'         => __( 'ブログ' ),
      'add_new'               => __( '新しくブログを書く' ),
      'add_new_item'          => __( 'ブログ記事を書く' ),
      'edit_item'             => __( 'ブログ記事を編集' ),
      'new_item'              => __( '新しいブログ記事' ),
      'view_item'             => __( 'ブログ記事を見る' ),
      'search_staff'          => __( 'ブログ記事を探す' ),
      'not_found'             => __( 'ブログ記事はありません' ),
      'not_found_in_trash'    => __( 'ゴミ箱にブログ記事はありません' ),
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
add_action ( 'init', 'my_custom_blog_post_type' );

function create_cat_taxonomy_blogcat () {
  register_taxonomy('blogcat', 'blog', array (
    'labels'                  => array (
      'name'                  => __( 'ブログcat' ),
      'menu_name'             => __( 'カテゴリー' ),
      'edit_item'             => __( 'Cat記事を編集' ),
      'all_items'             => __( 'ブログcat' ),
      'parent_item'           => __( 'Parent Cat' ),
      'add_new_item'          => __( 'Cat記事を書く' ),
      'search_items'          => __( 'ブログcat' ),
      'singular_name'         => __( 'ブログcat' ),
      'parent_item_colon'     => __( 'Parent Cat:' ),
    ),
    'show_ui'                 => true,
    'rewrite'                 => array ( 'slug' => 'blogcat' ),
    'query_var'               => true,
    'has_archive'             => true,
    'hierarchical'            => true,
    'show_admin_column'       => true,
  ));
}
add_action ( 'init', 'create_cat_taxonomy_blogcat', '0' );