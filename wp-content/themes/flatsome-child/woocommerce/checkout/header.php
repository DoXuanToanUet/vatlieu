<?php
	function flatsome_checkout_breadcrumb_class($endpoint){
		$classes = array();
		if($endpoint == 'cart' && is_cart() ||
			$endpoint == 'checkout' && is_checkout() && !is_wc_endpoint_url('order-received') ||
			$endpoint == 'order-received' && is_wc_endpoint_url('order-received')) {
			$classes[] = 'current';
		} else{
			$classes[] = 'hide-for-small';
		}
		return implode(' ', $classes);
	}
	$steps = get_theme_mod('cart_steps_numbers', 0);
    $icons = [
        'cart' => 'book.svg',
        'checkout_detail' => 'order.svg',
        'order_complete' => 'shield.svg',
      ];
?>

<div class="checkout-page-title page-title">
	<div class="page-title-inner flex-row medium-flex-wrap container">
	  <div class="flex-col flex-grow medium-text-center">
	 	 <nav class="breadcrumbs flex-row flex-row-center heading-font checkout-breadcrumbs text-center strong <?php echo get_theme_mod('cart_steps_size','h2'); ?> <?php //echo get_theme_mod('cart_steps_case','uppercase'); ?>">
            <div class="checkout-header-item <?php echo flatsome_checkout_breadcrumb_class('cart'); ?>">
                <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/myaccount/'.$icons['cart']; ?>" alt="">
                 <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="">
                    <?php if($steps) { echo '<span class="breadcrumb-step hide-for-small">1</span>'; } ?>
                    <?php _e('Shopping Cart', 'flatsome'); ?>
                </a>
            </div>
           <div class="checkout-header-item <?php echo flatsome_checkout_breadcrumb_class('checkout') ?>" >
                <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/myaccount/'.$icons['checkout_detail']; ?>" alt="">
                <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="">
                            <?php if($steps) { echo '<span class="breadcrumb-step hide-for-small">2</span>'; } ?>
                        <?php _e('Checkout details', 'flatsome'); ?>
                </a>
           </div>
           <div class="checkout-header-item ">
                <img src="<?php echo get_stylesheet_directory_uri().'/assets/images/myaccount/'.$icons['order_complete']; ?>" alt="">
                <a href="#" class="no-click <?php echo flatsome_checkout_breadcrumb_class('order-received'); ?>">
                    <?php if($steps) { echo '<span class="breadcrumb-step hide-for-small">3</span>'; } ?>
                    <?php _e('Order Complete', 'flatsome'); ?>
                </a>
           </div>
            <!-- <span class="divider hide-for-small"><?php //echo get_flatsome_icon('icon-angle-right');?></span> -->
           
            <!-- <span class="divider hide-for-small"><?php //echo get_flatsome_icon('icon-angle-right');?></span> -->
            
		 </nav>
	  </div>
	</div>
</div>
