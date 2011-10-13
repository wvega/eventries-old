	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'eventries' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		</header><!-- .entry-header -->

		<div class="entry-content clearfix">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'eventries' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'eventries' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
            <?php edit_post_link( __( 'Edit', 'eventries' ), '<span class="edit-link">', '</span>' ); ?>

			<?php if ( comments_open() ) : ?>
			<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a Reply', 'eventries' ) . '</span>', __( '<b>1</b> Reply', 'eventries' ), __( '<b>%</b> Replies', 'eventries' ) ); ?></span>
			<?php endif; // End if comments_open() ?>
			
		</footer><!-- #entry-meta -->
	</article><!-- #post-<?php the_ID(); ?> -->
