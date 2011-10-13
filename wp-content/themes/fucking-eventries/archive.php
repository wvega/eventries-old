            <?php get_header(); ?>
            <!-- wrap -->
			<div id="wrap">
				<!-- contenido -->
				<div id="contenido">
				<?php if (have_posts()) : ?>
			        <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
			        <?php /* If this is a category archive */ if (is_category()) { ?>
			        <h2 id="search-title">Archivos para la Categoria: <?php single_cat_title(); ?></h2>
			        <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
			        <h2 id="search-title">Entradas taggeadas como: <?php single_tag_title(); ?></h2>
			        <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
			        <h2 id="search-title">Archivo para <?php the_time('F jS, Y'); ?></h2>
			        <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
			        <h2 id="search-title">Archivo para <?php the_time('F, Y'); ?></h2>
			        <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
			        <h2 id="search-title">Archivo para <?php the_time('Y'); ?></h2>
			        <?php /* If this is an author archive */ } elseif (is_author()) { ?>
			        <h2 id="search-title">Author Archive</h2>
			        <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			        <h2 id="search-title">Blog Archives</h2>
			        <?php } ?>
			        
			        <?php while (have_posts()) : the_post(); ?>
			        <div id="post-<?php the_ID(); ?>" class="hentry">
				        <h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				       <div class="entry-content">
					        <!-- google_ad_section_start -->
					         <?php the_content('Leer el resto de la entrada &raquo;'); ?>
					        <!-- google_ad_section_end -->
				        </div>
				        <span class="info-post"><?php the_tags('', ', ', ''); ?></span>
			        </div>
			        <!-- /post -->
			        <?php endwhile; ?>

                <?php else :
			        if ( is_category() ) { // If this is a category archive
				        printf("<h2 class=\"archive-title\">Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
			        } else if ( is_date() ) { // If this is a date archive
				        echo("<h2 id=\"search-title\">Sorry, but there aren't any posts with this date.</h2>");
			        } else if ( is_author() ) { // If this is a category archive
				        $userdata = get_userdatabylogin(get_query_var('author_name'));
				        printf("<h2 id=\"search-title\">Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
			        } else {
				        echo("<h2 id=\"search-title\">No posts found.</h2>");
			        }
			        //volver al inicio
			        endif;
		        ?>
		        </div>
				<!-- /contenido -->
				<?php get_sidebar(); ?>
            <?php get_footer(); ?>	
