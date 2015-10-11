<?php

get_header(); ?> 


<main >
	<div class="wrap">
		<h1 class="archive-title"><?php single_cat_title( '', true ); ?></h1>
		<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
		    <?php if(function_exists('bcn_display'))
		    {
		        bcn_display();
		    }?>
		</div>
	</div><!-- /.wrap -->
	<?php 
	if ( have_posts() ) {
		$index = 0;
		while ( have_posts() ) { the_post(); 
			$index++;

			if($index < 2){ 
				// ARTICLE à la une
				?>
		
		<header class="article-list-header ">
			
			<article class="main-article wrap">
				<div class="main-article_header">
					


					<?php 
					$thumb_id = get_post_thumbnail_id();
					$medium = wp_get_attachment_image_src($thumb_id,'poster-open_graph-medium', true);
					$medium_url = $medium[0];
					$large = wp_get_attachment_image_src($thumb_id,'poster-open_graph', true);
					$large_url = $large[0];	

					$permalien = get_the_permalink();
					echo "<a href=\"$permalien\" class=\"article_visuel\">";
					echo "<img src=\"http://cinezine.fr/wp-content/themes/cinezine/pic/dist/fakeimg_large.png\" data-large=\"$large_url\" data-medium=\"$medium_url\">";
					echo "</a>";
					?>
					<div class="caption">
						<h2><?php the_title(); ?></h2>
						<?php comments_popup_link( '', '<span class="comment_nb">1</span>', '<span class="comment_nb">%</span>', 'comments-link', '');?>
						<?php the_excerpt(); ?>
					</div><!-- /.caption -->
				</div><!-- /.main-article_header -->
			</article><!-- /.main-article -->

		</header>

			
		<div class="article-list-group wrap">
			<section class="article-list ">
				<div class="article-list-container">


			<?php }
			// ---------------------------------------------------------
				else{ 
					// Autres articles

					$permalien = get_the_permalink();
					?>
					<article class="item-article">
						<?php 
							$thumb_id = get_post_thumbnail_id();
							$medium = wp_get_attachment_image_src($thumb_id,'medium', true);
							$medium_url = $medium[0];
							$large = wp_get_attachment_image_src($thumb_id,'poster-listing', true);
							$large_url = $large[0];	
						?>	
						<div class="item-article-visuel" <?php echo "style=\"background-image: url(http://cinezine.fr/wp-content/themes/cinezine/pic/dist/fakeimg_large.png);\" data-large=\"$large_url\" data-medium=\"$medium_url\""; ?>>
							<?php

							//the_post_thumbnail('poster-listing'); 
							echo "<a href=\"$permalien\" class=\"article_visuel\" >";
							echo "</a>";
						?>
						</div><!-- /.item-article-visuel -->
						<div class="item-article-description">
							<?php echo "<a href=\"$permalien\">"; ?>
							<h2><?php the_title(); ?></h2>
							<?php echo "</a>"; ?>
							<p><small>Publié le <?php the_time('j F Y') ?></small></p>
							<?php comments_popup_link( '<span class="comment_nb"></span>', '<span class="comment_nb">1</span>', '<span class="comment_nb">%</span>', 'comments-link', '');?>
							<?php the_excerpt(); ?>

						</div><!-- /.item-article-description -->
					</article><!-- /.item-article -->	
				<?php }
			} // end while
			?>
					<nav class="pagination">
						<?php 
						global $wp_query;

						$big = 999999999; // need an unlikely integer

						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total' => $wp_query->max_num_pages,
							'prev_text' => __('«'),
							'next_text' => __('»')
						) );
						?>
					</nav><!-- /.pagination -->
				</div><!-- /.article-list-container -->
			</section><!-- /.article-list -->

			<?php	
			} // end if
			else { ?>
				<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
			<?php } ?>
			
			<aside class="top_flop_widget">
				<?php 
				
				$note_term_obj = get_term_by('id', '2', 'type');
				$note_term_name = $note_term_obj->name;
				$note_term_url = get_term_link( $note_term_obj, 'film' );	
				if($index > 6){ $top_max = 	5;}
				else { $top_max = 3; }
				?>
				<div class="top_flop_widget-top">
					<a href="<?php echo $note_term_url; ?>?affichage=top" class="cat_permalien">
						<h2>Les mieux notés</h2>

					</a>
					<?php article_top_flop($limit = $index, $contexte = "home", 'DESC'); ?>
				</div><!-- /.top_flop_widget-top -->

				<div class="top_flop_widget-flop">
					<a href="<?php echo $note_term_url; ?>?affichage=flop" class="cat_permalien">
						<h2>Les moins bien notés</h2>
					</a>
					<?php article_top_flop($limit = $index, $contexte = "home", 'ASC'); ?>
				</div><!-- /.top_flop_widget-flop -->
			</aside><!-- /.top_flop_widget -->
	</div><!-- /.article-list-group -->
</main>
<?php get_footer(); ?>