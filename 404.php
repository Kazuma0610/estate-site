<?php get_header();?>


<section id="wrapper">
    
  <main id="main" class="container two-columns site-main">

    <div class="contents">


    <div class="page-404">
      <h1 class="title-header">404 NOT FOUND</h1>
      <p class="p-404">お探しのページは見つかりませんでした</p>
      <?php // トップに戻るボタン ?>
        <a class="top-link" href="<?php echo esc_url( home_url( '/' ) ); ?>">トップに戻る</a>
      <?php get_search_form(); // 検索フォーム ?>
    </div>


    </div><!--end contents-->

    <?php get_sidebar(); ?>

  </main><!--end main container-->

</section><!--wrapper-->


<?php get_footer();