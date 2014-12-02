<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package portfolio
 */

get_header(); ?>

	<div id="primary" class="content-area">
<nav class="filter-boxes">
                <div class="tax-stack">
                    <h3 class="filter-title">Year </h3>
                    <div class = "option-set">
                        <ul>
                        <?php
                        $terms = get_terms( 'year', array( 'hide_empty' => true ) );
                        
                        if (!empty( $terms ) && !is_wp_error( $terms ) ){
                            foreach( $terms as $term){ ?>
                                <li>
                                    <input type="checkbox" value=".<?php echo $term->slug; ?>" id="<?php echo $term->slug; ?>" />
                                    <label for="<?php echo $term->slug; ?>"><?php  echo $term->name; ?></label>
                                </li>
                            <?php
                            }
                        }
                        ?>   
                        </ul>
                    </div>
                    <h3 class="filter-title">Type</h3>
                    <div class = "option-set">
                        <ul>
                        <?php
                        $terms = get_terms( 'type', array( 'hide_empty' => true ) );
                        
                        if (!empty( $terms ) && !is_wp_error( $terms ) ){
                            foreach( $terms as $term){ ?>
                                <li>
                                    <input type="checkbox" value=".<?php echo $term->slug; ?>" id="<?php echo $term->slug; ?>" />
                                    <label for="<?php echo $term->slug; ?>"><?php  echo $term->name; ?></label>
                                </li>
                            <?php
                            }
                        }
                        ?>   
                        </ul>
                    </div>   
                   
                    
                </div>
            </nav>
		<main id="main" class="site-main works-index" role="main">


		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				
			</header><!-- .page-header -->
			

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				

				<?php
                            // Do we have a featured image? If so, display it
                            if (has_post_thumbnail()){
                            ?>
                            <article class="works-item <?php echo custom_taxonomies_terms_links($post->ID); ?>">
                                <figure class="index-works">
                                    <a href="<?php echo get_the_permalink(); ?>" title="Click and See <?php echo esc_attr(get_the_title()); ?>">
                                        <?php the_post_thumbnail('works-thumb'); ?>
                                    </a>
                                </figure>
                            </article>
                            <?php
                            }
                            ?>


			<?php endwhile; ?>

			<?php portfolio_paging_nav(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
		
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
