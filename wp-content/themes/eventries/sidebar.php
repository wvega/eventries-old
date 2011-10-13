                <!-- sidebar -->
				<div id="sidebar">
					<aside id="buscador">
						<form action="" method="">
				            <input type="text" placeholder="buscar" id="search" name="s">
				            <input type="hidden" value="">
				        </form>
					</aside>
					<aside id="lastevents">
						<h3>Próximos Eventos</h3>
						<?php $query = upcoming_events(); ?>
                        <ul>
                        <?php while($query->have_posts()): $query->the_post() ?>
							<li><a href="<?php the_permalink() ?>" title="<?php esc_attr_e(get_the_title()) ?>"><?php echo the_title() ?></a></li>
					   <?php endwhile ?>
						</ul>
					</aside>
					<aside id="lastevents">
						<h3>Today's Events</h3>
						<?php $query = todays_events(); ?>
                        <ul>
                        <?php while($query->have_posts()): $query->the_post() ?>
							<li><a href="<?php the_permalink() ?>" title="<?php esc_attr_e(get_the_title()) ?>"><?php echo the_title() ?></a></li>
					   <?php endwhile ?>
						</ul>
					</aside>
				</div>
				<!-- /sidebar -->
			</div>
			<!-- /mainbody -->
