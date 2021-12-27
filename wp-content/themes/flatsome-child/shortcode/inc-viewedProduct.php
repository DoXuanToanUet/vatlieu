<?php function createViewedProduct($attr)
{
    ?>
    <?php 
          extract( shortcode_atts(
            [
                'text_style'=>''
            ], $attr
        ));
    ?>
    <div class="viewedProduct">
        <h2 class="viewed-title <?php echo $text_style;?>">Sản phẩm đã xem</h2>
        <div class="view-products devProduct-list">
            <div class="swiper-container">
                <div class="swiper-wrapper swiper-height">
                    <?php
                        if(isset($_SESSION["viewed"]) && $_SESSION["viewed"]):
                            $data = $_SESSION["viewed"];
                            // var_dump($data);
                            $args = array(
                                'post_type' => 'product',
                                'post_status' => 'publish',
                                'posts_per_page' => 6,
                                'post__in'	=> $data
                            );

                            $getposts = new WP_query( $args);
                            global $wp_query; $wp_query->in_the_loop = true; 
                            while ($getposts->have_posts()) : $getposts->the_post();
                                global $product; 
                            ?> 
                                <div class="view-product swiper-slide">
                                    <div class="card-wrapper">
                                        <div class="card">
                            <?php 
                                    if( $product->is_type('simple') || $product->is_type('external') || $product->is_type('grouped') ){
                                        $view_regular 	= get_post_meta( $product->get_id(), '_regular_price', true ); 
                                        $view_sale 	= get_post_meta( $product->get_id(), '_sale_price', true );
                                        if($view_sale!=0 && $view_regular!=0){
                                            $view_precent=round(100 -($view_sale/$view_regular)*100).'%';
                                            echo "<span class='home_sale_custom'>".'-'.$view_precent."</span>";
                                        }
                                    } 
                                    if($product->is_type('variable')){
                                        $percentages = array();

                                        // Get all variation prices
                                        $prices = $product->get_variation_prices();

                                        // Loop through variation prices
                                        foreach( $prices['price'] as $key => $price ){
                                            // Only on sale variations
                                            if( $prices['regular_price'][$key] !== $price ){
                                                // Calculate and set in the array the percentage for each variation on sale
                                                $percentages[] = round(100 - ($prices['sale_price'][$key] / $prices['regular_price'][$key] * 100));
                                            }
                                        }
                                        // We keep the highest value
                                        $percentage = max($percentages) . '%';
                                        echo "<p class='home_sale_custom'>".'-'.$percentage."</p>";
                                    }
                            ?>
                                            <div class="cat-img">
                                                <a href="<?php the_permalink( );?>">
                                                    <?php if (has_post_thumbnail()): the_post_thumbnail();  endif;?>
                                                </a>
                                            </div>
                                            <div class="tool-action ">
                                                <div class="item">
                                                    <a href="<?php home_url();?>/?add-to-cart=<?php echo get_the_id(); ?>" title="Thêm vào giỏ hàng" class="dev-addCart"><span class="lnr lnr-cart"></span></a>
                                                </div>
                                                <div class="item">
                                                    <a href="<?php home_url()?>/checkout/?add-to-cart=<?php echo get_the_id(); ?>" title="Mua ngay" class="dev-buyNow"><span class="lnr lnr-plus-circle"></span></a>
                                                </div>
                                                <div class="item">
                                                    <a href="<?php home_url()?>/product/<?php echo $getCat->post->post_name; ?>" title="Mua ngay" class=""><span class="lnr lnr-plus-circle"></span></a>
                                                </div>
                                            </div>
                                            <div class="card-title">
                                                <div class="home-term-product">
                                                    <?php 
                                                        $terms = get_the_terms( get_the_ID(), 'product_cat' );
                                                        foreach( $terms as $term):
                                                            ?><a href="<?php home_url();?>/product-category/<?php echo $term->slug;?>" class="dev-tabCustom"><?php echo $term->name;?></a><?php 
                                                        endforeach;
                                                        // echo "<pre>";
                                                        // var_dump();
                                                        // echo "</pre>";
                                                    ?>
                                                </div>
                                                <a  href="<?php the_permalink( );?>" class="title" style="padding-bottom:15px;"><?php the_title();?></a>
                                                <!-- <p class="date"><?php //echo get_the_date();?></p> -->
                                                <?php $product = wc_get_product( get_the_ID() ); /* get the WC_Product Object */ ?>
                                                <p><?php  echo $product->get_price_html() ?  $product->get_price_html() : ''; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                            endwhile; wp_reset_postdata(); 
                        else:
                            ?><p>Không có sản phẩm nào đã xem!</p><?php  
                        endif;  
                    ?>
                </div>
                <div class="swiper-button-next"><span class="lnr lnr-chevron-right"></span></div>
                <div class="swiper-button-prev"><span class="lnr lnr-chevron-left"></span></div>
            </div>
        </div>
    </div>
    <script>
        jQuery(document).ready(function($) {
                var swiper_view = new Swiper('.view-products .swiper-container', {
                    spaceBetween: 20,
                    slidesPerView:4,
                    navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                    },
                    loop:false,
            });
        });
    </script>	
    <?php 
}

add_shortcode("devViewedProduct", "createViewedProduct");