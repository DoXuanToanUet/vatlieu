<?php get_header();?>

<?php //if (has_nav_menu('mainmenu')):
   // wp_nav_menu(array('theme_location' => 'mainmenu', 'container' => ''));
//endif; ?>

<!-- Banner Section  -->
<?php if (get_field('banner_status','option') == true): ?>
    <section class="home-devBanner">
        <div class="container">
            <div class="row">
                <div class="col large-2">
                    <div class="home-vertical-menu">
                        <?php if (has_nav_menu('mega_menu')):
                            wp_nav_menu(array('theme_location' => 'mega_menu', 'container' => ''));
                        endif; ?>
                    </div>
                </div>
                <div class="col large-7">
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
                <div class="col large-3">
                    <div class="right-banner">
                        <?php if (have_rows('right_banner','option')): while (have_rows('right_banner','option')) : the_row(); ?>
                            <div class="item">
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
<section class="devProduct-section section-common">
    <div class="container">
        <?php echo do_shortcode( '[devProductHome title="Tôn Hoa Sen" cat=46 swiperid=1]' )?>
    </div>
</section>

<!-- Section Sản phẩm test2  -->
<section class="devProduct-section section-common">
    <div class="container">
        <?php echo do_shortcode( '[devProductHome title="Sản phẩm gạch" cat=75 swiperid=2]' )?>
    </div>
</section>


<!-- Section Sản phẩm test2  -->
<section class="devProduct-section section-common">
    <div class="container">
   
    </div>
</section>



<!-- <img src="https://goo.gl/maps/wFwhuQNvsB2QeEg16" alt=""> -->
<?php get_footer();?>