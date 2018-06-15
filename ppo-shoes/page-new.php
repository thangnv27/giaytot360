<?php
/*
  Template Name: New Products
 */
get_header(); ?>
<div class="main container">
    <div class="breadcrumbs">
        <?php
        if (function_exists('bcn_display')) {
            bcn_display();
        }
        ?>
    </div>
    <div class="main-content row">
        <div class="left-sidebar col-md-3 hidden-sm hidden-xs">
            <div class="left-navigation">
                <h2>Danh mục</h2>
                <?php
                wp_nav_menu(array(
                    'container' => '',
                    'theme_location' => 'left',
                    'menu_class' => '',
                    'menu_id' => '',
                ));
                ?>	
            </div>
        </div><!-- end .left-navigation -->
        <div class="categories col-md-9">
            <h1>Sản phẩm mới nhất</h1>		
            <div class="product-grid">
                <div class="row grid">
                <?php
                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                $products_per_page = intval(get_option(SHORT_NAME . "_product_pager"));
                $loop = new WP_Query(array(
                    'post_type' => 'product',
                    'posts_per_page' => $products_per_page,
                    'paged'=> $paged,
                ));
                while ($loop->have_posts()) : $loop->the_post();
                    get_template_part('template/product-item');
                endwhile;
                wp_reset_query();
                ?>
                </div>
            </div>
            <div class="toolbar-bottom">
                <div class="toolbar">
                    <?php getpagenavi(array('query' => $loop)); ?>
                </div>
            </div>
        </div><!-- end .categories-->
    </div>
</div>
<?php get_footer(); ?>