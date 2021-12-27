<?php 
  function mytheme_comment($comment, $args, $depth) {
    // echo "<pre>";
    // var_dump($comment);
    // echo "</pre>";
    
        if ( 'div' === $args['style'] ) {
            $tag       = 'div';
            $add_below = 'comment';
        } else {
            $tag       = 'li';
            $add_below = 'div-comment';
        }?>
        <<?php echo $tag; ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?> id="comment-<?php comment_ID() ?>"><?php 
        if ( 'div' != $args['style'] ) { ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body"><?php
        } ?>
            <div class="comment-author vcard"><?php 
                if ( $args['avatar_size'] != 0 ) {
                    echo get_avatar( $comment, $args['avatar_size'] ); 
                } 
                if($comment->user_id >0){
                    printf( __( '<p class="tick"> %s</p> <ion-icon class="tick-icon" name="checkmark-circle-outline"></ion-icon> <span class="qtv"> Quản trị viên </span>' ), get_comment_author() ); 
                }else{
                    printf( __( '<p class="tick"> %s</p> ' ), get_comment_author() ); 
                };
                
                ?>
            </div><?php 
            if ( $comment->comment_approved == '0' ) { ?>
                <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></em><br/><?php 
            } ?>
            <div class="comment-content">
                <?php comment_text(); ?>
            </div>
            <div class="reply">
                <div class="reply-text">
                    <span class="lnr lnr-bubble" style="color:#288ad9"></span>
                    <?php 
                        comment_reply_link( 
                            array_merge( 
                                $args, 
                                array( 
                                    'add_below' => $add_below, 
                                    'depth'     => $depth, 
                                    'max_depth' => $args['max_depth'] 
                                ) 
                            ) 
                        ); 
                    ?>
                </div>
                <div class="reply-date">
                    <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ); ?>"><?php
                        /* translators: 1: date, 2: time */
                        printf( 
                            __('- %s trước'), 
                            human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) )
                        ); ?>
                    </a><?php 
                    edit_comment_link( __( '(Edit)' ), '  ', '' ); ?>
                </div>
            </div><?php 
        if ( 'div' != $args['style'] ) : ?>
            </div><?php 
        endif;
}

 //Create the rating interface.
 add_action( 'comment_form_logged_in_after', 'ci_comment_rating_rating_field' );
 add_action( 'comment_form_after_fields', 'ci_comment_rating_rating_field' );
 function ci_comment_rating_rating_field () {
     ?>
     <div class="rating-wrapper">
         <label for="rating">Rating<span class="required">*</span></label>
         <fieldset class="comments-rating">
             <span class="rating-container">
                 <?php for ( $i = 5; $i >= 1; $i-- ) : ?>
                     <input type="radio" id="rating-<?php echo esc_attr( $i ); ?>" name="rating" value="<?php echo esc_attr( $i ); ?>" /><label for="rating-<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $i ); ?></label>
                 <?php endfor; ?>
                 <input type="radio" id="rating-0" class="star-cb-clear" name="rating" value="0" /><label for="rating-0">0</label>
             </span>
         </fieldset>
     </div>
     
     <?php
 }

 
//Save the rating submitted by the user.
add_action( 'comment_post', 'ci_comment_rating_save_comment_rating' );
function ci_comment_rating_save_comment_rating( $comment_id ) {
    if ( ( isset( $_POST['rating'] ) ) && ( '' !== $_POST['rating'] ) )
    $rating = intval( $_POST['rating'] );
    add_comment_meta( $comment_id, 'rating', $rating );
}


// //Make the rating required.
// add_filter( 'preprocess_comment', 'ci_comment_rating_require_rating' );
// function ci_comment_rating_require_rating( $commentdata ) {
// 	if ( ! is_admin() && ( ! isset( $_POST['rating'] ) || 0 === intval( $_POST['rating'] ) ) )
// 	wp_die( __( 'Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.' ) );
// 	return $commentdata;
// }

//Display the rating on a submitted comment.
add_filter( 'comment_text', 'ci_comment_rating_display_rating');
function ci_comment_rating_display_rating( $comment_text ){

    if ( $rating = get_comment_meta( get_comment_ID(), 'rating', true ) ) {
        $stars = '<p class="stars">';
        for ( $i = 1; $i <= $rating; $i++ ) {
            $stars .= '<span class="dashicons dashicons-star-filled"></span>';
        }
        $rating2= 5 - $rating;
        for ( $i = 1; $i <= $rating2; $i++ ) {
            $stars .= '<span class="dashicons dashicons-star-empty"></span>';
        }
        $stars .= '</p>';
        $comment_text = $comment_text . $stars;
        return $comment_text;
    } else {
        return $comment_text;
    }
}

function countStar($star,$sum){
    return round(count($star)/$sum*100);
}