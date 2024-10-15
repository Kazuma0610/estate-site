<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

          <?php
            $cat = get_the_category();
            $catname = $cat[0]->cat_name;
          ?>

          <h2 class="article-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>

          <ul class="meta">
            <li><?php the_time('Y/m/d'); ?></li>
            <li><?php echo $catname; ?></li>
          </ul>

          <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
          
          <div class="text">
            <?php
              if (mb_strlen(strip_tags(get_the_content()), 'UTF-8') > 20) {
                  $content = mb_substr(strip_tags(get_the_content()), 0, 20, 'UTF-8');
                  echo $content . '…';
                } else {
                  echo strip_tags(get_the_content());
                }
            ?>
          </div>

          <div class="readmore"><a href="<?php the_permalink(); ?>">READ MORE</a></div>

</article><!--#post-<?php the_ID(); ?> -->