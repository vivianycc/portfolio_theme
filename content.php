<?php
/**
 * @package portfolio
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="index-box">
		<?php 
	    if (has_post_thumbnail()) {
	        echo '<div class="small-index   -thumbnail clear">';
	        echo '<a href="' . get_permalink() . '" title="' . __('Click to see ', 'portfolio') . get_the_title() . '" rel="bookmark">'; 
	        echo the_post_thumbnail('index-thumb');
	        echo '</a>';
	        echo '</div>';
	    }
		?> 
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php portfolio_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
				/* translators: %s: Name of current post */
				the_excerpt();
			?>

			
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php portfolio_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div> <!-- index box close -->
</article><!-- #post-## -->