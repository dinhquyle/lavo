<?php
function my_custom_news_post_type() {
  register_post_type('news', array (
    'labels'                  => array (
      'name'                  => __( '新着情報' ),
      'singular_name'         => __( '新着情報' ),
      'add_new'               => __( '新しく新着情報を書く' ),
      'add_new_item'          => __( '新着情報記事を書く' ),
      'edit_item'             => __( '新着情報記事を編集' ),
      'new_item'              => __( '新しい新着情報記事' ),
      'view_item'             => __( '新着情報記事を見る' ),
      'search_staff'          => __( '新着情報記事を探す' ),
      'not_found'             => __( '新着情報記事はありません' ),
      'not_found_in_trash'    => __( 'ゴミ箱に新着情報記事はありません' ),
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
add_action ( 'init', 'my_custom_news_post_type' );