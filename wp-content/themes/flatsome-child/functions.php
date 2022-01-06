<?php 
//Add Style and Script
function add_theme_scripts()
{
    $version = '1.0';
//	wp_enqueue_style( 'FontAwesome', get_template_directory_uri() . '/assets/plugins/linearIcon/linearIcon.css', array(), $version, 'all' );
    wp_enqueue_style('devFontAwe', get_stylesheet_directory_uri() . '/assets/plugins/fontAwesome/font-awesome.min.css', array(), $version, 'all');
    wp_enqueue_style('devMainCss', get_stylesheet_directory_uri() . '/assets/css/custom.css', array(), $version, 'all');
    wp_enqueue_style('devSwiperCss', get_stylesheet_directory_uri() . '/assets/plugins/swiper/swiper.min.css', array(), $version, 'all');

    wp_enqueue_script('devSwiperJs', get_stylesheet_directory_uri() . '/assets/plugins/swiper/swiper.min.js', array(), $version, true);
    wp_enqueue_script('devMainJS', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), $version, true);

    wp_enqueue_style('WowCss', get_stylesheet_directory_uri() . '/assets/plugins/wowjs/animate.min.css', array(), $version, 'all');
    wp_enqueue_script('WowJs', get_stylesheet_directory_uri() . '/assets/plugins/wowjs/wow.min.js', array(), $version, true);
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');



//Include Inc Ajax and shortcode
// require get_stylesheet_directory() . '/shortcode/inc-customHeaderPost.php';
// require get_stylesheet_directory() . '/shortcode/inc-devProduct.php';
// require get_stylesheet_directory() . '/shortcode/inc-register.php';
// require get_stylesheet_directory() . '/shortcode/inc-saleNews.php';
// require get_stylesheet_directory() . '/shortcode/inc-viewedProduct.php';
// require get_stylesheet_directory() . '/shortcode/inc-customProductSidebar.php';
// require get_stylesheet_directory() . '/shortcode/inc-comment.php';
// require get_stylesheet_directory() . '/shortcode/inc-comment-func.php';
// require get_stylesheet_directory() . '/shortcode/inc-fixbar.php';
// require get_stylesheet_directory() . '/shortcode/inc-catSlider.php';
// require get_stylesheet_directory() . '/custom/custom-avartar.php';
// require get_stylesheet_directory() . '/custom/custom-checkout.php';




//Theme Options
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug'  => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect'   => false
    ));

    acf_add_options_sub_page(array(
        'page_title'  => 'Home Banner Settings',
        'menu_title'  => 'Home Banner',
        'parent_slug' => 'theme-general-settings',
    ));

    acf_add_options_sub_page(array(
        'page_title'  => 'Custom Single Product Settings',
        'menu_title'  => 'Single Product',
        'parent_slug' => 'theme-general-settings',
    ));

    // acf_add_options_sub_page(array(
    //     'page_title'  => 'Theme Common Settings',
    //     'menu_title'  => 'Common',
    //     'parent_slug' => 'theme-general-settings',
    // ));

}


// Khởi tạo section trong 
// =============================================
function viewedProduct(){
	session_start();
	if(!isset($_SESSION["viewed"])){
		$_SESSION["viewed"] = array();
	}
	if(is_singular('product')){
		$_SESSION["viewed"][get_the_ID()] = get_the_ID();

	}
}
add_action('wp', 'viewedProduct');


/**
 * Tạo tab Tiêu chuẩn của sản phẩm
 */
add_filter( 'woocommerce_product_tabs', 'woo_new_standard_tab' );
function woo_new_standard_tab( $tabs ) {
	
	// Adds the new tab
	
	$tabs['hdsd_tab'] = array(
		'title' 	=> __( 'Hướng dẫn sử dụng', 'woocommerce' ),
		'priority' 	=> 20,
		'callback' 	=> 'woo_new_standard_tab_content'
	);

	return $tabs;

}
function woo_new_standard_tab_content(){
    the_field('hdsd_woo_tab');
}
// Hiển thị giảm giá theo phần trăm cho sản phẩm 
// =============================================

// Hiển thị giảm giá theo phần trăm cho sản phẩm 
// =============================================

add_filter( 'woocommerce_sale_flash', 'add_percentage_to_sale_badge', 20, 3 );
function add_percentage_to_sale_badge( $html, $post, $product ) {
    if( $product->is_type('variable')){
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
    } else {
        $regular_price = (float) $product->get_regular_price();
        $sale_price    = (float) $product->get_sale_price();

        $percentage    = round(100 - ($sale_price / $regular_price * 100)) . '%';
    }
    return '<span class="home_sale_custom">' . esc_html__( '', 'woocommerce' ) . ' ' . $percentage . '</span>';
}





add_filter( 'avatar_defaults', 'tomiup_add_new_avatar_default' );
function tomiup_add_new_avatar_default($avatar_defaults) {
    // $newavatar = get_stylesheet_directory_uri() . '/assets/images/avatar.png';
    $newavatar = "https://cdn.icon-icons.com/icons2/2643/PNG/512/male_man_people_person_avatar_white_tone_icon_159363.png";
    $avatar_defaults[$newavatar] = "Dev Custom Avartar";
    return $avatar_defaults;
}

// Change title Flatsome Shop
function my_custom_translations( $strings ) {
    $text = array(
    'Quick View' => 'Xem nhanh',
    'SHOPPING CART' => 'Giỏ hàng',
    'CHECKOUT DETAILS' => 'Thanh toán',
    'ORDER COMPLETE' => 'Hoàn thành',
    );
    
    $strings = str_ireplace( array_keys( $text ), $text, $strings );
    return $strings;
    }
add_filter( 'gettext', 'my_custom_translations', 20 );

// Change text sub total
add_filter('gettext', 'change_price_text_in_cart_page', 105, 3 );
function change_price_text_in_cart_page( $translated, $text, $domain ) {
    if( is_cart() && $text == 'Subtotal' ) {
        $translated = __('Thành tiền', $domain );
    }
    return $translated;
}


// Autoload file 
function auto_load_files($path) {

    $files = glob($path);

    foreach ($files as $file) {
        require($file); 
    }
}
auto_load_files(get_stylesheet_directory() . '/shortcode/*.php');
auto_load_files(get_stylesheet_directory() . '/custom/*.php');
