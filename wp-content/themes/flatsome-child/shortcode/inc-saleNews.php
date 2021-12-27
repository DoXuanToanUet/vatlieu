<?php function createSaleNews($attr)
{
    ?>
       <?php
            extract( shortcode_atts(
                [
                    'category_name'=>'',
                    'title'=>'' 
                ], $attr
            ));
           
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'order' => 'DESC',
                'orderby' => 'DATE',
                'post_per_page' => -1 ,
                'category_name' => $category_name
            );
            $getCat = new WP_Query($args);
        ?>
        <h2 class="saleNews-title dev-title">
            <?php echo $title;?>
            <!-- <span> $term->count;?> sản phẩm</span> -->
        </h2>
        <div class="saleNews-list">
                <div class="saleNews-swiper swiper-container">
                    <div class="swiper-wrapper">
                        <?php if ( $getCat->have_posts() ) : while ( $getCat->have_posts() ) :
                                $getCat->the_post();
                            ?>
                                <div class="swiper-slide"> 
                                    <div class="card-wrapper">
                                        <div class="card">
                                            <a href="<?php the_permalink( );?>">
                                                <div class="cat-img">
                                                    <?php if (has_post_thumbnail()): the_post_thumbnail(); else: ?>
                                                        <img  src="<?php echo get_stylesheet_directory_uri().'/assets/images/defaultImg.jpg'; ?>" alt="">
                                                    <?php endif;?>
                                                </div>
                                                <div class="card-title">
                                                    <p class="title"><?php the_title();?></p>
                                                    <p class="date"><?php echo get_the_date();?></p>
                                                    <div><?php 
                                                    
                                                    $tags =  get_the_tags(get_the_id());
                                                    if($tags):
                                                        // echo "<pre>";
                                                        // var_dump($tags);
                                                        // echo "</pre>";
                                                        // foreach($tags as $tag):
                                                            ?>
                                                                <a href="/tag/<?php echo $tags[0]->slug;?>" class="dev-tabCustom"> <?php  echo $tags[0]->name; ?></a>
                                                               
                                                            <?php 
                                                        
                                                        // endforeach;
                                                    endif;
                                                    
                                                    ?></div>
                                                </div>
                                            </a>
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

    <?php 
}

add_shortcode("devSaleNews", "createSaleNews");