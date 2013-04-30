<section>
	<h3><?php echo get_the_title(); ?></h3>
	<?php wp_nav_menu( array
	        (
	          'theme_location'  => 'nav',
	          'container'       => 'ul', 
	          'container_class' => 'menu-{menu slug}-container', 
	          'menu_id'    => 'top-nav',
	          'menu_class'      => 'main-nav', 
	          'echo'            => true,
	          'fallback_cb'     => 'wp_page_menu',  
	        )
	    );
	?>  
</section>	