<?php 
	 $objCurrent= get_queried_object();
	 // echo "<pre>";
	 // var_dump($t);
	 // echo "</pre>";
	 $catName =  get_the_category(get_the_id());
	 $author_id = $objCurrent->post_author ;

?>
<header class="entry-header dev-header-post">
	<div class="entry-header-text entry-header-text-top text-<?php echo get_theme_mod( 'blog_posts_title_align', 'center' ); ?>">
		<?php get_template_part( 'template-parts/posts/partials/entry', 'title' ); ?>
	</div>
	<div class="content header-post-custom" >
		<!-- <h1 class="post-title"><?php //the_title();?></h1> -->
		<div class="header-post-customLeft">
			<div class="post-author flex">
				<div class="post-author-image">
					<img  class="user-avatar" src="<?php the_field("tt_userImage","user_".$author_id); ?>" alt="">
				</div>
				<span style="font-weight:600;font-size:15px;"><?php the_author_meta( 'user_nicename' , $author_id );?></span>
			</div>
			<div class="count-comment" style="padding-left:10px">
				<span class="lnr lnr-bubble"></span>
				<?php echo get_comments_number(get_the_id());?> bình luận
			</div>
			<div class="count-comment" style="padding-left:10px">
				<a href="#respond"><span class="lnr lnr-pencil"></span> Viết bình luận </a>
			</div>
		</div>
		<div class="header-post-customRight">
			Chia sẻ : 
			<div class="share-post " style="padding-left:10px">
				<div class="sharelink-item">
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?= the_permalink(); ?> "
						title="Share Facebook"
						target="_blank"
						class=""
					>
						<i class="fa fa-facebook"></i>
					</a>
				</div>	
			</div>
			<div class="share-post " style="padding-left:10px">
				<div class="sharelink-item">
				<a href="mailto:<?php the_field('email','option');?>"
					title="Share Mail"
					target="_blank"
					class=""
				>
					<i class="fa fa-envelope-o"></i>
				</a>
				</div>	
			</div>
		</div>
	</div>
	  <div class="tag">
            <div><?php                                  
				$tags =  get_the_tags(get_the_id());
				if($tags):
					// echo "<pre>";
					// var_dump($tags);
					// echo "</pre>";
					foreach($tags as $tag):
						?>
							<a href="/tag/<?php echo $tag->slug;?>" class="dev-tabCustom"> <?php  echo $tag->name; ?></a>
						<?php 
					
					endforeach;
				endif;
		?></div>
	</div>
</header>
