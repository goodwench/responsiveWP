<?php get_header(); ?>

<div class="main-container">
    <div class="main wrapper clearfix">
    	<article>
			<h2>Uh Oh!</h2>
			<p>We could find what you were looking for. Try a search instead.</p>
			<section>
				<?php get_search_form(); ?>
			</section>
		</article>
	<?php get_sidebar(); ?>
    </div> <!-- #main -->
</div> <!-- #main-container -->
<?php get_footer(); ?>