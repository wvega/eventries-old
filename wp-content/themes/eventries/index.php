        <?php get_header(); ?>
            <!-- mainbody -->
			<div id="mainbody">
				<!-- maininner -->
				<div id="maininner">
				    <div id="maininnerp">
					    <?php if (is_home()) : ?>
					    <div id="slide">
						    <!--<img src="images/slide.png" alt="slide" />-->
					    </div>
					    <?php endif; ?>
					    <!-- eventosEventries -->
					    <div id="eventosEventries">
					        
                        <?php //debug(todays_events()) ?>
                    <?php // Solo mostramos Events en el homepage.
                          // TODO: actualmente se hace doble consulta a la base de datos:
                          // la primera para trear los posts normales y la segunda al
                          // ejecutar query_posts en las líneas siguientes. Esto es ineficiente. ?>
					        <?php if (is_home()) {
                                global $wp_query;
                                $args = array_merge( $wp_query->query, array( 'post_type' => 'event' ) ); 
                                query_posts( $args );
                            } ?>
                            
						    <?php if (have_posts()) : ?>
						      <?php while (have_posts()) : the_post(); ?>
                                
                                <?php if (is_single()) {
                                    get_template_part('content', 'single');
                                } else if (is_page()) {
                                    get_template_part('content', 'page');
                                } else {
                                    get_template_part('content', get_post_format());
                                } ?>
                                
						    <?php  endwhile; ?>
			                <?php endif; ?>
			                
					    </div>
					    <!-- /eventosEventries -->
                    </div>
                    <div id="paginate">
				        <?php wp_pagenavi(); ?>
			        </div>
				</div>
				<!-- /maininner -->
				<?php get_sidebar(); ?>
				
            <?php get_footer() ?>