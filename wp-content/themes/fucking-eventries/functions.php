<?php
function mytheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<div class="comment-author">
			<a class="avatar"><?php echo get_avatar($comment,$size='40',$default='images/gravatar-theme.png'); ?></a>
			<span class="commentauthor"><?php comment_author_link() ?></span>
			<span class="commentdata"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F jS, Y') ?></a></span>				
		</div>
		<div class="comment-content">
			<?php comment_text() ?>
			<?php if ($comment->comment_approved == '0') : ?>
				<em id="approve">Tu comentario est&aacute; en espera de ser moderado.</em>
			<?php endif; ?>
			<span class="comm-reply"></span>
		</div>		
	</li>
<?php
        }
function mytheme_ping($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
		<div class="comment-bot">
			<span class="commentauthor"><?php comment_author_link() ?></span>
			<span class="commentdata"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F jS, Y') ?> on <?php comment_time() ?></a></span>			
		</div>
	</li>
<?php
        }
?>
<?php
function get_last_events( $no_events ){
    global $wpdb;
    $sql = "SELECT eventTitle, postID, eventDescription, eventStartDate 
    FROM wp_eventscalendar_main 
    WHERE TIMESTAMP(eventStartDate,eventStartTime) >= NOW()
    ORDER BY eventStartDate ASC, eventStartTime ASC
    LIMIT $no_events";
    
    $events = $wpdb->get_results( $sql );
    $output = '';
    foreach ($events as $event) {
        $permalink = get_permalink( $event->postID );
        $event_title = $event->eventTitle;
        $event_description = $event->eventDescription;
        $output .= '<h4><a href="' . esc_url( $permalink ) . '" rel="bookmark" title="' . esc_attr( $event_title ) . '">' . esc_html( $event_title ) . '</a></h4>'.
        '<p>' .$event_description. '</p>'.
        '<p id="see-more"><a href="' . esc_url( $permalink ) . '" title="' . esc_attr( $event_title ) . '">Ver m&aacute;s sobre este evento...</a></p>';
    }
    echo $output;
}
?>
