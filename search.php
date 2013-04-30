<?php get_header(); ?>

<div class="main-container">
    <div class="main wrapper clearfix">
    	<article>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				 <section>
				 	<h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
				 	<?php the_excerpt(); ?>
				</section>
			<?php endwhile; else: ?>
			<p class="missing-posts"><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			<?php endif; ?>
		</article>
	<?php get_sidebar(); ?>
    </div> <!-- #main -->
</div> <!-- #main-container -->
<?php get_footer(); ?>