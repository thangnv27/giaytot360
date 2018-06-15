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
            <div class="list-entry">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="entry_item">
                        <div class="entry">
                            <div class="thumb">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <img src="<?php get_image_url(); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
                                </a>
                            </div>
                            <div class="short_new">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <h3 class="entry-title"><?php the_title(); ?></h3>
                                </a>
                                <div class="entry-caption"><?php echo get_short_content(get_the_content(), 95); ?></div>
                                <div class="entry-date">
                                    <?php the_time('d/m/Y H:i:s'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="toolbar-bottom">
                <div class="toolbar">
                    <?php getpagenavi();?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>