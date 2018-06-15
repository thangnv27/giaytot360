    <div class="footer-container">
        <div class="footer-top">
            <div class="footer">
                <div class="left col-md-6">
                    <h3>Địa chỉ mua hàng</h3>
                    <div class="common-block">
                        <h4>Showroom 1</h4>
                        <p><?php echo get_option('info_address'); ?><br />Giờ làm việc: <?php echo get_option('info_hour'); ?><br /> ĐT: <?php echo get_option("info_tel"); ?></p>
                    </div>
                    <img alt="dang ky bo cong thuong" title="dang ky bo cong thuong" src="<?php echo get_stylesheet_directory_uri(); ?>/images/bocongthuong.png"/>
                    <img alt="ban quyen" title="ban quyen" src="<?php echo get_stylesheet_directory_uri(); ?>/images/secure.png">
                </div>
                <div class="right col-md-6">
                    <div class="support-sale">
                    <h3>Hỗ trợ mua hàng</h3>
                        <?php 
                            wp_nav_menu( array(
                                'container' => '',
                                'theme_location' => 'footermenu'
                            )); 
                        ?>  
                    </div>
                    <div class="connection">
                        <h3>Kết nối</h3>
                        <ul>
                            <?php
                            $fbURL = get_option(SHORT_NAME . "_fbURL");
                            $twitterURL = get_option(SHORT_NAME . "_twitterURL");
                            $googlePlusURL = get_option(SHORT_NAME . "_googlePlusURL");
                            $youtubeURL = get_option(SHORT_NAME . "_youtubeURL");
                            if(!empty($fbURL)):
                            ?>
                            <li><a href="<?php echo $fbURL; ?>" target="_blank"><img title="facebook " src="<?php echo get_stylesheet_directory_uri(); ?>/images/fb.png" alt="facebook" width="35" height="34" /></a></li>
                            <?php endif; ?>
                            <?php if (!empty($youtubeURL)): ?>
                            <li><a class="youtube" href="<?php echo $youtubeURL ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/youtube.png" alt="Twitter" width="35" height="34" /></a></li>
                            <?php endif; ?>
                            <?php if (!empty($twitterURL)): ?>
                            <li><a class="twt" href="<?php echo $twitterURL ?>" target="_blank"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/twt.png" alt="Twitter" /></a></li>
                            <?php endif; ?>
                            <?php if (!empty($googlePlusURL)): ?>
                            <li style="margin: 0;"><a title="Google Plus" href="<?php echo $googlePlusURL ?>"><img style="border-radius: 3px;" src="<?php echo get_stylesheet_directory_uri(); ?>/images/Google-Plus-Giaytot.png" alt="Google Plus " width="35" height="34" /></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- script references -->
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.bpopup.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/custom.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/bjqs-1.3.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/easy-slider.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.dlmenu.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/app.js"></script>
<?php wp_footer(); ?>
</body>
</html>