        <?php get_header(); ?>
            <!-- mainbody -->
			<div id="mainbody">
				<!-- maininner -->
				<div id="maininner">
					<div id="slide">
						<!--<img src="images/slide.png" alt="slide" />-->
					</div>
					<!-- eventosEventries -->
					<div id="eventosEventries">
						<!--<h2 id="titulareventos">Eventos</h2>-->
						<!-- article -->
						<?php global $wp_query;
                        $args = array_merge( $wp_query->query, array( 'post_type' => 'event' ) ); 
                        query_posts( $args ); ?>
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
						<!-- /article -->
						<div id="paginate">
				            <?php wp_pagenavi(); ?>
			            </div>
					</div>
					<!-- /eventosEventries -->
				</div>
				<!-- /maininner -->
				<?php get_sidebar(); ?>
