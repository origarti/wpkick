<?php 
	get_header();

	$category = get_the_category();
	if (has_post_thumbnail( $post->ID ) ){
		$header_class = 'has_header';
	} 
	else{
		$header_class = 'no_header';
	}

?>
	<main id="content" class="<?php echo $category[0]->slug; ?><?php echo $header_class; ?>">
	
	<article>
		<?php if (has_post_thumbnail( $post->ID ) ): 


			$thumb_id = get_post_thumbnail_id();
			$medium = wp_get_attachment_image_src($thumb_id,'poster-open_graph-medium', true);
			$medium_url = $medium[0];
			$large = wp_get_attachment_image_src($thumb_id,'poster-open_graph', true);
			$large_url = $large[0];		

		endif; ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>		
		<header class="article_header">
			<div class="wrap" style="background-image:url('<?php bloginfo('template_url'); ?>/pic/dist/fakeimg_medium.png');" data-large="<?php echo $large_url; ?>" data-medium="<?php echo $medium_url; ?>">
			</div><!-- /.wrap -->
		</header><!-- /.article_header -->	
				
		
		<div class="article_contenu">

			<div class="wrap">
				<nav>
					<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
					    <?php if(function_exists('bcn_display'))
					    {
					        bcn_display();
					    }?>
					</div>
				</nav>	
			
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<div class="social-zone">
					<p><small>Partager cette page : </small></p>
					<ul class="share-table">
						<?php facebook_share_link(); ?>
						<?php twitter_share_link(); ?>
						<li class="sharer"><a class="sharer-googleplus" title="Partager cet article via Google +" href="https://plus.google.com/share?url=<?php the_permalink(); ?>">Partager via Google +</a></li>
					</ul>
				</div>
			</div><!-- /.wrap -->
		</div><!-- /.article_contenu -->

	</article>
				
	
	<?php endwhile; else : ?>
		 	
	<?php endif; ?>	
		
</main><!-- #content -->

<?php 
	get_footer();
?>