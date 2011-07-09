            <?php get_header(); ?>
            <!-- wrap -->
			<div id="wrap">
				<!-- contenido -->
				<div id="contenido">

			        <h2 id="search-title">Resultados de la b&uacute;squeda: "<?php the_search_query(); ?>"</h2>

			        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				        <!-- posts -->
				        <div id="post-<?php the_ID(); ?>" class="hentry">
					        <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
					        <div class="entry-content">
						        <!-- google_ad_section_start -->
							        <?php the_content('Leer el resto de la entrada &raquo;'); ?>
						        <!-- google_ad_section_end -->
					        </div>
				        </div>
				        <!-- /post -->
			        <?php endwhile; ?>

			        <div id="paginate">
				        <?php if(function_exists('wp_pagenavi')) : wp_pagenavi();  else :?>
			            <div class="navigation">
				            <div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
				            <div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
			            </div>
		                <?php endif ?>
			        </div>

			        <?php else : ?>
			        <div class="hentry entry">
				        <h2>Nothing found.</h2>
			        </div>
			        <?php endif; ?>
		        </div>
		        <!-- /contenido -->
		        <?php get_sidebar(); ?>
            <?php get_footer(); ?>
