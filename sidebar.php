<aside id="sidebar" class="sidebar">

    <?php get_search_form(); ?>

    <section class="archive">
      <?php dynamic_sidebar('sidebar'); ?>
      <div class="news-area-content-sd">

          <h3><i class="fa-regular fa-newspaper"></i>最新のお知らせ</h3>
          <div class="news-content">
            <?php echo do_shortcode('[news_list]'); ?>
          </div>

      </div>
    </section>
    
</aside>