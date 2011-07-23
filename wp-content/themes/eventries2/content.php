	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php if ( is_sticky() ) : ?>
				<hgroup>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'eventries' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<h3 class="entry-format"><?php _e( 'Featured', 'eventries' ); ?></h3>
				</hgroup>
			<?php else : ?>
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'eventries' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<?php endif; ?>

			<?php if ( 'event' == get_post_type() ) : ?>
			<div class="entry-meta">
                <div class="eventoCreated">
                  <span class="date">20</span>
                  <span class="month">Oct</span>
                  <span class="year">2010</span>
                </div>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content clearfix">
            <div class="event-info">
                <?php if (is_one_day_event()) : ?>
                
                <time class="clearfix"><b>Fecha:</b> <span><?php the_start_date() ?></span></time>
                <time class="clearfix"><b>Hora:</b> <span><?php the_start_time() ?> &mdash; <?php the_end_time() ?></span></time>

                <?php else: ?>
                
                <time class="clearfix"><b>Fecha de Inicio:</b> <span><?php the_start_date() ?>, <?php the_start_time() ?></span></time>
                <time class="clearfix"><b>Fecha de Finalicación:</b> <span><?php the_end_date() ?>, <?php the_end_time() ?></span></time>

                <?php endif; ?>
                
                <div class="event-address clearfix"><b>Dirección:</b> <span><?php the_address() ?></span></div>
                
                <div class="url clearfix"><b>Sitio Web:</b> <span><?php the_url() ?></span></div>
            </div>
            
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'eventries' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'eventries' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
            <?php edit_post_link( __( 'Edit', 'eventries' ), '<span class="edit-link">', '</span>' ); ?>

			<?php if ( comments_open() ) : ?>
			<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a Reply', 'eventries' ) . '</span>', __( '<b>1</b> Reply', 'eventries' ), __( '<b>%</b> Replies', 'eventries' ) ); ?></span>
			<?php endif; // End if comments_open() ?>
			
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
