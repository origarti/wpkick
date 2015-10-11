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
				<div class="wrap" style="background-image:url(<?php bloginfo('template_url'); ?>/pic/403.jpg);"></div><!-- /.wrap -->	
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
					<h1>Page 403</h1>
					<p>Accès interdit ! On vous conseille de faire demi-tour le plus vite possible ! </p>
				</div><!-- /.wrap -->
			</div><!-- /.article_contenu -->

		</article>
					
		
	
	

			
		
</main><!-- #content -->

<?php 
	get_footer();
?>