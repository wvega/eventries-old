<?php
/**
* A previw single event. This displays the event information in the homepage
*/

$gmt_offset = (get_option('gmt_offset') >= '0' ) ? ' +' . get_option('gmt_offset') : " " . get_option('gmt_offset');
$gmt_offset = str_replace( array( '.25', '.5', '.75' ), array( ':15', ':30', ':45' ), $gmt_offset ); 

$title = get_the_title();
$category = Cycle::next(); // for development purposes
?>

<article id="post-<?php the_ID() ?>" <?php post_class($category) ?>>
    <?php $thumbnail = (mt_rand(0,100) / 100) < 0.3/*has_post_thumbnail()*/ ?>
    <header<?php echo $thumbnail ? '' : ' class="no-thumbnail"' ?>>
        <?php $title = get_the_title() ?>
        <div class="event-meta-start clearfix">
            <meta itemprop="startDate" content="<?php echo tribe_get_start_date( null, false, 'Y-m-d-h:i:s' ); ?>"/>
            <span class="event-label-start"><?php echo __('fecha del evento') ?></span><span><?php echo tribe_get_start_date(); ?></span>
        </div>
        
        <div class="entry-title-wrapper clearfix">
            <h1 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php echo esc_attr($title) ?>"><?php echo $title ?></a></h1>
            <a href="#" class="entry-category" title="<?php echo esc_attr($title) ?>">
                <?php echo $category ?>
            </a>
        </div>
        
        <?php if ($thumbnail): ?>
        <div class="entry-thumbnail">
            <?php //$src = array_shift(wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full')) ?>
            <?php $src = EventriesTheme::instance()->getRandomFlickrImage() ?>
            <a href="<?php the_permalink() ?>" title="<?php echo esc_attr($title) ?>">
                <img src="<?php echo esc_attr($src) ?>" />
            </a>
        </div>
        <?php endif ?>
    </header>

    <div class="entry-summary">
        <?php the_excerpt() ?>
    </div>

    <footer></footer>
</article>
