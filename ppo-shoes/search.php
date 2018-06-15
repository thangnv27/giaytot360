<?php get_header(); ?>
<div class="main container">
    <div class="breadcrumbs">
        <?php
        if (function_exists('bcn_display')) {
            bcn_display();
        }
        ?>
    </div>
    <div class="main-content row">
        <div class="left-sidebar col-md-3 hidden-xs">
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
            <h1>Kết quả tìm kiếm: "<?php the_search_query(); ?>"</h1>			
            <div class="product-grid">
                <div class="row grid">
                <?php
                while (have_posts()) : the_post();
                    get_template_part('template/product-item');
                endwhile;
                ?>
                </div>
            </div>
            <div class="toolbar-bottom">
                <div class="toolbar">
                    <?php getpagenavi();?>
                </div>
            </div>
        </div><!-- end .categories-->
    </div>
</div>
<?php get_footer(); ?>