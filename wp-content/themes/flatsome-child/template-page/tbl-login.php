<?php
/**
 * Template Name: Đằng kí đăng nhập
 */
get_header(); ?>

<div class="container">
    <?php if(!is_user_logged_in()): ?>
    <div class="login-section">
        <div class="login-wrapper">
            <div class="login-tab flex">
                <div class="col large-6 person-tab common-tab active-tab text-center" data-tab="loginTab">Đăng nhập </div>
                <div class="col large-6 agency-tab common-tab text-center" data-tab="registerTab">Đăng kí</div>
            </div>
            <div class="devtab-contain content-tab-common loginTab">
                <?php echo do_shortcode('[woocommerce_my_account]');?>
            </div>
            <div class="devtab-contain  content-tab-common registerTab">
                <?php echo do_shortcode('[devRegister]');?>
            </div>
        </div>
    </div> 
    <?php endif;?>
</div>
<?php get_footer(); ?>