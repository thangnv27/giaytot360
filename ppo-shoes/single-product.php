<?php get_header(); ?>
<div class="main container">
    <?php while (have_posts()) : the_post(); ?>
    <div class="main-content">
        <div class="breadcrumbs">
            <?php
            if (function_exists('bcn_display')) {
                bcn_display();
            }
            ?>
        </div>
        <div class="product-view product-details row">
            <div class="details col-md-9">
                <div class="media">
                    <div class="product-lemmon">
                        <div class="more-views">
                            <ul class="gallery">
                                <?php
                                $args = array(
                                    'post_type' => 'attachment',
                                    'numberposts' => -1,
                                    'post_status' => null,
                                    'post_parent' => $post->ID,
                                    'orderby' => 'menu_order',
                                    'order' => 'ASC'
                                );

                                $attachments = get_posts($args);
                                if ($attachments) {
                                    foreach ($attachments as $attachment) {
                                        $img = wp_get_attachment_image_src($attachment->ID, 'full');
                                        ?>
                                        <li>
                                            <a onclick="return false;" href="<?php echo $img[0]; ?>">
                                                <img src="<?php echo $img[0]; ?>">
                                            </a>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="btn-control">
                            <div class="prev"><span></span></div>
                            <div class="next"><span></span></div>
                        </div>
                    </div> 
                    <div class="product-image"><img src="<?php get_image_url(); ?>" alt="<?php the_title();?>" title="<?php the_title();?>" /></div>
                </div>
                <div class="hidden-lg hidden-md">
                    <div class="price-box pdt15">
                        <span class="regular-price">
                            <span class="price"><?php echo number_format(floatval(get_post_meta(get_the_ID(), "gia_moi", true)), 0, ',', '.'); ?> ₫</span>                                    
                        </span>
                    </div>
                    <div class="button-sets">
                        <div class="quantity">
                            Số lượng: <select id="qty2" name="quantity" style="width: 80px;">
                                <?php
                                $tinh_trang = get_post_meta(get_the_ID(), "tinh_trang", true);
                                $maxQuantity = intval(get_option(SHORT_NAME . '_maxQuantity'));
                                for ($i = 1; $i <= $maxQuantity; $i++) {
                                    echo "<option value=\"{$i}\">{$i}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <?php if (in_array($tinh_trang, array("Sắp có hàng", "Còn hàng"))): ?>
                        <button type="button" title="Mua ngay" class="button btn-cart" onclick="AjaxCart.addToCart(<?php the_ID(); ?>, '<?php get_image_url(); ?>', '<?php the_title(); ?>', <?php echo get_post_meta(get_the_ID(), "gia_moi", true); ?>, document.getElementById('qty2').value, '');"><span>Mua ngay</span></button>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="box box-description">
                    <h3>Chi tiết sản phẩm</h3>
                    <div class="std">
                        <h1 class="product-name" style="text-align: center;">
                            <a title="<?php the_title(); ?>" href="<?php the_permalink();?>" style="color: #c61c22;"><?php the_title();?></a>
                        </h1>
                        <?php the_content();?> 
                    </div>
                </div><!-- end .box-description-->
                <div class="crossell box">
                    <h3>Có thể bạn sẽ thích</h3>
                    <div class="grid row">
                        <?php
                        $taxonomy = 'product_category';
                        $terms = get_the_terms(get_the_ID(), $taxonomy);
                        $terms_id = array();
                        foreach ($terms as $term) {
                            array_push($terms_id, $term->term_id);
                        }
                        if(is_array($terms)):
                            $loop = new WP_Query(array(
                                'post_type' => 'product',
                                'posts_per_page' => 3,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => $taxonomy,
                                        'field' => 'id',
                                        'terms' => $terms_id,
                                    )
                                ),
                                'post__not_in' => array(get_the_ID()),
                            ));
                            while ($loop->have_posts()) : $loop->the_post();
                                get_template_part('template/product-item');
                            endwhile;
                            wp_reset_query();
                        endif;
                        ?>
                    </div>
                </div>
                
                <div class="fb-comments" data-href="<?php the_permalink(); ?>" data-width="100%" data-numposts="5"></div>
            </div><!-- end .left-->
            <div class="box-right col-md-3">
                <div class="hidden-sm hidden-xs">
                    <div class="overview">
                        <?php echo get_post_meta(get_the_ID(), "product_short", true);?>
                    </div>
                    <div class="price-box">
                        <span class="regular-price">
                            <span class="price"><?php echo number_format(floatval(get_post_meta(get_the_ID(), "gia_moi", true)), 0, ',', '.'); ?> ₫</span>                                    
                        </span>
                    </div>
                    <div class="button-sets">
                        <div class="quantity">
                            Số lượng: <select id="qty1" name="quantity" style="width: 80px;">
                                <?php
                                $tinh_trang = get_post_meta(get_the_ID(), "tinh_trang", true);
                                $maxQuantity = intval(get_option(SHORT_NAME . '_maxQuantity'));
                                for ($i = 1; $i <= $maxQuantity; $i++) {
                                    echo "<option value=\"{$i}\">{$i}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <?php if (in_array($tinh_trang, array("Sắp có hàng", "Còn hàng"))): ?>
                        <button type="button" title="Mua ngay" class="button btn-cart" onclick="AjaxCart.addToCart(<?php the_ID(); ?>, '<?php get_image_url(); ?>', '<?php the_title(); ?>', <?php echo get_post_meta(get_the_ID(), "gia_moi", true); ?>, document.getElementById('qty1').value, '');"><span>Mua ngay</span></button>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Huong dan -->
                <ul class="toturial hidden-sm hidden-xs">
                    <li><p class="phone-number">Gọi <strong>096 4747 046</strong><br/>để mua hàng nhanh nhất</p></li>
                    <li id="box-1">
                        <p class="freeship">
                            <a href="javascript:void(0)" onclick="showbox(1);"><strong>Miễn phí giao hàng </strong>toàn quốc</a>
                        </p>
                        <div class="content content-1" style="display: none;">
                            <p>
                                <span>- Miễn phí giao hàng quốc</span><br />
                                <span>- Thử giày tại nhà với khách hàng tại nội thành Hà Nội</span><br />
                                <span>- Thanh toán khi nhận hàng (COD) áp dụng từ tuyến huyện trở lên.</span>
                            </p>
                        </div>
                    </li>
                    <li id="box-2">
                        <p class="hd">
                            <a href="javascript:void(0)" onclick="showbox(2);"><strong>Hướng dẫn </strong>mua hàng</a>
                        </p>
                    <div class="content content-2"style="display: none;">
                        <p>
                            <span>- Nhấn nút "Mua ngay", kiểm tra lại giỏ hàng và nhấn nút "Tiến hành thanh toán".</span><br />
                            <span>- Nhập đầy đủ thông tin liên hệ, chọn hình thức thanh toán và giao hàng phù hợp.  </span><br />
                            <span>- Điền mã số khuyến mại (nếu có) và ấn nút "Hoàn tất"  </span><br />
                            <span>PPO shoes sẽ liên hệ lại với bạn ngay để giao hàng. . </span>
                        </p>
                    </div>
                    </li>
                    <li id="box-3" >
                        <p class="money-back"><a href="javascript:void(0)" onclick="showbox(3);"><strong>Trả lại hàng trong 365 ngày</strong><br/>hoàn tiền 100%</a></p>
                        <div class="content content-3"style="display: none;">
                            <p>
                                <span>Áp dụng với điều kiện: </span><br />
                                <span>- Sản phẩm chưa qua sử dụng, còn nguyên nhãn mác, hóa đơn mua hàng. </span><br />
                                <span>- Thời gian mua chưa quá 365 ngày. </span>
                            </p>
                        </div>
                    </li>
                </ul>
                
                <h2 class="title newp">Hàng mới về</h2>
                <ul style="margin: 0;padding: 0">
                    <?php
                    $loop = new WP_Query(array(
                        'post_type' => 'product',
                        'posts_per_page' => 4
                    ));
                    $counter = 0;
                    while ($loop->have_posts()) : $loop->the_post();
                    ?>
                    <li class="item">
                        <div class="product-image">
                            <a href="<?php the_permalink();?>" title="<?php the_title(); ?>" >
                                <img src="<?php get_image_url(true, '218x144'); ?>" alt="<?php the_title(); ?>" />
                            </a>
                        </div>
                        <h3 class="product-name"><a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>              
                        <div class="price-box">
                            <span class="special-price">
                                <span class="price"><?php echo number_format(floatval(get_post_meta(get_the_ID(), "gia_moi", true)), 0, ',', '.'); ?> ₫</span>
                            </span>
                        </div>
                    </li>
                    <?php
                    endwhile;
                    wp_reset_query();
                    ?>
                </ul>
            </div><!-- end .box-right-->
        </div><!-- end .product-details-->
        <?php endwhile;?>
    </div>
</div>
<?php get_footer(); ?>