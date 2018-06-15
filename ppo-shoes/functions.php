<?php

######## BLOCK CODE NAY LUON O TREN VA KHONG DUOC XOA ##########################
include 'includes/config.php';
include 'libs/HttpFoundation/Request.php';
include 'libs/HttpFoundation/Response.php';
include 'libs/HttpFoundation/Session.php';
include 'libs/custom.php';
include 'libs/common-scripts.php';
include 'libs/meta-box.php';
include 'libs/theme_functions.php';
include 'libs/theme_settings.php';
######## END: BLOCK CODE NAY LUON O TREN VA KHONG DUOC XOA ##########################
include 'includes/custom-user.php';
include 'includes/widgets/ads.php';
include 'includes/super-menu.php';
include 'includes/slider.php';
include 'includes/product.php';
include 'ajax.php';
if (is_admin()) {
    $basename_excludes = array('plugins.php', 'plugin-install.php', 'plugin-editor.php', 'themes.php', 'theme-editor.php', 
        'tools.php', 'import.php', 'export.php');
    if (in_array($basename, $basename_excludes)) {
        wp_redirect(admin_url());
    }

    include 'includes/orders.php';
    include 'libs/ppofeedback.php';

    // Add action
    add_action('admin_menu', 'custom_remove_menu_pages');
    add_action('admin_menu', 'remove_menu_editor', 102);
}

/**
 * Remove admin menu
 */
function custom_remove_menu_pages() {
    remove_menu_page('edit-comments.php');
    remove_menu_page('plugins.php');
    remove_menu_page('tools.php');
}

function remove_menu_editor() {
    remove_submenu_page('themes.php', 'themes.php');
    remove_submenu_page('themes.php', 'theme-editor.php');
    remove_submenu_page('plugins.php', 'plugin-editor.php');
    remove_submenu_page('options-general.php', 'options-writing.php');
    remove_submenu_page('options-general.php', 'options-discussion.php');
    remove_submenu_page('options-general.php', 'options-media.php');
}

/* ----------------------------------------------------------------------------------- */
# Setup Theme
/* ----------------------------------------------------------------------------------- */
if (!function_exists("ppo_theme_setup")) {

    function ppo_theme_setup() {
        ## Enable Links Manager (WP 3.5 or higher)
        //add_filter('pre_option_link_manager_enabled', '__return_true');

        ## Post Thumbnails
        if (function_exists('add_theme_support')) {
            add_theme_support('post-thumbnails');
        }
        add_image_size('218x144', 218, 144, true);
        add_image_size('238x158', 238, 158, true);
        add_image_size('250x185', 250, 185, true);
        add_image_size('170x113', 170, 113, true);
        ## Post formats
        add_theme_support('post-formats', array('link', 'quote', 'gallery', 'video', 'image', 'audio', 'aside'));

        ## Register menu location
        register_nav_menus(array(
            'primary' => 'Primary Location',
            'left' => 'Left Menu',
            'mobile' => 'Mobile Location',
            'footermenu' => 'Footer Menu',
        ));
    }

}

add_action('after_setup_theme', 'ppo_theme_setup');
/* ----------------------------------------------------------------------------------- */
# Widgets init
/* ----------------------------------------------------------------------------------- */
if (!function_exists("ppo_widgets_init")) {

    // Register Sidebar
    function ppo_widgets_init() {
        register_sidebar(array(
            'id' => 'sidebar',
            'name' => __('Sidebar'),
            'before_widget' => '<section class="widget">',
            'after_widget' => '</section>',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
        ));
        register_sidebar(array(
            'id' => 'footersidebar',
            'name' => __('Footer Sidebar'),
            'before_widget' => '<section class="widget">',
            'after_widget' => '</section>',
            'before_title' => '<div class="widget-title">',
            'after_title' => '</div>',
        ));
    }

    // Register widgets
    register_widget('Ads_Widget');
   // register_widget('Category_Product_Grid_Widget');
    //register_widget('List_Category_Widget');
    //register_widget('Latest_Posts_Widget');
}

add_action('widgets_init', 'ppo_widgets_init');

/* ----------------------------------------------------------------------------------- */
# Unset size of post thumbnails
/* ----------------------------------------------------------------------------------- */

function ppo_filter_image_sizes($sizes) {
    unset($sizes['thumbnail']);
    unset($sizes['medium']);
    unset($sizes['large']);

    return $sizes;
}

add_filter('intermediate_image_sizes_advanced', 'ppo_filter_image_sizes');
/*
  function ppo_custom_image_sizes($sizes){
  $myimgsizes = array(
  "image-in-post" => __("Image in Post"),
  "full" => __("Original size")
  );

  return $myimgsizes;
  }

  add_filter('image_size_names_choose', 'ppo_custom_image_sizes');
 */
/* ----------------------------------------------------------------------------------- */
# User login
/* ----------------------------------------------------------------------------------- */
add_action('init', 'redirect_after_logout');

function redirect_after_logout() {
    if (preg_match('#(wp-login.php)?(loggedout=true)#', $_SERVER['REQUEST_URI']))
        wp_redirect(home_url());
}

//PPO Feed all post type

function ppo_feed_request($qv) {
    if (isset($qv['feed']))
        $qv['post_type'] = get_post_types();
    return $qv;
}

add_filter('request', 'ppo_feed_request');

function remove_admin_bar() {
    if (!current_user_can('administrator') && !current_user_can('editor') && !is_admin()) {
        show_admin_bar(false);
    }
}

add_action('after_setup_theme', 'remove_admin_bar');

function getLocale() {
    $locale = "vn";
    if (get_query_var("lang") != null) {
        $locale = get_query_var("lang");
    } else if (function_exists("qtrans_getLanguage")) {
        $locale = qtrans_getLanguage();
    }
    if ($locale == "vi") {
        $locale = "vn";
    }
    return $locale;
}
/* ----------------------------------------------------------------------------------- */
# Custom search
/* ----------------------------------------------------------------------------------- */
add_action('pre_get_posts', 'custom_search_filter');

function custom_search_filter($query) {
    if (!is_admin() && $query->is_main_query()) {
        $post_type = 'product';
        $products_per_page = intval(get_option(SHORT_NAME . "_product_pager"));
        if ($query->is_home or $query->is_search) {
            $query->set('post_type', $post_type);
            $query->set('posts_per_page', $products_per_page);
        }
    }
    return $query;
}
function get_history_order() {
    global $wpdb, $current_user;
    get_currentuserinfo();
    $records = array();
    if (is_user_logged_in()) {
        $tblOrders = $wpdb->prefix . 'orders';
        $query = "SELECT $tblOrders.*, $wpdb->users.display_name, $wpdb->users.user_email FROM $tblOrders 
            JOIN $wpdb->users ON $wpdb->users.ID = $tblOrders.customer_id 
            WHERE $tblOrders.customer_id = $current_user->ID ORDER BY $tblOrders.ID DESC";
        $records = $wpdb->get_results($query);
    }
    return $records;
}