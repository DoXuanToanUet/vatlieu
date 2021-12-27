<?php function createCustomProduct()
{
    ?>
       <div class="devSidebar-single-product">
           <h2 class="dev-title-product2"> <span class="lnr lnr-gift"></span> <?php the_field("sale_title","option");?> </h2>
           <div class="content">
                <?php if (have_rows('sale_content','option')): while (have_rows('sale_content','option')) : the_row(); ?>
                    <div class="item flex">
                        <p class="icon"> <?php the_sub_field("icon","option");?></p>
                        <p> <?php the_sub_field("content","option");?></p>
                    </div>
                <?php endwhile;else :endif;?>
           </div>
       </div>
       <div class="devSidebar-single-product">
           <h2 class="dev-title-product2"> <span class="lnr lnr-pencil"></span> <?php the_field("experience_title","option");?> </h2>
           <div class="content">
                <?php 
                        $experience_posts = get_field('experience_posts','option');
                        // echo "<pre>";
                        // var_dump($featured_posts);
                        // echo "</pre>";
                        if( $experience_posts ):  
                            ?>
                                <div class="item-wrapper">
                                    <?php foreach( $experience_posts as $experience_post):
                                        $permalink = get_permalink( $experience_post->ID );
                                        $title = get_the_title( $experience_post->ID );
                                        // $custom_field = get_field( 'field_name', $experience_post->ID );
                                        ?>
                                        <div class="item">
                                            <a href="<?php echo $permalink; ?>"> <?php echo $title; ?></a>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            <?php
                        wp_reset_postdata();  endif;
                ?>
           </div>
           
           <!-- <div class="content">
                <?php //if (have_rows('sale_content','option')): while (have_rows('sale_content','option')) : the_row(); ?>
                    <div class="item">
                        <p> <?php //the_sub_field("icon","option");?></p>
                        <p> <?php //the_sub_field("content","option");?></p>
                    </div>
                <?php //endwhile;else :endif;?>
           </div> -->
       </div>
    <?php 
}

add_shortcode("devcustomProduct", "createCustomProduct");