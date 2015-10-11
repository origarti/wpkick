<?php

if ( post_password_required() ) {
	return;
}
?>

<div id="comments">
	<div class="wrap">
		
	
		
		<div class="accordeon-header">
			<h3 class="comments-title">
				<?php
					printf( _n( '<strong>%2$s</strong> <span>1 commentaire</span>', '<strong>%2$s</strong> <span>%1$s commentaire(s)</span>', get_comments_number(), 'cinezine' ),
						number_format_i18n( get_comments_number() ), get_the_title() );
				?>
			</h3>
		</div><!-- /.accordeon-header -->
		<div class="accordeon-body">
			
		
			<div class="comment-form-container">
				<?php comment_form(); ?>
			</div><!-- /.comment-form-container -->	
			<?php if ( have_comments() ) : ?>
			<div class="comment-container">
				<div class="comment-container-overflow">
					<ol class="comment-list">
						<?php
							wp_list_comments( array(
								'style'      => 'ol',
								'short_ping' => true,
								'avatar_size'=> 34,
							) );
						?>
					</ol><!-- .comment-list -->
				</div><!-- /.comment-container-overflow -->
				

				<?php if ( ! comments_open() ) : ?>
				<p class="no-comments"><?php _e( 'Comments are closed.', 'cinezine' ); ?></p>
				<?php endif; ?>

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
					<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
						<h3 class="screen-reader-text"><?php _e( 'Comment navigation', 'cinezine' ); ?></h3>
						<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'cinezine' ) ); ?></div>
						<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'cinezine' ) ); ?></div>
					</nav><!-- #comment-nav-above -->
				<?php endif; // Check for comment navigation. ?>

	
			</div><!-- /.comment-container -->	
			<?php endif; // have_comments() ?>
		</div><!-- /.accordeon-body -->
	</div><!-- /.wrap -->

</div><!-- #comments -->