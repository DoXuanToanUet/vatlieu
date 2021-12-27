<?php 

// Thêm hình ảnh cho sản phẩm trang checkout
// ===========================================
add_filter( 'woocommerce_cart_item_name', 'ts_product_image_on_checkout', 10, 3 );
 
function ts_product_image_on_checkout( $name, $cart_item, $cart_item_key ) {
     
    /* Return if not checkout page */
    if ( ! is_checkout() ) {
        return $name;
    }
     
    /* Get product object */
    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
 
    /* Get product thumbnail */
    $thumbnail = $_product->get_image();
 
    /* Add wrapper to image and add some css */
    $image = '<div class="ts-product-image" style="width: 64px; height: 64px; display: inline-block; padding-right: 7px; vertical-align: middle;">'
                . $thumbnail .
            '</div>'; 
 
    /* Prepend image to name and return it */
    return $image . $name;
}


// Tạo thêm trường trong order
// function reigel_woocommerce_checkout_fields( $checkout_fields = array() ) {

//     $checkout_fields['order']['date_of_birth'] = array(
//         'type'          => 'date',
//         'class'         => array('my-field-class form-row-wide'),
//         'label'         => __('Date of Birth'),
//         'placeholder'   => __('dd/mm/yyyy'),
//         'required'      => true, 
//         );

//     return $checkout_fields;
// }
// add_filter( 'woocommerce_checkout_fields', 'reigel_woocommerce_checkout_fields' );

// function reigel_woocommerce_checkout_update_user_meta( $customer_id, $posted ) {
//     if (isset($_POST['date_of_birth'])) {
//         $dob = sanitize_text_field( $_POST['date_of_birth'] );
//         update_user_meta( $customer_id, 'date_of_birth', $dob);
//     }
// }
// add_action( 'woocommerce_checkout_update_user_meta', 'reigel_woocommerce_checkout_update_user_meta', 10, 2 );


// add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

// function my_custom_checkout_field_update_order_meta( $order_id ) {
//     if ( isset( $_POST['date_of_birth'] ) ) {
//         update_post_meta( $order_id, 'date_of_birth', sanitize_text_field( $_POST['date_of_birth'] ) );
//     }
            
// }

// add_action( 'woocommerce_admin_order_data_after_order_details', 'custom_code_after_order_details', 10, 1 );
function custom_code_after_order_details ( $order ) {
    // echo "<pre>";
    // var_dump($order->get_id());
    // echo "</pre>";
    // Get custom field value from '_vendor' meta key
    $value =get_post_meta( $order->get_id(), 'date_of_birth', true );
    ?>
        <p> <label for="order_status">Date：<?php echo $value;?> </label>
        <input type="hidden" name="custom_select_field_nonce" value="<?php echo wp_create_nonce(); ?>">
    <?php
}


// Thêm mã giảm giá dưới phần đặt hàng
add_action( 'woocommerce_review_order_before_submit', 'after_custom_checkout_payment', 1 );

function after_custom_checkout_payment() {
    ?>
        <?php if ( wc_coupons_enabled() ) { ?>
            <form class="checkout_coupon mb-1" method="post">
                <p class="" style="font-weight:500"><span class="lnr lnr-gift"></span> Mã khuyến mãi </p>
                <div class="coupon flex">
                    <input type="text" style="border-radius:0px !important" name="coupon_code" class="input-text " id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> 
                    <input type="submit" style="height:39px;color: #555 !important;background-color: #f0f0f0;text-transform:none;font-size:14px" class="" name="apply_coupon" value="<?php esc_attr_e( 'Áp dụng', 'woocommerce' ); ?>" />
                    <?php do_action( 'woocommerce_cart_coupon' ); ?>
                </div>
            </form>
		<?php } ?>
    <?php
}


// Tự chuyển hướng khi login 

add_action( 'template_redirect', 'direct_func_login' );
function direct_func_login() {
    global $post;
    // echo "<pre>";
    // var_dump($post);
    // echo "</pre>";
    $pagename =$post->post_name;
    // echo $pagename;
    if( $pagename =='login' &&  is_user_logged_in() ){
        wp_safe_redirect( '/shop' );
    }
    if( $pagename == 'my-account' && !is_user_logged_in() ){
        wp_safe_redirect( '/login' );
    }

}