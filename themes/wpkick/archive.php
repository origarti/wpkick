<?php

get_header(); ?> 


<main class="wrap">
	
	<h1><?php single_cat_title( '', true ); ?></h1>
	<?php 
	if ( have_posts() ) {
		$index = 0;
		while ( have_posts() ) { the_post(); 
			$index++;

			if($index < 2){ 
				// ARTICLE à la une
				?>
				<header class="article-list-header">
					<article class="main-article">
						<div class="main-article_header">
							<?php the_post_thumbnail('poster-open_graph'); ?>
							<h2><?php the_title(); ?></h2>
							<?php the_excerpt(); ?>
						</div><!-- /.main-article_header -->
					</article><!-- /.main-article -->
				</header>
				<div class="article-list-group">

					<section class="article-list">
						<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
						    <?php if(function_exists('bcn_display'))
						    {
						        bcn_display();
						    }?>
						</div>
				<?php }
				// ---------------------------------------------------------
					else{ 
						// Autres articles
						?>
						<article class="item-article">
							<header class="item-article_header">
								<?php the_post_thumbnail('poster-listing'); ?>
								<h2><?php the_title(); ?></h2>
								
								<?php the_excerpt(); ?>

							</header><!-- /.item-article_header -->
						</article><!-- /.item-article -->	
					<?php }
				} // end while
				?>

					</section><!-- /.article-list -->
		<?php	
		} // end if
		else{ ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php } // end else
		?>
		
					<aside class="column top_flop_widget">
							<div class="top_flop_widget-top">
								<div href="<?php echo $note_term_url; ?>" class="cat_permalien">
									<h2>Les mieux notés</h2>
								</div>
								<?php article_top_flop($limit = '3', $contexte = "home", 'DESC'); ?>
							</div><!-- /.top_flop_widget-top -->
							<div class="top_flop_widget-flop">
								<div href="<?php echo $note_term_url; ?>" class="cat_permalien">
									<h2>Les moins bien notés</h2>
								</div>
								<?php article_top_flop($limit = '3', $contexte = "home", 'ASC'); ?>
							</div><!-- /.top_flop_widget-flop -->
					</aside><!-- /.top_flop_widget -->
			</div><!-- /.article-list-group -->
</main>
<?php get_footer(); ?>