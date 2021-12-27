
<?php function createComment(){
    global $post;
    ?>
        <div class="review-wrapper <?php if(is_product()): echo "comment-product-style"; endif;?>">
            <div class="reivew-comment">
                <?php
                    $comment_send = 'Bình luận';
                    $comment_reply = 'Bình luận';
                    $comment_reply_to = 'Trả lời';
                    //Array
                    $comments_args = array(
                        //Define Fields
                        'fields'              => array(
                            //Author field
                            'author' => '<input class="" type="text" id="author" name="author" aria-required="true" placeholder="Họ tên" required> ',
                            //Email Field
                            'email'  => '<input class="" type="email" id="email" name="email" placeholder="Email" required>',
                            //URL Field
                            // 'url'    => '<input type="text" id="url" name="url" placeholder="Website" required> ',
                            //Cookies
                            //                    'cookies' => '<input type="checkbox" required>' . $comment_cookies_1 ,
                        ),
                        // Change the title of send button
                        'label_submit'        => 'Gửi',
                        // Change the title of the reply section
                        'title_reply'         => __($comment_reply),
                        // Change the title of the reply section
                        'title_reply_to'      => __($comment_reply_to),
                        //Cancel Reply Text
                        'comment_field'       => '<p class="comment-form-comment"><textarea id="comment" name="comment" aria-required="true" placeholder="Nội dung"></textarea></p>',
                        //Message Before Comment
                        'comment_notes_after' => '',
                        //Submit Button ID
                        'id_submit'           => __('comment-submit'),
                    );
                    comment_form($comments_args);
                ?>
            </div>
            <div class="comments-wrapper section-inner dxt">
                <h3 style="font-size:18px; padding: 20px 0px;">
                    <?php if(is_product()): echo  " <span class='lnr lnr-bubble'></span> Đánh Giá - Nhận Xét Từ Khách Hàng"; else:  echo "<span class='lnr lnr-bubble'></span> Cùng thảo luận bài viết";  endif;?>
                    
                </h3>
                <div class="reivew-section">
                    <?php if(is_product()):?>
                        <div class="sort row">
                            
                            <?php 
                            $get_5star = get_comments(array ('post_id' => $post->ID,'meta_key'=> 'rating', 'meta_value'=> '5'));
                            $get_4star = get_comments(array ('post_id' => $post->ID,'meta_key'=> 'rating', 'meta_value'=> '4'));
                            $get_3star = get_comments(array ('post_id' => $post->ID,'meta_key'=> 'rating', 'meta_value'=> '3'));
                            $get_2star = get_comments(array ('post_id' => $post->ID,'meta_key'=> 'rating', 'meta_value'=> '2'));
                            $get_star = get_comments(array ('post_id' => $post->ID,'meta_key'=> 'rating', 'meta_value'=> '1'));
                            $avg="";
                            $sum = count($get_5star)+count($get_4star)+count($get_3star)+count($get_2star)+count($get_star);
                            if( count($get_5star)!=0){
                                $progress_5star = countStar($get_5star,$sum);
                            } else{
                                $progress_5star = 0;
                            }
                            if( count($get_4star) != 0){
                                $progress_4star = countStar($get_4star,$sum);
                            } else{
                                $progress_4star = 0;
                            }
                            if( count($get_3star) !=0){
                                $progress_3star = countStar($get_3star,$sum);
                            }else{
                                $progress_3star = 0;
                            }
                            if( count($get_2star) !=0){
                                $progress_2star = countStar($get_2star,$sum);
                            } else{
                                $progress_2star = 0;
                            }
                            if( count($get_star )!= 0){
                                $progress_star  =countStar($get_star,$sum);
                            }else{
                                $progress_star = 0;
                            }

                            if  ( $get_5star || $get_4star || $get_3star || $get_2star || $get_star){
                                $avg = round( (count($get_5star)*5 + count($get_4star)*4 + count($get_3star)*3 + count($get_2star)*2 + count($get_star))/(count($get_5star)+count($get_4star)+count($get_3star)+count($get_2star)+count($get_star)),2);
                            }
                            if ($avg):
                            ?>
                            <div class="col large-3 comment-left avg-common text-center">
                                <div class="vote-left vote-title" >
                                    <?php echo $avg; ?>/5
                                </div>
                                <div class="vote-count">
                                    <span class="vote-title"><?php  echo get_comments_number();?></span> đánh giá và bình luận
                                </div>
                                
                            </div>
                            <div class="col large-9 comment-right avg-common">
                                <div class="flex">
                                    <div class="star vote-title"> 5 <span class="dashicons dashicons-star-filled"></span> </div>    
                            
                                    <div class="bar-container flex">
                                        <div class="bar" data-progress="<?php echo  $progress_5star; ?>">
                                        </div>
                                        
                                    </div>
                                    <span class="vote-sub-title"><?php  echo count($get_5star); ?> đánh giá</span>
                                </div>
                                <div class="flex">
                                    <div class="star vote-title"> 4 <span class="dashicons dashicons-star-filled"></span> </div>    
                            
                                    <div class="bar-container flex">
                                        <div class="bar" data-progress="<?php echo  $progress_4star; ?>">
                                        </div>
                                        
                                    </div>
                                    <span class="vote-sub-title"><?php  echo count($get_4star); ?> đánh giá</span>
                                </div>
                                <div class="flex">
                                    <div class="star vote-title"> 3 <span class="dashicons dashicons-star-filled"></span> </div>    
                            
                                    <div class="bar-container flex">
                                        <div class="bar" data-progress="<?php echo  $progress_3star; ?>">
                                        </div>
                                        
                                    </div>
                                    <span class="vote-sub-title"><?php  echo count($get_3star); ?> đánh giá</span>
                                </div>
                                <div class="flex">
                                    <div class="star vote-title"> 2 <span class="dashicons dashicons-star-filled"></span> </div>    
                            
                                    <div class="bar-container flex">
                                        <div class="bar" data-progress="<?php echo  $progress_2star; ?>">
                                        </div>
                                        
                                    </div>
                                    <span class="vote-sub-title"><?php  echo count($get_2star); ?> đánh giá</span>
                                </div>
                                <div class="flex">
                                    <div class="star vote-title"> 1 <span class="dashicons dashicons-star-filled"></span> </div>    
                            
                                    <div class="bar-container flex">
                                        <div class="bar" data-progress="<?php echo  $progress_star; ?>">
                                        </div>
                                        
                                    </div>
                                    <span class="vote-sub-title"><?php  echo count($get_star); ?> đánh giá</span>
                                </div>
                            
                            </div>
                            <?php else:?>
                                <div class="no-comment">
                                    <img src="https://assets.website-files.com/5e55e29c0aff9d43d9f257a6/5e55e3a9817dd38460018189_clip-no-comments.png" alt="" style="max-width:400px;">
                                </div>
                            <?php endif;?>
                        </div>
                    <?php endif;?>
                    <div class="review-customer">
                        <?php comments_template('/comments.php'); ?>
                    </div>
                </div>
            
                

            </div>
        </div>
    <?php 
    
    ?>
    
    <script>
       (function($){
            //Progress comment
            $(".bar").each(function () {
                percent = $(this).data("progress");
                $(this).css("width", percent + "%");
            });
            // $('.page-numbers').click(function (event){
            //     console.log("object")
            //     event.preventDefault();
            //     $('html,body').animate({
            //         scrollTop: $(".commentlist").offset().top},
            //     'slow');
            // })
       })(jQuery);
    </script>
    
    <?php 
}
add_shortcode("devComment", "createComment");
