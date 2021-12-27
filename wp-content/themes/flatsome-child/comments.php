<div>
    <?php if ( have_comments() ) : ?>
        <ul class="commentlist">
            <?php wp_list_comments( 'type=comment&callback=mytheme_comment' ); ?>
        </ul>
        <div class="navigation">
            <?php paginate_comments_links(
                [
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;'
                ]
            ); ?> 
        </div>
    <?php endif;?>
</div>