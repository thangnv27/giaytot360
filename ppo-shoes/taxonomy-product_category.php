<?php get_header(); ?>
<div class="main container">
    <div class="breadcrumbs breadcrums">
        <ol class="breadcrumbs wf-td text-small">
            <?php
            if (function_exists('bcn_display')) {
                bcn_display();
            }
            ?>
        </ol>
    </div>
    <div class="top-banner">
        <img src="<?php if (function_exists('z_taxonomy_image_url')) { echo z_taxonomy_image_url(); } ?>" alt="<?php single_cat_title(); ?>" />
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
                <div class="block color-filter">
                    <h2>Màu sắc</h2>
                    <div id="content-md">
                        <ol>
                            <?php
                            $product_category = 'product_category';
                            $term = get_queried_object();
                            $product_color = 'product_color';
                            $colors = get_categories(array(
                                'title_li' => '',
                                'show_option_none' => '',
                                'taxonomy' => $product_color,
                                'parent' => '0',
                                'hide_empty' => 0,
                                'show_count' => 1,
                            ));
                            foreach ($colors as $color):
                                ?>
                                <li><a href="<?php echo get_term_link($term, $product_category); ?>?color=<?php echo $color->term_id; ?>"><?php echo $color->name; ?></a></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
                <div class="block color-filter">
                    <h2>Size</h2>
                    <div id="content-size">
                        <ol>
                            <?php
                            $product_size = 'product_size';
                            $sizes = get_categories(array(
                                'title_li' => '',
                                'show_option_none' => '',
                                'taxonomy' => $product_size,
                                'parent' => '0',
                                'hide_empty' => 0,
                                'show_count' => 1,
                            ));
                            foreach ($sizes as $size):
                                ?>
                                <li><a href="<?php echo get_term_link($term, $product_category); ?>?size=<?php echo $size->term_id; ?>"><?php echo $size->name; ?></a></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
                <div class="block color-filter">
                    <h2>Thương hiệu</h2>
                    <div id="content-brand">
                        <ol>
                            <?php
                            $product_brand = 'product_brand';
                            $brands = get_categories(array(
                                'title_li' => '',
                                'show_option_none' => '',
                                'taxonomy' => $product_brand,
                                'parent' => '0',
                                'hide_empty' => 0,
                                'show_count' => 1,
                            ));
                            foreach ($brands as $brand):
                                ?>
                                <li><a href="<?php echo get_term_link($term, $product_category); ?>?brand=<?php echo $brand->term_id; ?>"><?php echo $brand->name; ?></a></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
                <div class="block color-filter">
                    <h2>Chất liệu</h2>
                    <div id="content-material">
                        <ol>
                            <?php
                            $product_material = 'product_material';
                            $materials = get_categories(array(
                                'title_li' => '',
                                'show_option_none' => '',
                                'taxonomy' => $product_material,
                                'parent' => '0',
                                'hide_empty' => 0,
                                'show_count' => 1,
                            ));
                            foreach ($materials as $material):
                                ?>
                                <li><a href="<?php echo get_term_link($term, $product_category); ?>?material=<?php echo $material->term_id; ?>"><?php echo $material->name; ?></a></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
                <div class="block color-filter">
                    <h2>Kiểu dáng</h2>
                    <div id="content-type">
                        <ol>
                            <?php
                            $product_type = 'product_type';
                            $types = get_categories(array(
                                'title_li' => '',
                                'show_option_none' => '',
                                'taxonomy' => $product_type,
                                'parent' => '0',
                                'hide_empty' => 0,
                                'show_count' => 1,
                            ));
                            foreach ($types as $type):
                                ?>
                                <li><a href="<?php echo get_term_link($term, $product_category); ?>?type=<?php echo $type->term_id; ?>"><?php echo $type->name; ?></a></li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
            </div>
        </div><!-- end .left-navigation -->
        <div class="categories col-md-9">
            <div class="category-title">
                <h1><?php single_cat_title(); ?></h1>			
                <div class="category-des">
                    <?php echo category_description(); ?>				
                </div>
            </div>
            <div class="product-grid">
                <?php
                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                $products_per_page = intval(get_option(SHORT_NAME . "_product_pager"));
                $color = (getRequest('color')) ? getRequest('color') : '';
                $size = (getRequest('size')) ? getRequest('size') : '';
                $brand = (getRequest('brand')) ? getRequest('brand') : '';
                $material = (getRequest('material')) ? getRequest('material') : '';
                $type = (getRequest('type')) ? getRequest('type') : '';
                $args = array(
                    'post_type' => 'product',
                    'paged'=> $paged,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_category',
                            'field' => 'id',
                            'terms' => $term->term_id,
                        ),
                    ),
                    'posts_per_page' => $products_per_page
                );
                if ($color != "") {
                    array_push($args['tax_query'], array(
                        'taxonomy' => 'product_color',
                        'field' => 'id',
                        'terms' => $color,
                    ));
                } elseif ($size != "") {
                    array_push($args['tax_query'], array(
                        'taxonomy' => 'product_size',
                        'field' => 'id',
                        'terms' => $size,
                    ));
                } elseif ($brand != "") {
                    array_push($args['tax_query'], array(
                        'taxonomy' => 'product_brand',
                        'field' => 'id',
                        'terms' => $brand,
                    ));
                } elseif ($material != "") {
                    array_push($args['tax_query'], array(
                        'taxonomy' => 'product_brand',
                        'field' => 'id',
                        'terms' => $material,
                    ));
                } elseif (!empty($type)) {
                    array_push($args['tax_query'], array(
                        'taxonomy' => 'product_brand',
                        'field' => 'id',
                        'terms' => $type,
                    ));
                }
                $loop = new WP_Query($args);
                ?>
                <div class="row grid">
                <?php
                while ($loop->have_posts()) : $loop->the_post();     
                    get_template_part('template/product-item');
                endwhile;
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