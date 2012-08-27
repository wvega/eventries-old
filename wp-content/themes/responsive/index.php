<?php get_header() ?>

                <section id="primary" class="span8">
                <?php if (have_posts()): ?>
                    <?php while (have_posts()): the_post() ?>
 
                    <?php if ('tribe_events' == get_post_type()): ?>
                        <?php get_template_part('content', 'event') ?>
                    <?php else: ?>
                        <?php get_template_part('content') ?>
                    <?php endif ?>

                    <?php endwhile ?>
                <?php endif ?>
                    <div id="paginate">
                        <?php wp_pagenavi(); ?>
                    </div>
                </section>

                <section id="secondary" class="span4">
                    <ul class="widget-list">
                        <?php dynamic_sidebar('main-right-sidebar') ?>
                    </ul>
                </section>
                
<?php get_footer() ?>