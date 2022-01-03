<?php get_header();?>

<?php //if (has_nav_menu('mainmenu')):
   // wp_nav_menu(array('theme_location' => 'mainmenu', 'container' => ''));
//endif; ?>

<!-- Banner Section  -->
<?php if (get_field('banner_status','option') == true): ?>
    <section class="home-devBanner">
        <div class="container">
            <div class="row row-small">
                <div class="col large-2">
                    <div class="home-vertical-menu">
                        <?php if (has_nav_menu('mega_menu')):
                            wp_nav_menu(array('theme_location' => 'mega_menu', 'container' => ''));
                        endif; ?>
                    </div>
                </div>
                <div class="col large-8">
                    <div class="swiper-container gallery-top">
                        <div class="swiper-wrapper">
                            <?php if (have_rows('banner_repeater','option')): while (have_rows('banner_repeater','option')) : the_row(); ?>
                                <div class="swiper-slide">
                                    <a href="<?php the_sub_field("link",'option'); ?>">
                                        <img src="<?php the_sub_field("image",'option'); ?>" alt="">
                                    </a>
                                </div>
                            <?php endwhile;else :endif;?>
                        </div>
                        <!-- <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div> -->
                    </div>
                    <div class="swiper-container gallery-thumbs">
                        <div class="swiper-wrapper">
                            <?php if (have_rows('banner_repeater','option')): while (have_rows('banner_repeater','option')) : the_row(); ?>
                                <div class="swiper-slide">
                                    <div class="text-center banner-text"> <?php the_sub_field("name",'option'); ?></div>
                                </div>
                            <?php endwhile;else :endif;?>
                        </div>
                        <!-- <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div> -->
                    </div>
                </div>
                <div class="col large-2">
                    <div class="right-banner row row-small">
                        <?php if (have_rows('right_banner','option')): while (have_rows('right_banner','option')) : the_row(); ?>
                            <div class="item col large-12 medium-4">
                                <a href="<?php the_sub_field("link",'option'); ?>">
                                    <img src="<?php the_sub_field("image",'option'); ?>" alt="">
                                    <div class="banner-text"><?php the_sub_field("name",'option'); ?> </div>
                                </a>
                            </div>
                        <?php endwhile;else :endif;?>
                    </div>
                </div>
            </div>
        </div>
        
       
    </section>
   
<?php endif;?>

<!-- Section Feature Product -->
<?php if (get_field('feature_product_status','option') == true): ?>
<section class="feature-home-section section-common">
    
    <div class="container " >
        <div class="feature-container" style="<?php the_field("fp_abkg","option"); ?>">
            <h3 class="text-center feature-title">Sản phẩm nổi bật </h3>
            <div class="feature-tab">
                <?php if (have_rows('feature_product_rp','option')): while (have_rows('feature_product_rp','option')) : the_row(); ?>
                    
                        <?php  $term = get_sub_field('name','option');
                        // var_dump($term);
                        if( $term ): ?>
                            <div class="<?php ?> common-tab active-tab" data-tab="<?php echo 'f-'.$term->slug; ?>"><?php echo $term->name; ?></div>
                        
                        <?php endif; ?>           
                    
                <?php endwhile;else :endif;?>
                
            </div>
            <div class="feature-content">
                <?php if (have_rows('feature_product_rp','option')): while (have_rows('feature_product_rp','option')) : the_row(); ?>
                    <div class="">
                        <?php  $term = get_sub_field('name','option');
                        // var_dump($term->term_id);
                        if( $term ): ?>
                            <div class="featureTab <?php echo 'f-'.$term->slug; ?>">
                                <?php echo do_shortcode( "[devFeatureProduct  cat=$term->term_id swiperid='feature']" )?>
                            </div>
                        <?php endif; ?>           
                    </div>
                <?php endwhile;else :endif;?>
            </div>
        </div>
    </div>
</section>
<?php endif;?>


<!-- Test shortcode taxonomy woocommerce -->
<!-- <section>
    <?php //echo do_shortcode('[products limit="4" columns="2" visibility="featured" ]' );?>
</section> -->


<!-- Section Tin khuyến mãi -->
<section class="saleNews-section section-common">
    <div class="container">
        <?php echo do_shortcode( '[devSaleNews title="Chương trình khuyến mãi" category_name="tin-khuyen-mai"]' )?>
    </div>
</section>
<!-- Section sản phẩm đã xem  -->
<section class="viewedProduct-section section-common">
    <div class="container">
        <?php echo do_shortcode( '[devViewedProduct text_sytle="text-left"]' )?>
    </div>
</section>

<!-- Section Sản phẩm test1  -->
<!-- <section class="devProduct-section section-common">
    <div class="container">
        <?php //echo do_shortcode( '[devProductHome title="Tôn Hoa Sen" cat=46 swiperid=1]' )?>
    </div>
</section> -->

<!-- Section Sản phẩm test2  -->
<!-- <section class="devProduct-section section-common">
    <div class="container">
        <?php //echo do_shortcode( '[devProductHome title="Sản phẩm gạch" cat=75 swiperid=2]' )?>
    </div>
</section> -->
<?php if (get_field('home_product_status','option') == true): ?>
    <section class="devProduct-section section-common">
        <div class="container">
            <?php //echo do_shortcode( '[devProductHome title="Sản phẩm gạch" cat=75 swiperid=2]' )?>
            <?php if (have_rows('home_product_rp','option')): while (have_rows('home_product_rp','option')) : the_row(); ?>
                <div class="feature-slide">
                    <?php  $termHome = get_sub_field('name','option');
                    // var_dump($termHome);
                    if( $termHome ): ?>
                        <?php echo do_shortcode( "[devProductHome title=$termHome->name cat=$termHome->term_id swiperid=1]" )?>
                    <?php endif; ?>           
                </div>
            <?php endwhile;else :endif;?>
        </div>
    </section> 
<?php endif;?>

<!-- Section Sản phẩm test2  -->
<section class="devProduct-section section-common">
    <div class="container">
   
    </div>
</section>

<!-- <div class="header-phone flex justify-content-center align-items-center">
    <div class="header-item">
        <a href="tel:012345678" class="flex">
            <span class="lnr lnr-phone-handset"></span>
            <div class="phone-right">
                <p>Gọi mua hàng</p>
                <p>012345678</p>
            </div>
        </a>
    </div>
    <div class="header-item">
        <a href="" class="flex">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44.22 25.85" height="24"><defs><style>.cls-1,.cls-2,.cls-3{fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;}.cls-1{stroke-width:1.66px;}.cls-2{stroke-width:1.66px;}.cls-3{stroke-width:1.8px;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><circle class="cls-1" cx="7.66" cy="22.02" r="3"></circle><circle class="cls-2" cx="24.79" cy="22.02" r="3"></circle><path class="cls-3" d="M28.61,22h4.13a1.44,1.44,0,0,0,1.44-1.44v-6"></path><path class="cls-3" d="M27.12.9H14.82a1.44,1.44,0,0,0-1.44,1.44V20.58A1.44,1.44,0,0,0,14.82,22h6.29"></path><path class="cls-3" d="M10.27,5.92H6.75A2.65,2.65,0,0,0,4.54,7.11L1.33,12A2.64,2.64,0,0,0,.9,13.47v6.46A2.1,2.1,0,0,0,3,22h.75"></path><path class="cls-3" d="M34.18,3.47V2.34A1.44,1.44,0,0,0,32.74.9H25.08"></path><line class="cls-3" x1="43.32" y1="6.97" x2="32.57" y2="6.97"></line><line class="cls-3" x1="40.5" y1="11.05" x2="32.57" y2="11.05"></line><line class="cls-3" x1="42.09" y1="16.33" x2="38.07" y2="16.33"></line></g></g></svg>
        
            <p>Tra cứu <br/>đơn hàng</p>
        </a>
  
    </div>
   <div class="header-item">

   </div>
</div> -->

<!-- <div class="header-login  ">
    <a href="http://vatlieu.local//login">
       <span class="lnr lnr-user"></span>
       <p>  Đăng nhập</p> 
    </a>
</div> -->
<!-- <img src="https://goo.gl/maps/wFwhuQNvsB2QeEg16" alt=""> -->
<?php get_footer();?>