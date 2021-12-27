<?php function createdevcatSlider($attr)
{
    $objCurrent= get_queried_object();
    // echo "<pre>";
    // var_dump($objCurrent);
    // echo "</pre>";\
    
    if( isset($objCurrent->term_id) ):
        $cat = $objCurrent->term_id;
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'order' => 'DESC',
            'orderby' => 'DATE',
            'post_per_page' => 4 ,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => $cat,
                    'operator' => 'IN',
                    )
            ),
        );
        $getCat = new WP_Query($args);
  
?>
<div class="container">
    <div class="devcatProduct-list">
                <div class="devProduct-swiperCat swiper-container">
                    <div class="swiper-wrapper">
                        <?php if ( $getCat->have_posts() ) : while ( $getCat->have_posts() ) :
                                $getCat->the_post();
                            ?>
                                <div class="swiper-slide"> 
                                    <div class="card-wrapper">
                                        <div class="card">
                                                <div class="cat-img">
                                                    <a href="#">
                                                        <?php if (has_post_thumbnail()): the_post_thumbnail();  endif;?>
                                                    </a>
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
</div>
<?php endif;?>
<?php 
}

add_shortcode("devcatSlider", "createdevcatSlider");