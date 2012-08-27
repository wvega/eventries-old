<?php
/**
*  If 'Default Events Template' is selected in Settings -> The Events Calendar -> Theme Settings -> Events Template, 
*  then this file loads the page template for all for the individual 
*  event view.  Generally, this setting should only be used if you want to manually 
*  specify all the shell HTML of your ECP pages in this template file.  Use one of the other Theme 
*  Settings -> Events Template to automatically integrate views into your 
*  theme.
*
* You can customize this view by putting a replacement file of the same name (ecp-single-template.php) in the events/ directory of your theme.
*/ ?>

<?php get_header() ?>

                <section id="primary" class="span6">
                    <article id="post-<?php the_ID() ?>" <?php post_class() ?>>
                        <header>
                            <h1 class="entry-title"><?php the_title() ?></h1>
                        </header>
                        <div class="entry-content"><?php include(tribe_get_current_template()) ?></div>
                    </article>
                </section>
                
<?php tribe_events_after_html() ?>
<?php get_footer() ?>

        <?php /*the_post(); global $post; ?>
        <div id="post-<?php the_ID() ?>" <?php post_class() ?>>
            <h2 class="entry-title"><?php the_title() ?></h2>
            <?php include(tribe_get_current_template()) ?>
            <?php edit_post_link(__('Edit','tribe-events-calendar'), '<span class="edit-link">', '</span>'); ?>
        </div><!-- post -->
        <?php if(tribe_get_option('showComments','no') == 'yes'){ comments_template();} ?>
    </div><!-- #content -->
</div><!--#container-->
<?php get_sidebar(); ?>
<?php tribe_events_after_html() ?>
<?php get_footer(); ?>*/
