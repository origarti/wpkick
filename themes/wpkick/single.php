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
	<main id="content" class="<?php echo $category[0]->slug; ?> <?php echo $header_class; ?>">
		
		<article>
			<?php if (has_post_thumbnail( $post->ID ) ): 


				$thumb_id = get_post_thumbnail_id();
				$medium = wp_get_attachment_image_src($thumb_id,'poster-open_graph-medium', true);
				$medium_url = $medium[0];
				$large = wp_get_attachment_image_src($thumb_id,'poster-open_graph', true);
				$large_url = $large[0];		

			endif; ?>
					
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); 
				$postID = get_the_ID(); 
			?>
			<header class="article_header">
				<div class="wrap" style="background-image:url('<?php bloginfo('template_url'); ?>/pic/dist/fakeimg_medium.png');" data-large="<?php echo $large_url; ?>" data-medium="<?php echo $medium_url; ?>">
					<?php if(get_field('film_teaser_url') != ""){ ?>
						<a href="<?php the_field('film_teaser_url'); ?>" class="lightbox-iframe btn-play icone">&#xf04b</a>
					<?php } ?>
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

					<h1 itemprop="name"><?php the_title(); ?> </h1>
					
					<?php 
						echo "<span class=\"article-visit-counter\"><strong>";
						echo set_get_PostViews($postID); 
						echo "</strong></span>";
					?>
					
					<?php the_content(); ?>
					<div class="social-zone">
						<p><small>Partager cet article : </small></p>
						<ul class="share-table">
							<?php facebook_share_link(); ?>
							<?php twitter_share_link(); ?>
							<li class="sharer"><a class="sharer-googleplus" title="Partager cet article via Google +" href="https://plus.google.com/share?url=<?php the_permalink(); ?>">Partager via Google +</a></li>
						</ul>
					</div>
				</div><!-- /.wrap -->
			</div><!-- /.article_contenu -->

		</article>
					
		<aside>
			<section class="article_commentaires">
					
								
					<?php 
						// If comments are open or we have at least one comment, load up the comment template.
						//if ( comments_open() || get_comments_number() ) :
						comments_template();
						//endif;
					?> 
							
			</section><!--/#commentaires-->
			<nav class="article-pagination" role="navigation">
				<div class="wrap">
				<?php 
		                        	
					$previous_post = get_previous_post();
					$next_post = get_next_post();
		                           
					
						$prev_film_affiche = get_the_post_thumbnail($previous_post->ID, "poster-open_graph-medium" );
						$prev_film_nom = get_the_title( $previous_post->ID, 'pagetitle', $single = true); 
						$prev_film_excerpt = get_the_excerpt( $previous_post->ID, 'pagetitle', $single = true); 
					?>
						<div class="pagination pagination-prev"><?php previous_post_link('%link', "$prev_film_affiche  <div class=\"caption\">&laquo; <span class=\"caption-title\">$prev_film_nom</span><span class=\"caption-excerpt\">$prev_film_excerpt</span></div>"); ?></div>
					<?php  
					
						$next_film_affiche = get_the_post_thumbnail($next_post->ID, "poster-open_graph-medium" );
						$next_film_nom = get_the_title( $next_post->ID, 'pagetitle', $single = true); 
						$next_film_excerpt = get_the_excerpt( $next_post->ID, 'pagetitle', $single = true); 
					?>
						<div class="pagination pagination-next"><?php next_post_link('%link', "$next_film_affiche  <div class=\"caption\"><span class=\"caption-title\">$next_film_nom &raquo;</span><span class=\"caption-excerpt\">$next_film_excerpt</span></div>"); ?></div>
		            
		        
				</div><!-- /.wrap-->
			</nav><!-- /.article-pagination -->
			
		</aside> 
	<?php endwhile; else : ?>
		 	Rien à afficher
	<?php endif; ?>	
	<?php
	
	// Previous/next post navigation.
		/*echo '<div class="wrap">';
		the_post_navigation( array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Suivant', 'cinezine' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( ' - ', 'cinezine' ) . '</span> ' .
				'<span class="post-title">%title (%film_note) </span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Précédent', 'cinezine' ) . '</span> ' .
				'<span class="screen-reader-text">' . __( ' - ', 'cinezine' ) . '</span> ' .
				'<span class="post-title">%title  (%film_note)</span>',
		) );

		echo '</div>';*/
	?>

			
		
</main><!-- #content -->

<?php 
	get_footer();
?>