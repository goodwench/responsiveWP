<?php get_header(); ?>

<div class="main-container">
    <div class="main wrapper clearfix">
    	<article>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				 <section>
				 	<h2><?php the_title(); ?></h2>
				 	<div class="thumbnail">
				 		<?php if ( has_post_thumbnail() ) {
				 				the_post_thumbnail();
				 			}
				 		?>
				 	</div>					
				 	<?php the_content(); ?>
				 	<?php edit_post_link('Edit this entry','','.'); ?>
				</section>
			<?php endwhile; else: ?>
			<p class="missing-posts"><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
		</article>
	<?php get_sidebar(); ?>
    </div> <!-- #main -->
</div> <!-- #main-container -->
<?php get_footer(); ?>