<?php

namespace SimpleDataTables;

defined('ABSPATH') || exit;


if (shortcode_exists('simple-data-table')) {
  return false;
}

/*
=== Simple Data Tables Shortcode Usages ===
  [simple-data-table 
      type="post|page|attachment|comment|user" 
      filter="author|category|tag|post|role"
      display="id,title,content,date,link" 
      return="html|raw|json"
  ] 
*/
add_shortcode('simple-data-table', function ($atts, $content = '') {
  $available_columns = array(
    'comment' => array(
      'id' => 'comment_ID',
      'author' => 'comment_author',
      'date' => 'comment_date',
      'title' => 'comment_content',
      'status' => 'comment_approved',
      'link' => 'comment_post_ID',
    ),
    'user' => array(
      'id' => 'ID',
      'author' => 'user_login',
      'date' => 'user_registered',
      'title' => 'user_email',
      'status' => 'user_status',
      'link' => 'user_url',
    ),
  );

  // Since post, page, attachment have same columns 
  // this is quick way to populate the 
  // $available_columns array.
  $keys = array('post', 'page', 'attachment');
  $available_columns += array_fill_keys(
    $keys,
    array(
      'id' => 'ID',
      'author' => 'post_author',
      'date' => 'post_date',
      'title' => 'post_title',
      'status' => 'post_status',
      'link' => 'guid',
    )
  );

  // Let's add some default values if attributes were left empty or missing.
  if ('' === $atts) {
    $atts = array('post', 'id,author,date,title,status,link', 'html');
  }

  if (
    !array_key_exists('type', $atts)
    || '' === $atts['type']
  ) {
    $atts['type'] = 'post';
  }

  if (
    !array_key_exists('display', $atts)
    || '' === $atts['display']
  ) {
    $atts['display'] = 'id,author,date,title,status,link';
  }

  if (
    !array_key_exists('output', $atts)
    || '' === $atts['output']
  ) {
    $atts['output'] = 'html';
  }

  $data = get_shortcode_data($atts['type']);
  $columns = get_shortcode_columns($available_columns, $atts['display'], $atts['type']);
  $output  = get_shortcode_output(
    $atts['output'],
    $atts['type'],
    $atts['filter'],
    $data,
    $columns,
    $available_columns
  );

  return $output;
});


function get_shortcode_data($type)
{
  $available_types = array(
    'post',
    'page',
    'attachment',
    'comment',
    'user'
  );

  // If we get unknown type assign 'post' instead.
  if (!in_array($type, $available_types)) {
    $type = 'post';
  }

  $args = array('numberposts' => 99999,);

  switch ($type) {
    case 'post':
      return format_shortcode_post_data(get_posts($args));
      break;
    case 'page':
      return format_shortcode_post_data(get_pages($args));
      break;
    case 'attachment':
      $args['post_type'] = 'attachment';
      return format_shortcode_post_data(get_posts($args));
      break;
    case 'comment':
      return format_shortcode_comment_data(get_comments($args));
      break;
    case 'user':
      return format_shortcode_user_data(get_users($args));
      break;
    default:
      break;
  }
}

function get_shortcode_columns($av_columns, $list, $type)
{
  $new_columns = array();
  $columns = explode(',', $list);
  $columns = array_map('trim', $columns);

  // If we have incorect values for the 'display' attribute
  if (
    empty(array_intersect(array_values($av_columns[$type]), $columns))
    && empty(array_intersect(array_keys($av_columns[$type]), $columns))
  ) {
    return false;
  }

  // Convert user defined or mixed columns to system default columns.
  if (!empty(array_intersect(array_keys($av_columns[$type]), $columns))) {

    foreach ($columns as $value) {

      if (
        in_array($value, $av_columns[$type])
        || array_key_exists($value, $av_columns[$type])
      ) {
        $new_columns[] = $av_columns[$type][$value];
      }
    }

    $columns = $new_columns;

    return $columns;
  }
}


function get_shortcode_output($output, $type, $filter, $data, $columns, $av_columns)
{
  $unique_key = substr(md5(mt_rand()), 0, 12);
  // Unique key allow us to have muliple dynatables on the same page.
  $outputs = array(
    'html',
    'json',
    'raw'
  );

  // If we get unknown output assing 'html' instead.
  if (!in_array($output, $outputs)) {
    $output = 'html';
  }

  if ('html' === $output) {
    $authors = array();
    $roles = array();
    ob_start();
    require_once DIR_PATH . 'inc/views/frontend/dynamic-table.php';
    $output = ob_get_contents();
    ob_clean();
  } else {
    // JSON - TODO @version 1.1
    // Raw - TODO @version 1.1
  }

  return $output;
}

// Helper & Utility functions.
function format_shortcode_post_data($posts)
{
  $posts = get_shortcode_post_author_names($posts);
  $posts = format_shortcode_datetime($posts);
  $posts = format_shortcode_post_titles($posts);
  return $posts;
}

function format_shortcode_comment_data($comments)
{
  $comments = get_shortcode_comment_post_links($comments);
  $comments = format_shortcode_datetime($comments, 'comment');
  $comments = get_shortcode_comment_status($comments);

  return $comments;
}

function format_shortcode_user_data($users)
{
  $users = format_shortcode_user_register_datetime($users, 'user');
  return $users;
}

function format_shortcode_post_titles($posts)
{
  $count = 0;

  foreach (array_column($posts, 'post_title') as $title) {
    $posts[$count]->title = ucwords(str_replace('-', ' ', str_replace('_', ' ', $title)));
    $count++;
  }

  return $posts;
}

function format_shortcode_datetime($data, $type = 'post')
{
  $count = 0;

  foreach (array_column($data, $type . '_date') as $datetime) {

    if ('comment' === $type) {
      $data[$count]->comment_date = date('F j, Y', strtotime($datetime));
    } else {
      $data[$count]->post_date = date('F j, Y', strtotime($datetime));
    }

    $count++;
  }

  return $data;
}

function format_shortcode_user_register_datetime($data)
{
  $count = 0;

  foreach (array_column($data, 'user_registered') as $datetime) {
    $data[$count]->user_registered = date('F j, Y, g:i a', strtotime($datetime));
    $count++;
  }

  return $data;
}

function get_shortcode_comment_post_links($comments)
{
  $count = 0;

  foreach (array_column($comments, 'comment_post_ID') as $post_id) {
    $comments[$count]->comment_post_ID = get_post_permalink($post_id);
    $count++;
  }

  return $comments;
}

function get_shortcode_comment_status($comments)
{
  $count = 0;

  foreach (array_column($comments, 'comment_approved') as $status) {

    if ('0' === $status) {
      $comments[$count]->comment_approved = 'pending';
    } else {
      $comments[$count]->comment_approved = 'approved';
    }

    $count++;
  }

  return $comments;
}

function get_shortcode_post_author_names($posts)
{
  $count = 0;

  foreach (array_column($posts, 'post_author') as $id) {
    $posts[$count]->post_author = get_user_by('id', $id)->data->display_name;
    $count++;
  }

  return $posts;
}
