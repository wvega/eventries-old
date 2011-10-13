<?php
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Por favor, no cargue esta p&aacute;gina directamente, gracias!');

	if ( function_exists("post_password_required") && post_password_required() ) { ?>
		<p class="nocomments">Este post est&aacute; protegido con contrase&ntilde;a. Introduzca la contrase&ntilde;a para ver los comentarios.</p>
	<?php
		return;
	} else if ( !function_exists("post_password_required") && !empty($post->post_password) && $_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password ) { ?>
		<p class="nocomments">Este post est&aacute; protegido con contrase&ntilde;a. Introduzca la contrase&ntilde;a para ver los comentarios.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<!-- comments -->
<div id="comments">
<?php if ( have_comments() ) : ?>
	<?php if ( !empty($comments_by_type['comment']) ) : ?>
		<h3 id="comment-title"><?php comments_number('Sin Comentarios', 'Un Comentario', '% Comentarios' );?></h3>
		<ol id="commentlist">
			<?php wp_list_comments('type=comment&callback=mytheme_comment'); ?>		
		</ol>
	<?php endif; ?>

	<?php if ( !empty($comments_by_type['pings']) ) : ?>
		<h3 id="pings-title">Trackbacks/Pingbacks</h3>
		<ol id="pinglist">
			<?php wp_list_comments('type=pings&callback=mytheme_ping'); ?>
		</ol>
	<?php endif; ?>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

	<?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
	<!-- If comments are open, but there are no comments. -->
	
	<?php else : // comments are closed ?>
	<!-- If comments are closed. -->
	<p class="nocomments">Los comentarios están cerrados</p>

	<?php endif; ?>
<?php endif; ?>
</div>
<!-- /comments -->

<?php if ('open' == $post->comment_status) : ?>
<!-- respond -->
<div id="respond">
	<h3>Comentar</h3>
	<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
		<p id="logged">You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>

	<form id="commentform" name="respond" method="post" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php">
		<?php if ( $user_ID ) : ?>
	
		<p id="userlog">Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Salir &rarr;</a></p>
		<?php else : ?>
			<p>
			    	<span id="left">
			    		<label for="author">Nombre <?php if ($req) echo "(requerido)"; ?></label>
			    		<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" <?php if ($req) echo "aria-required='true'"; ?> tabindex="1" />
			    	</span>
				<span id="right">
					<label for="email">Email <?php if ($req) echo "(requerido)"; ?></label>
		   			<input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" <?php if ($req) echo "aria-required='true'"; ?> tabindex="2" />
				</span>
			</p>
			<p>
				<label for="url">Sitio Web</label>
				<input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" tabindex="3" />
			</p>
		<?php endif; ?>
			<p>
				<label for="comment">Comentario</label>
				<textarea rows="7" cols="100%" id="comment" name="comment" tabindex="4"></textarea>
			</p>
			<p><input type="submit" name="submit" id="submit" value="Enviar &rarr;" tabindex="5" /><?php comment_id_fields(); ?>
			</p>
		<?php do_action('comment_form', $post->ID); ?>
	</form>
	<?php endif; // If registration required and not logged in ?>
</div>
<!-- respond -->
<?php endif; // if you delete this the sky will fall on your head ?>
