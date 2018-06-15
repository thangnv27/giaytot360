<?php get_header(); ?>
<div class="main container">
    <?php while (have_posts()) : the_post(); ?>
    <div class="breadcrumbs">
        <?php
        if (function_exists('bcn_display')) {
            bcn_display();
        }
        ?>
    </div>
    <div class="main-content">
        <div class="page-title">
            <h1><?php the_title()?></h1>
        </div>
        <div class="std">
            <?php the_content();?>
        </div>
    </div>
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>