<?php

/* Rewrite Rules */
add_action('init', 'makerspace_rewrite_rules');
function makerspace_rewrite_rules() {
  add_rewrite_rule( 'directory/space/(\d*)/?', 'index.php?makerspace=true&eid=$matches[1]', 'top' );
}

/* Query Vars */
add_filter( 'query_vars', 'makerspace_register_query_var' );
function makerspace_register_query_var( $vars ) {
  $vars[] = 'makerspace';
  $vars[] = 'eid';
  return $vars;
}

/* Template Include */
add_filter('template_include', 'makerspace_include', 1, 1);
function makerspace_include($template) {
  global $wp_query; //Load $wp_query object
  $page_value = (isset($wp_query->query_vars['makerspace'])?$wp_query->query_vars['makerspace']:''); 

  if ($page_value && $page_value == "true") { 
    return $_SERVER['DOCUMENT_ROOT'].'/wp-content/themes/makerspaces/page-entry.php'; //Load your template or file
  }

  return $template; //Load normal template when $page_value != "true" as a fallback
}