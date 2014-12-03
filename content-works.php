<?php
/**
 * @package portfolio
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	 

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php
	    /* translators: used between list items, there is a space after the comma */
	    $category_list = get_the_category_list( __( ', ', 'portfolio' ) );

	    if ( portfolio_categorized_blog() ) {
	        echo '<div class="category-list">' . $category_list . '</div>';
	    }
		?>
	     
		

		<div class="entry-meta">
			<?php portfolio_posted_on(); ?>
			
			<?php 
			    if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) { 
			        echo '<span class="comments-link">';
			        comments_popup_link( __( 'Leave a comment', 'portfolio' ), __( '1 Comment', 'portfolio' ), __( '% Comments', 'portfolio' ) );
			        echo '</span>';
			    }
			?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'portfolio' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php portfolio_entry_footer(); ?>
		<?php
		    echo get_the_tag_list( '<ul><li><i class="fa fa-tag"></i>', '</li><li><i class="fa fa-tag"></i>', '</li></ul>' );
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
