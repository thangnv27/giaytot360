<?php get_header(); ?>
<div class="main container">
    <div class="home-top row hidden-xs">
        <div class="left-navigation col-md-3 col-sm-3">
            <h2>Giầy nam</h2>
            <?php
            wp_nav_menu(array(
                'container' => '',
                'theme_location' => 'left',
                'menu_class' => '',
                'menu_id' => '',
            ));
            ?>	
        </div><!-- end .left-navigation-->
        <?php
        $loop = new WP_Query(array(
            'post_type' => 'slider',
            'orderby' => 'id',
            'order' => 'ASC',
            'posts_per_page' => -1,
        ));
        if ($loop->post_count > 0) :
            ?>
            <div class="slider-container col-md-6 col-sm-9">
                <div id="banner-fade">
                    <ul class="bjqs">
                    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                        <li>
                            <a href="<?php echo get_post_meta(get_the_ID(), "slide_link", true); ?>" title="<?php the_title(); ?>" target="_blank">
                                <img src="<?php echo get_post_meta(get_the_ID(), "slide_img", true); ?>" alt="<?php the_title(); ?>"/>
                            </a>
                        </li>
                    <?php endwhile; ?>
                    </ul>
                </div>
            </div>
            <?php
        endif;
        wp_reset_query();
        ?>
        <!--END: Slider Top-->
        <div class="banner-right col-md-3 hidden-sm">
            <?php echo stripslashes(get_option('bannerright1')); ?>
            <?php echo stripslashes(get_option('bannerright2')); ?>
        </div>
    </div><!-- end .home-top-->
    
    <div class="features-container row">
        <div class="col-md-4 hidden-xs banner-category">
            <h2><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/banner-giay-2.jpg"/></a></h2>
        </div>
        <div class="features col-md-8">
            <div class="title">Sản Phẩm Giảm Giá<a class="view-all" href="<?php echo get_page_link(get_option(SHORT_NAME . "_pagesaleoffID"));?>"><span>Xem tất cả</span></a></div>
            <div class="product-grid"> 
                <div class='row grid'>
                    <?php
                    $loop = new WP_Query(array(
                        'post_type' => 'product',
                        'meta_query' => array(
                            array(
                                'key' => 'discount',
                                'value' => '0',
                                'compare' => '>'
                            ),
                        ),
                        'posts_per_page' => 6,
                    ));
                    while ($loop->have_posts()) : $loop->the_post();
                        get_template_part('template/product-item');
                    endwhile;
                    wp_reset_query();
                    ?>  
                </div>
            </div>
        </div>	
    </div><!-- end .features-container -->
    <div class="new-container row">
        <div class="new-products col-md-8">
            <div class="title">SẢN PHẨM MỚI NHẤT<a class="view-all" href="<?php echo get_page_link(get_option(SHORT_NAME . "_pageNewProductID"));?>"><span>Xem tất cả</span></a></div>
            <div class="product-grid"> 
                <div class='row grid'>
                    <?php
                    $loop = new WP_Query(array(
                        'post_type' => 'product',
                        'posts_per_page' => 6
                    ));
                    while ($loop->have_posts()) : $loop->the_post();
                        get_template_part('template/product-item');
                    endwhile;
                    wp_reset_query();
                    ?> 
                </div>
            </div> 
        </div><!end new product--> 
        <div class="col-md-4 hidden-xs banner-category">
            <h2><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/giay-tay.jpg"/></a></h2>
        </div>  
    </div><!-- end .new-container -->
    <div class="update-container row">
        <div class="col-md-4 hidden-xs banner-category">
            <h2><a href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/giay-nao-duoc-yeu-thich.jpg"/></a></h2>
        </div>
        <div class="update-products col-md-8">
            <div class="title">SẢN PHẨM BÁN CHẠY NHẤT<a class="view-all" href="<?php echo get_page_link(get_option(SHORT_NAME . "_pagesellID"));?>"><span>Xem tất cả</span></a></div>
            <div class="product-grid"> 
                <div class='row grid'>
                    <?php
                    $loop = new WP_Query(array(
                        'post_type' => 'product',
                        'orderby' => 'meta_value_num',
                        'meta_key' => 'purchases',
                        'posts_per_page' => 6
                    ));
                    while ($loop->have_posts()) : $loop->the_post();
                        get_template_part('template/product-item');
                    endwhile;
                    wp_reset_query();
                    ?> 
                </div>
            </div> 
        </div><!--end .update-products-->
    </div><!-- end .update-container -->  
    <p class="link-all"><a href="<?php echo get_page_link(get_option(SHORT_NAME . "_pageNewProductID"));?>">Xem thêm hàng trăm sản phẩm</a></p>
</div>
<?php get_footer(); ?>