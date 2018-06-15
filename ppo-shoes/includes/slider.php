<?php
/* ----------------------------------------------------------------------------------- */
# Create post_type
/* ----------------------------------------------------------------------------------- */
add_action('init', 'create_slider_post_type');

function create_slider_post_type() {
    $args = array(
        'labels' => array(
            'name' => __('Sliders'),
            'singular_name' => __('Sliders'),
            'add_new' => __('Add new'),
            'add_new_item' => __('Add new Slider'),
            'new_item' => __('New Slider'),
            'edit' => __('Edit'),
            'edit_item' => __('Edit Slider'),
            'view' => __('View Slider'),
            'view_item' => __('View Slider'),
            'search_items' => __('Search Sliders'),
            'not_found' => __('No Slider found'),
            'not_found_in_trash' => __('No Slider found in trash'),
        ),
        'public' => false,
        'show_ui' => true,
        'publicy_queryable' => true,
        'exclude_from_search' => true,
        'menu_position' => 5,
        'hierarchical' => false,
        'query_var' => true,
        'supports' => array(
            'title',
        ),
        'rewrite' => array('slug' => 'slider', 'with_front' => false),
        'can_export' => true,
        'description' => __('Slider description here.')
    );

    register_post_type('slider', $args);
}

/* ----------------------------------------------------------------------------------- */
# Create taxonomy
/* ----------------------------------------------------------------------------------- */
/* add_action('init', 'create_slider_taxonomies');

  function create_slider_taxonomies(){
  register_taxonomy('slider_category', 'slider', array(
  'hierarchical' => true,
  'labels' => array(
  'name' => __('Slider Categories'),
  'singular_name' => __('Slider Categories'),
  'add_new' => __('Add New'),
  'add_new_item' => __('Add New Category'),
  'new_item' => __('New Category'),
  'search_items' => __('Search Categories'),
  ),
  ));
  } */
/* ----------------------------------------------------------------------------------- */
# Meta box
/* ----------------------------------------------------------------------------------- */
$posts = new WP_Query(array(
            'post_type' => array('post', 'page', 'product'),
            'posts_per_page' => -1,
        ));
$catList = array();
while ($posts->have_posts()) : $posts->the_post();
    $catList[get_the_ID()] = get_the_title();
endwhile;
$slider_meta_box = array(
    'id' => 'slider-meta-box',
    'title' => 'Thông tin',
    'page' => 'slider',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Hình ảnh',
            'desc' => 'Có thể điền URL ảnh hoặc chọn ảnh từ thư viện. Size: 1200x400',
            'id' => 'slide_img',
            'type' => 'text',
            'std' => '',
            'btn' => 'slide_img',
        ),
        array(
            'name' => 'Liên kết',
            'desc' => '',
            'id' => 'slide_link',
            'type' => 'text',
            'std' => '',
        ),
        array(
            'name' => 'Sắp xếp',
            'desc' => '',
            'id' => 'order_item',
            'type' => 'text',
            'std' => '1',
        ),
));
// Add slider meta box
if (is_admin()) {
    add_action('admin_menu', 'slider_add_box');
    add_action('save_post', 'slider_add_box');
    add_action('save_post', 'slider_save_data');
}

/**
 * Add meta box
 * @global array $slider_meta_box
 */
function slider_add_box() {
    global $slider_meta_box;
    add_meta_box($slider_meta_box['id'], $slider_meta_box['title'], 'slider_show_box', $slider_meta_box['page'], $slider_meta_box['context'], $slider_meta_box['priority']);
}

/**
 * Callback function to show fields in slider meta box
 * @global array $slider_meta_box
 * @global Object $post
 */
function slider_show_box() {
    // Use nonce for verification
    global $slider_meta_box, $post;
    custom_output_meta_box($slider_meta_box, $post);
}
/**
 * Save data from slider meta box
 * @global array $slider_meta_box
 * @param int $post_id
 * @return 
 */
function slider_save_data($post_id) {
    global $slider_meta_box;
    custom_save_meta_box($slider_meta_box, $post_id);
    
}

function custom_admin_js() {
    $url = get_option('siteurl');
    $url = get_bloginfo('template_directory') . '/js/adminjs/chosen.jquery.min.js';
    echo "<script type=\"text/javascript\" src=\"$url\"></script>";
}

function custom_admin_css() {
    $url = get_option('siteurl');
    $url = get_bloginfo('template_directory') . '/css/chosen.min.css';
    echo "<link rel=\"stylesheet\" href=\"$url\" type=\"text/css\" />";
}

add_action('admin_footer', 'custom_admin_js');
add_action('admin_head', 'custom_admin_css');