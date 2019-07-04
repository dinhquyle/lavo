<?php
function my_custom_recruit_post_type() {
  register_post_type('recruit', array (
    'labels'                  => array (
      'name'                  => __( '求人情報' ),
      'singular_name'         => __( '求人情報' ),
      'add_new'               => __( '新しく求人情報を書く' ),
      'add_new_item'          => __( '求人情報記事を書く' ),
      'edit_item'             => __( '求人情報記事を編集' ),
      'new_item'              => __( '新しい求人情報記事' ),
      'view_item'             => __( '求人情報記事を見る' ),
      'search_staff'          => __( '求人情報記事を探す' ),
      'not_found'             => __( '求人情報記事はありません' ),
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
add_action ( 'init', 'my_custom_recruit_post_type' );