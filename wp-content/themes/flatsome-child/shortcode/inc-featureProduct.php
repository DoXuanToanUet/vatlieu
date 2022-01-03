<?php function createfeatureProduct($attr)
{
    ?>
       <?php
            extract( shortcode_atts(
                [
                    'cat'=>'',
                    'title'=>'',
                    'swiperid'=>''
                ], $attr
            ));
            // ob_start();
            $args = array(
                'post_type' => 'product',
                'post_status' => 'publish',
                'order' => 'DESC',
                'orderby' => 'DATE',
                'post_per_page' => -1 ,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field' => 'term_id',
                        'terms' => $cat,
                        // 'operator' => 'IN',
                       
                    ),
                    array(
                        'taxonomy' => 'product_visibility',
                        'field'    => 'name',
                        'terms'    => 'featured',
                        'operator' => 'IN', // or 'NOT IN' to exclude feature products
                    ),
                    // array(
                    //     'taxonomy' => 'product_visibility',
                    //     'field'    => 'name',
                    //     'terms'    => 'outofstock',
                    //     'operator' => 'NOT IN', // or 'NOT IN' to exclude feature products
                    // )
                ),
               
            );
            $getCat = new WP_Query($args);
            // echo "<pre>";
            // var_dump($getCat);
            // echo "</pre>";
        ?>
        <h2 class="saleNews-title dev-title">
            <?php echo $title;?>
            <!-- <span> $term->count;?> sản phẩm</span> -->
        </h2>
        <?php 
            // echo "<pre>";
            // var_dump($getCat);
            // echo "</pre>";
        ?>
        <div class="devProduct-list">
                <div class="devProduct-swiper<?php echo $swiperid;?> swiper-container">
                    <div class="swiper-wrapper">
                        <?php if ( $getCat->have_posts() ) : while ( $getCat->have_posts() ) :
                                $getCat->the_post();
                            ?>
                            <?php 
                                //  echo "<pre>";
                                // var_dump($getCat);
                                // echo "</pre>"; 
                            ?>
                                <div class="swiper-slide"> 
                                    <div class="card-wrapper">
                                        <div class="card">
                                            <?php 
                                                global $product;
            
                                                if( $product->is_type('simple') || $product->is_type('external') || $product->is_type('grouped') ){
                                                    $view_regular 	= get_post_meta( $product->get_id(), '_regular_price', true ); 
                                                    // echo $view_regular;
                                                    $view_sale 	= get_post_meta( $product->get_id(), '_sale_price', true );
                                                    // echo $view_sale;
                                                    if($view_sale!=0 && $view_regular!=0){
                                                        $view_precent=round(100 -($view_sale/$view_regular)*100).'%';
                                                        echo "<span class='home_sale_custom'>".'-'.$view_precent."</span>";
                                                    }
                                                } 
                                                if($product->is_type('variable')){
                                                    $percentages = array();
            
                                                    // Get all variation prices
                                                    $prices = $product->get_variation_prices();
                                                    // print_r($prices);
                                                    // Loop through variation prices
                                                    foreach( $prices['price'] as $key => $price ){
                                                        // Only on sale variations
                                                        if( $prices['regular_price'][$key] !== $price ){
                                                            // Calculate and set in the array the percentage for each variation on sale
                                                            $percentages[] = round(100 - ($prices['sale_price'][$key] / $prices['regular_price'][$key] * 100));
                                                        }
                                                    }
                                                    if( ($percentages) ) {
                                                        $percentage = max($percentages) . '%';
                                                        // echo $percentage;
                                                        echo "<span class='home_sale_custom'>".'-'.$percentage."</span>";
                                                    }  
                                                    // We keep the highest value
                                                    // $percentage = max($percentages) . '%';
                                                    // echo "<span class='home_sale_custom'>".'-'.$percentage."</span>";
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
                                                        <a href="<?php home_url()?>/product/<?php echo $getCat->post->post_name; ?>" title="Mua ngay" class=""><span class="lnr lnr-eye"></span></a>
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
                                                    <div class="price"><?php  echo $product->get_price_html() ?  $product->get_price_html() : ''; ?></div>
                                                </div>
                                            
                                        </div> 
                                    </div>
                                </div>
                        <?php endwhile; wp_reset_postdata();  endif;?>
                    </div>
                    <div class="swiper-button-next"><span class="lnr lnr-chevron-right"></span></div>
                    <div class="swiper-button-prev"><span class="lnr lnr-chevron-left"></span></div>
                    <!-- <div class="swiper-pagination"></div> -->
                </div>
        </div>
                                                            
    <?php //ob_get_clean();
}

add_shortcode("devFeatureProduct", "createfeatureProduct");