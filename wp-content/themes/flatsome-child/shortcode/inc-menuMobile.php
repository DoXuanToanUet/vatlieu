<?php function createmenuMobile($attr)
{
  
?>
    <div class="footer-mb">
        <div class="content">
            <div class="item">
                <a href="">
                    <span class="lnr lnr-home"></span>
                    <p>Trang chủ</p>
                </a>
            </div>
            <div class="item">
                <a href="" class="category-mb-link">
                    <span class="lnr lnr-layers"></span>
                    <p>Danh mục</p>
                </a>
            </div>
            <div class="item">
                <a href="">
                    <span class="lnr lnr-phone-handset"></span>
                    <p>Hotline</p>
                </a>
            </div>
            <div class="item">
                <?php if (!is_user_logged_in() ):?>
                    <a href="">
                        <span class="lnr lnr-user"></span>
                        <p>Đăng nhập</p>
                    </a>
                <?php elseif(is_user_logged_in()): ?>
                    
                    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
                        <!-- <span class="lnr lnr-user"></span> -->
                        <?php $user = wp_get_current_user();
 
                        if ( $user ) :
                            ?>
                            <img src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" style="width:20px; height:20px"/>
                        <?php endif; ?>
                        <p>Tài khoản</p>
                    </a>
                <?php endif; ?>   
            </div>
            <div class="item">
                <a href="">
                    <span class="lnr lnr-list"></span>
                    <p>Menu</p>
                </a>
            </div>
        </div>
    </div>
    <?php if (get_field('category_mb_status','option') == true): ?>
        <div class="category-mb">
            <h2 class="text-center" style="padding:20px;">Danh mục sản phẩm</h2>
            <div class="row row-small">
                <?php if (have_rows('category_mb_rp','option')):$i=0; while (have_rows('category_mb_rp','option')) : the_row(); ?>
                        
                        <?php  $term = get_sub_field('name','option');
                        // var_dump($term);
                        $link = get_term_link( $term->term_id, 'product_cat');
                        if( $term ): ?>
                        <div class="col small-4">
                           
                                <a href="<?php echo $link;?>" class=" wow fadeInDown" data-wow-duration="1s" data-wow-delay="<?php echo $i;?>s">
                                    <div class="box-item">
                                        <img src="<?php echo get_sub_field('image','option');?>" alt="">
                                       
                                    </div>
                                    <p class="text-center category-mb-title"> <?php echo $term->name;?></p>
                                </a>
                            
                            
                        </div>
                        
                        <?php endif; ?>           
                    
                <?php  $i=$i+0.2; endwhile;else :endif;?>
            </div>
        </div>
    <?php endif;?>
<?php 
}

add_shortcode("devmenuMobile", "createmenuMobile");