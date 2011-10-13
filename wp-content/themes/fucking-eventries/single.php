            <?php get_header(); ?>
            <!-- wrap -->
			<div id="wrap">
				<!-- contenido -->
				<div id="contenido">
				<?php if (have_posts()) : ?>
		            <?php while (have_posts()) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" class="hentry">
						<h2 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
						<div class="entry-content">
						    <!-- google_ad_section_start -->
						    <?php the_content('Leer el resto de la entrada &raquo;'); ?>
						    <!-- google_ad_section_end -->
						</div>
					</div>
					
					<?php comments_template('', true); ?>
					<?php endwhile; ?>
		            <?php if(function_exists('wp_pagenavi')) : wp_pagenavi();  else :?>
			            <div class="navigation">
				            <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
				            <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
			            </div>
		            <?php endif ?>
		
	            <?php else : ?>
		            <h2 class="center">Not Found</h2>
		            <p class="center">Sorry, but you are looking for something that isn't here.</p>
		            <?php get_search_form(); ?>
	            <?php endif; ?>				
				</div>
				<!-- /contenido -->
				<?php get_sidebar(); ?>
            <?php get_footer(); ?>			
