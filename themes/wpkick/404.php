<?php 
	get_header();
	
?>
<main id="content" class="has_header">
		
		
			
		
		<article>
			<!-- <header>
				<div class="wrap">
					<img src="<?php bloginfo('template_url'); ?>/pic/404.jpg" alt="Erreur 404">
				</div>
			</header> --><!-- /.article_header -->
			<header class="article_header">
				<div class="wrap" style="background-image:url(<?php bloginfo('template_url'); ?>/pic/404.jpg);"></div><!-- /.wrap -->	
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
					<h1>Page 404</h1>
					<p>Vous venir d'atterir sur la mauvaise page. La page que vous cherchez s'est sans doute envolée ! </p>
				</div><!-- /.wrap -->
			</div><!-- /.article_contenu -->

		</article>
					
		
	
	

			
		
</main><!-- #content -->

<?php 
	get_footer();
?>