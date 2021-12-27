<?php function createCustomHeaderPost()
{
    $objCurrent= get_queried_object();
    // echo "<pre>";
    // var_dump($t);
    // echo "</pre>";
    $catName =  get_the_category(get_the_id());
    $author_id = $objCurrent->post_author ;
    // var_dump($author_id);
    ?>
        <div class="dev-header-post">
            <section class="preinfo-section">
                <div class="container">
                    <div class="breadscrumb flex">
                        <a href="<?php echo home_url(); ?>">Home</a>
                        <span class="lnr lnr-chevron-right"></span>
                        <a href="/category/<?php echo $catName[0]->slug;?>" class=""> <?php  echo $catName[0]->name; ?></a>
                        <span class="lnr lnr-chevron-right"></span>
                        <span><?php the_title();?></span>
                    </div>
                   
                  
                    <div class="post-bannerImg">
                        <a href="<?php the_permalink();?>">
                            <?php the_post_thumbnail('large'); ?>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    <?php 
}

add_shortcode("devCustomHeaderPost", "createCustomHeaderPost");