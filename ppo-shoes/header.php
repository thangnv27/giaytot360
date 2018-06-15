<?php include_once 'libs/bbit-compress.php';  ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>> <!--<![endif]-->
    <head>
        <meta http-equiv="Cache-control" content="no-store; no-cache"/>
        <meta http-equiv="Pragma" content="no-cache"/>
        <meta http-equiv="Expires" content="0"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" />
        <title><?php wp_title('|', true, 'right'); ?></title>
        <meta name="author" content="ppo.vn" />
        <meta name="robots" content="index, follow" /> 
        <meta name="googlebot" content="index, follow" />
        <meta name="bingbot" content="index, follow" />
        <meta name="geo.region" content="VN" />
        <meta name="geo.position" content="14.058324;108.277199" />
        <meta name="ICBM" content="14.058324, 108.277199" />
        <meta property="fb:app_id" content="<?php echo get_option(SHORT_NAME . "_appFBID"); ?>" />

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="keywords" content="<?php echo get_option('keywords_meta') ?>" />

        <link rel="publisher" href="https://plus.google.com/+ThịnhNgô"/>

        <link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />        
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <link href="<?php bloginfo('stylesheet_directory'); ?>/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/font-awesome.min.css"/>
        <link href="<?php bloginfo('stylesheet_directory'); ?>/css/normalize.css" rel="stylesheet" />
        <link href="<?php bloginfo('stylesheet_directory'); ?>/css/wireframe.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
        <link href="<?php bloginfo('stylesheet_directory'); ?>/css/media.css" rel="stylesheet" />
        <link href="<?php bloginfo('stylesheet_directory'); ?>/css/custom.css" rel="stylesheet" />

        <link href="<?php bloginfo('stylesheet_directory'); ?>/css/common.css" rel="stylesheet" /> 
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/start/jquery-ui.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/colorbox/colorbox.css" />
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_directory'); ?>/css/jquery.mCustomScrollbar.min.css" />
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
            var siteUrl = "<?php bloginfo('siteurl'); ?>";
            var themeUrl = "<?php bloginfo('stylesheet_directory'); ?>";
            var is_home = <?php echo is_home() ? 'true' : 'false'; ?>;
            var no_image_src = themeUrl + "/images/no_image_available.jpg";
            var ajaxurl = '<?php echo admin_url('admin-ajax.php') ?>';
            var cartUrl = "<?php echo get_page_link(get_option(SHORT_NAME . "_pageCartID")); ?>";
            var checkoutUrl = "<?php echo get_page_link(get_option(SHORT_NAME . "_pageCheckoutID")); ?>";
            var lang = "<?php echo getLocale(); ?>";
        </script>
        <script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/modernizr.js"></script>

        <?php
        if (is_singular())
            wp_enqueue_script('comment-reply');

        wp_head();
        ?>
    </head>
    <body>
        <div id="ajax_loading" style="display: none;z-index: 99999" class="ajax-loading-block-window">
            <div class="loading-image"></div>
        </div>
        <!--Alert Message-->
        <div id="nNote" class="nNote" style="display: none;"></div>
        <!--END: Alert Message-->  
        <div class="toplinks-container">
            <div class="toplinks container">
                <ul>
                    <li class="first"><span>Hotline: <strong><?php echo get_option(SHORT_NAME . "_hotline"); ?></strong></span></li>
                    <li class="money-back hidden-xs">
                        <p>Trả lại hàng trong <strong>365</strong> ngày <span>hoàn tiền 100%</span></p>
                    </li>
                    <li class="free-ship hidden-xs">
                        <p><strong>Miễn phí</strong> giao hàng<span> toàn quốc</span></p>
                    </li>
                    <li class="warranty hidden-xs">
                        <p>Bảo hành <strong>trọn đời</strong></p>
                    </li>
                    <?php
                    if(is_user_logged_in()):
                    ?>
                    <li class="money-back hidden-xs">
                        <p><a href="<?php echo get_page_link(get_option(SHORT_NAME . "_pageHistoryOrder")); ?>" title="Lịch sử mua hàng">Lịch sử mua hàng</a></p>
                    </li>
                    <?php endif; ?>
                </ul>        
            </div>
        </div>
        <div id="page" class="header container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <h1 class="logo">
                        <a href="<?php bloginfo('siteurl'); ?>"><img src="<?php echo get_option('sitelogo'); ?>" title="<?php bloginfo('sitename'); ?>" alt="<?php bloginfo('sitename'); ?>" /></a>
                    </h1>
                </div>
                <!--<div class="clearfix"></div>-->
                <div class="col-md-7 col-sm-7 col-xs-9 quick-access">
                    <form id="search_mini_form " role="search" method="get" action="<?php bloginfo('siteurl'); ?>">
                        <div class="form-search">
                            <!--label for="search">Search:</label-->
                            <input id="search" type="text" name="s" placeholder="Tìm kiếm trên 5000 sản phẩm" value="" class="input-text search" maxlength="128" />
                            <button type="submit" title="Tìm" class="button search"><span>Tìm</span></button>
                        </div>
                    </form>
                </div> 
                <div class="col-md-2 col-sm-2 col-xs-3">
                    <div class="box-cart has_item">
                        <a href="<?php echo get_page_link(get_option(SHORT_NAME . "_pageCartID")); ?>" style="padding:10px 15px;color:#fff;text-decoration:none;" class="cart-count">
                            <?php
                            if (isset($_SESSION['cart']) and ! empty($_SESSION['cart'])) {
                                $cart = $_SESSION['cart'];
                                echo count($cart);
                            } else {
                                echo "0";
                            }
                            ?>     
                        </a>
                    </div>
                </div>
            </div>  
        </div>
        <div class="header-main">
            <nav id="navigation" class="wf-td container">
                <?php
                wp_nav_menu(array(
                    'container' => '',
                    'theme_location' => 'primary',
                    'menu_class' => 'fancy-rollovers wf-mobile-hidden',
                    'menu_id' => 'main-nav',
                ));
                ?>
                <a href="#show-menu" rel="nofollow" id="mobile-menu">
                    <span class="menu-open">MENU</span>
                    <span class="menu-close">CLOSE</span>
                    <span class="menu-back">quay lại</span>
                    <span class="wf-phone-visible">&nbsp;</span>
                </a>
            </nav>
        </div>
            

