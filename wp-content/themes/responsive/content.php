                    <article id="post-<?php the_ID() ?>" <?php post_class() ?>>
                        <header>
                            <h1 class="entry-title"><?php the_title() ?></h1>
                            <img class="featured-image" src="http://farm6.staticflickr.com/5276/5862226909_829eee65b5_z.jpg" width="604px" height="150px"/>
                        </header>

                        <div class="entry-summary">
                            <?php the_content() ?>
                        </div>
                    
                        <footer></footer>
                    </article>