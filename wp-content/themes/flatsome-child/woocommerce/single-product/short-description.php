<?php
/**
 * Single product short description
 *
 * @author  Automattic
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

?>
<div class="product-short-description">
	<div class="dev-short-description " style="">
		<?php echo $short_description; // WPCS: XSS ok. ?>
	</div>
	<div class="short-desc-toggle">
		<span class="expand-text" style="padding-right:10px">Xem thêm</span>
		<span class="lnr lnr-chevron-down"></span>
	</div>
</div>
