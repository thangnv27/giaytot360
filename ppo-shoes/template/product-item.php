<div class="item col-sm-4 col-xs-6">
    <div class="product-image">
        <a href="<?php the_permalink();?>" title="<?php the_title(); ?>" rel="bookmark">
            <img src="<?php get_image_url(true, '238x158'); ?>" alt="<?php the_title(); ?>" />
        </a>
    </div>
    <h2 class="product-name"><a href="<?php the_permalink();?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
    <div class="price-box">
        <p class="special-price">
            <span class="price"><?php echo number_format(floatval(get_post_meta(get_the_ID(), "gia_moi", true)), 0, ',', '.'); ?> ₫</span>
        </p>
        <?php
        $gia_cu = floatval(get_post_meta(get_the_ID(), "gia_cu", true));
        if($gia_cu > 0):
        ?>
        <p class="old-price">
            <span class="price"><?php echo number_format($gia_cu, 0, ',', '.'); ?> ₫</span>
        </p>
        <?php endif; ?>
    </div>
</div>