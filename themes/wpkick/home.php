<?php 
/*
Template Name: Accueil
*/
	get_header();
?>
	

<section id="home_focus">
	<div class="wrap">
		<a href="<?php echo get_category_link(1); ?>" class="cat_permalien">
			<h2><?php echo get_cat_name( 1 ) ?></h2>
		</a>
		<?php dossier_derniers(get_field('home_article_focus_max'), 'home'); ?>
	</div><!-- /.wrap -->
</section><!-- #home_focus -->

<!-- </div>#wrapper_top	

<br class="clear"/> -->
<?php 
	$teaser_term_obj = get_term_by('id', '4', 'type');
	$teaser_term_name = $teaser_term_obj->name;
	$teaser_term_url = get_term_link( $teaser_term_obj, 'film' );	
	
	$critique_term_obj = get_term_by('id', '3', 'type');
	$critique_term_name = $critique_term_obj->name;
	$critique_term_url = get_term_link( $critique_term_obj, 'film' );	
	
	$note_term_obj = get_term_by('id', '2', 'type');
	$note_term_name = $note_term_obj->name;
	$note_term_url = get_term_link( $note_term_obj, 'film' );	
?>
<section id="home_critique" class="home_flux critique_liste">
	<div class="wrap">
		<a href="<?php echo $critique_term_url; ?>" class="cat_permalien">
			<h2><?php echo $critique_term_name; ?><br><small>Voir l'ensemble des articles de cette catégorie</small></h2>
		</a>
		<?php article_derniers(get_field('home_article_critique_max'), 'home', '3'); ?>
	</div><!-- /.wrap -->
</section><!-- #home_critique -->

<section id="home_note" class="home_flux">
	<div class="wrap">
		<div id="home_note_last" class="column note_liste">
			<a href="<?php echo $note_term_url; ?>" class="cat_permalien">
				<h2><?php echo $note_term_name; ?><br><small>Voir l'ensemble des articles de cette catégorie</small></h2>
			</a>
			<?php article_derniers(get_field('home_article_avis_max'), 'home', '2'); ?>
		</div><!-- /#home_note_last -->

		<aside id="home_note_top_flop" class="column top_flop_widget">
			<div class="top_flop_widget-top">
				<a href="<?php echo $note_term_url; ?>?affichage=top" class="cat_permalien">
					<h2>Les mieux notés</h2>
				</a>
				<?php article_top_flop($limit = '4', $contexte = "home", 'DESC'); ?>
			</div><!-- /.top_flop_widget-top -->
			<div class="top_flop_widget-flop">
				<a href="<?php echo $note_term_url; ?>?affichage=flop" class="cat_permalien">
					<h2>Les moins bien notés</h2>
				</a>
				<?php article_top_flop($limit = '4', $contexte = "home", 'ASC'); ?>
			</div><!-- /.top_flop_widget-flop -->
		</aside>
	</div><!-- /.wrap -->
</section><!-- #home_note -->
<section id="home_teaser" class="home_flux teaser_liste">
	<div class="wrap">
		<a href="<?php echo $teaser_term_url; ?>" class="cat_permalien">
			<h2>(Très) <?php echo $teaser_term_name; ?><br><small>Voir l'ensemble des films à surveiller de près</small></h2>
		</a>
		<?php article_derniers(get_field('home_article_teaser_max'), 'home', '4'); ?>
	</div><!-- /.wrap -->
</section><!-- #home_teaser -->
<?php 
	get_footer();
?>