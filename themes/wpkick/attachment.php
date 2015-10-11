<?php 
	get_header();
/*	$poster = get_field('poster_critique');
	// vars
	$url = $poster['url']; $title = $poster['title'];
	$alt = $poster['alt']; $caption = $poster['caption'];

	// thumbnail
	$size = 'large'; $thumb = $poster['sizes'][ $size ];
	$width = $poster['sizes'][ $size . '-width' ]; $height = $poster['sizes'][ $size . '-height' ];

	$bandeau = get_field('critique_bandeau');
	// vars
	$url_bandeau = $bandeau['url']; 
	$title_bandeau = $bandeau['title'];
	$alt_bandeau = $bandeau['alt']; 
	$caption_bandeau = $bandeau['caption'];

	// thumbnail
	$size_bandeau = 'poster-open_graph'; 
	$thumb_bandeau = $bandeau['sizes'][ $size_bandeau ];
	$width_bandeau = $bandeau['sizes'][ $size_bandeau . '-width_bandeau' ]; 
	$height_bandeau = $bandeau['sizes'][ $size_bandeau . '-height_bandeau' ];
*/

?>
<main id="content" class="<?php echo $category[0]->slug; ?>">
	
	<article>
		
				
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php if (has_post_thumbnail( $post->ID ) ): ?>
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); ?>							
			
				<header class="article_header">
					<div class="wrap" style="background-image:url(<?php echo $image[0]; ?>);">
						<?php if(get_field('film_teaser_url') != ""){ ?>
								<a href="<?php the_field('film_teaser_url'); ?>" class="lightbox-iframe btn-play icone">&#xf04b</a>
						<?php } ?>
					</div><!-- /.wrap -->
				</header><!-- /.article_header -->
			<?php endif; ?>	
			<nav class="wrap">
				<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
				    <?php if(function_exists('bcn_display'))
				    {
				        bcn_display();
				    }?>
				</div>
			</nav> <!-- /.wrap -->	
		
		
		
			<div class="article_contenu2">
				
				<div class="wrap">
					<h1><?php the_title(); ?></h1>
					<?php echo $post->post_content;	 ?>
				</div><!-- /.wrap -->
			</div><!-- /.article_contenu -->

	</article>
				
	
	<?php endwhile; else : ?>
		 	
	<?php endif; ?>	
		
</main><!-- #content -->

<?php 
	get_footer();
?>