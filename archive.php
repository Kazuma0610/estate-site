<?php get_header(); ?>

<section id="wrapper">
    
  <main id="main" class="container two-columns site-main">

    <div class="contents">


        <header class="page-header">
          <?php the_archive_title('<h1 class="page-title-archive">', '</h1>'); ?>
        </header><!-- .page-header -->

        <?php if ( have_posts() ) : ?>

                    
        <div class="archive-flex">
          
          <?php
            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/excerpt' );  
          ?>

          

          <?php endwhile; ?>

          <?php else : ?>
            <p>まだ投稿はありません。</p>
          <?php endif; ?>

        </div><!--archive-flex-->

        <?php
            if (function_exists("pagination")) {
              pagination($wp_query->max_num_pages);
            }
        ?>


    </div><!--end contents-->

    <!--<?php get_sidebar(); ?>-->

  </main><!--end main container-->

</section><!--wrapper-->
	              	        
<?php get_footer(); ?>