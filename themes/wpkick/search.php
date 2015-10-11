<?php get_header(); 


$value = $_GET['s'];
$filter = $_GET['par'];

/*global $query_string;

$query_args = explode("&", $query_string);
$search_query = array();

foreach($query_args as $key => $string) {
	$query_split = explode("=", $string);
	$search_query[$query_split[0]] = urldecode($query_split[1]);
} */
if(strlen($value) >= 3 && $filter != ""){


$paged = ( get_query_var('page') ) ? get_query_var('page') : 1; 
switch ($filter) {
	case 'titre':
	$args = array(
		'post_type' => 'film',
	    'paged' => $paged,
	    's' => $value,
		'posts_per_page' => 12,
	    'meta_key' => 'film_date',
		'orderby' => 'meta_value',
		'order' => "ASC"
	);  
	$relevant_display = "<small>"+get_the_time('j F Y')+"</small>";
	break;
	case 'realisateur': 
	$args = array(
		'post_type' => 'film',
	    'paged' => $paged,
		'posts_per_page' => 12,
		'meta_query'	=> array(
		'relation'		=> 'OR',
			array(
				'key'	 	=> 'film_realisateur',
				'value'	  	=> $value,
				'compare' 	=> '=',
			),
			array(
				'key'	  	=> 'film_realisateur',
				'value'	  	=> $value,
				'compare' 	=> 'LIKE',
			)
		),
		'paged' => $paged,
		'order' => "ASC"
	);

	$relevant_display = get_field('film_realisateur');
	break;
	case 'casting': 
	$args = array(
		'post_type' => 'film',
		'posts_per_page' => 12,
		'meta_query'	=> array(
		'relation'		=> 'OR',
			array(
				'key'	 	=> 'film_casting',
				'value'	  	=> $value,
				'compare' 	=> '=',
			),
			array(
				'key'	  	=> 'film_casting',
				'value'	  	=> $value,
				'compare' 	=> 'LIKE',
			)
		),
		'paged' => $paged,
		'order' => "ASC"
	); 
	$relevant_display = get_field('film_casting');
	break;
	default:
	$relevant_display = "<small>"+the_time('j F Y')+"</small>";
	break;
}


$the_query = new WP_Query( $args ); 

?>
<section id="primary" class="category_liste">
	<div class="wrap" role="main">
		<div class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#">
		    <?php if(function_exists('bcn_display'))
		    {
		        bcn_display();
		    }?>
		</div>
		
		<h1>#<?php echo $value; ?></h1>
		
	
	
		
			<?php 
			if ( $the_query->have_posts() ) : ?>
				<ul >
				<?php while (  $the_query->have_posts() ) : $the_query->the_post();  
				$thumb_id = get_post_thumbnail_id();
				$medium = wp_get_attachment_image_src($thumb_id,'poster-medium', true);
				$medium_url = $medium[0];
				$large = wp_get_attachment_image_src($thumb_id,'poster', true);
				$large_url = $large[0];


				$terms = get_the_terms($post->ID, 'type');
				//$term_list = wp_get_post_terms($post->ID, 'type', array("fields" => "id"));

				if ( $terms && ! is_wp_error( $terms ) ) : 
					$type = array();
					foreach ( $terms as $term ) { $type[] = $term->term_taxonomy_id; }
					$term_css = "term-$type[0]";
				endif;	

				switch ($filter) {
					case 'titre':
					if($type[0] != " 4" || $type[1] != " 4" || $type[2] != " 4"  ){ 
						$relevant_display = "<small>"; 
						$relevant_display .= get_the_time('j F Y');
						$relevant_display .= "</small>";
					}
					else{
						$relevant_display = "<small>Sortie prévue le <strong class=\"txt_teaser\">";
						$relevant_display .= humanify_date(get_field('film_date'));
						$relevant_display .= "</strong>";
						$relevant_display .= date_rebours(get_field('film_date'));
					}
					break;
					case 'realisateur': 
					$relevant_display = "Réalisé par <strong>";
					$relevant_display .= get_field('film_realisateur');
					$relevant_display .= "</strong>";
					break;
					case 'casting': 
					$relevant_display = "Avec <strong>";
					$relevant_display .= get_field('film_casting');
					$relevant_display .= "</strong>";
					break;
					default:
					$relevant_display = "<small>"+the_time('j F Y')+"</small>";
					break;
				}

				
				
				?>
				<li class="article_flux ">
					
					<div class="article_visuel">
						<a href="<?php echo get_the_permalink(); ?>" class="article_lien">
							<img src="<?php bloginfo('template_url'); ?>/pic/dist/fakeimg_medium.png" data-large="<?php echo $large_url; ?>" data-medium="<?php echo $medium_url; ?>" alt="Lire l'article à propos de <?php the_title(); ?>">
						</a>
						
						<div class="article-meta">
							<h3><a href="<?php echo get_the_permalink(); ?>" class="article_lien"><?php the_title(); ?></a></h3>

							<?php echo $relevant_display; ?>
						</div>

						<?php if($type[0] == " 4" || $type[1] == " 4" || $type[2] == " 4"  ){ ?> 
							<?php if(get_field('film_teaser_url') != ""){ ?>
								<a href="<?php the_field('film_teaser_url'); ?>" class="lightbox-iframe article_play" title="Visionner la bande-annonce de <?php the_title(); ?>">Bande-annonce</a>
							<?php } ?>
						<?php } 
						else{ ?>
							<div class="article_note"  itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating"><?php the_field('film_note');  ?></div>
						<?php } ?>
					</div>
				</li>
			 		
				
					<?php endwhile; ?>
			</ul>
		<?php else: ?>
		
			<div class="single-film no-result">
				<header class="article_header ">
					<div class="wrap" style="background-image:url(http://cinezine.fr/wp-content/themes/cinezine/pic/dist/no-result3.jpg); ">
						<?php //<iframe width="100%" height="500" class="desktop-only" src="https://www.youtube.com/embed/1koa2xAxCAw" frameborder="0" allowfullscreen></iframe>?>
					</div><!-- /.wrap -->
				</header><!-- /.article_header -->	

				<div class="article_fiche_film">
					<div class="wrap">
						<h2>Oups ! </h2>
						<p>Aucun article correspondant à votre recherche n'a pu être trouvé</p>
					</div>
				</div>
			
		<?php endif; ?>

			<div class="category-pagination pagination">
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
				<?php //echo paginate_links( $args ); ?>
			</div><!-- /.category-pagination -->
	
	</div>
</section>
<?php } else { ?> 
<div class="single no-result" style="margin-top: 40px;">
		<header class="article_header ">
			<div class="wrap" style="background-image:url(http://cinezine.fr/wp-content/themes/cinezine/pic/dist/no-result3.jpg); ">
				<?php //<iframe width="100%" height="500" class="desktop-only" src="https://www.youtube.com/embed/1koa2xAxCAw" frameborder="0" allowfullscreen></iframe>?>
			</div><!-- /.wrap -->
		</header><!-- /.article_header -->	

		<div class="article_fiche_film">
			<div class="wrap">
				<h2>Oups ! </h2>
				<p><strong>Votre requête est trop courte (3 caractères minimum)</strong> ou n'a renvoyé aucun résultat</p>
			</div>
		</div>
	</div>
</section>				
<?php }  ?> 

<?php get_footer(); ?>