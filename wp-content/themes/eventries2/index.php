        <?php get_header(); ?>
            <!-- mainbody -->
			<div id="mainbody">
				<!-- maininner -->
				<div id="maininner">
					<div id="slide">
						<img src="images/slide.png" alt="slide" />
					</div>
					<!-- eventosEventries -->
					<div id="eventosEventries">
						<h2 id="titulareventos">Eventos</h2>
						<!-- article -->
						<?php global $wp_query;
                        $args = array_merge( $wp_query->query, array( 'post_type' => 'event' ) ); 
                        query_posts( $args ); ?>
						<?php if (have_posts()) :
			                while (have_posts()) : the_post(); 
			            ?>
			            <article id="post-<?php the_ID(); ?>" class="hentry">
							<header>
								<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
							</header>						
							<div class="meta">
								<div class="eventoCreated">
						          <span class="date">20</span>
						          <span class="month">Oct</span>
						          <span class="year">2010</span>
						        </div>
							</div>
							<section>
								<!-- google_ad_section_start -->
				                <?php the_content('Leer el resto de la entrada &rarr;'); ?>
				                <!-- google_ad_section_end -->
							</section>
						</article>
						    <?php endwhile; ?>
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
