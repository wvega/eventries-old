<?php get_header() ?>

                <section id="primary" class="span8">
                    <div id="primary-inner">
                    <?php if (have_posts()): ?>

                        <?php Cycle::start(array('blue', 'purple', 'green')); ?>

                        <?php while (have_posts()): the_post() ?>

                        <div class="article-wrapper">
                        <?php if ('tribe_events' == get_post_type()): ?>
                            <?php get_template_part('content', 'event') ?>
                        <?php else: ?>
                            <?php get_template_part('content') ?>
                        <?php endif ?>
                        </div>

                        <?php endwhile ?>
                    <?php endif ?>
                    </div>

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