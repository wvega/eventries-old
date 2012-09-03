<article id="post-<?php the_ID() ?>" <?php post_class() ?>>
    <header>
        <?php $title = get_the_title() ?>
        <?php if (true || has_post_thumbnail()): ?>
        <div class="event-date"></div>
        <div class="entry-thumbnail">
            <?php //$src = array_shift(wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full')) ?>
            <?php $src = EventriesTheme::instance()->getRandomFlickrImage() ?>
            <a href="<?php the_permalink() ?>" title="<?php echo esc_attr($title) ?>">
                <img src="<?php echo esc_attr($src) ?>" />
            <!--<img class="featured-image" src="http://farm6.staticflickr.com/5276/5862226909_829eee65b5_z.jpg"/>-->
            </a>
        </div>
        <?php endif ?>
        <h1 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php echo esc_attr($title) ?>"><?php echo $title ?></a></h1>
    </header>

    <div class="entry-summary">
        <?php the_excerpt() ?>
    </div>

    <footer></footer>
</article>