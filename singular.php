<?php get_header(); ?>

<section id="wrapper">
    
  <main id="main" class="container two-columns site-main">

    <div class="contents">


        <?php

            while ( have_posts() ) :
              
                the_post();

                get_template_part('template-parts/content');
                if ( comments_open() || get_comments_number() ) { ?>
                    <div id="comments" class="comments-area">
                      <?php comments_template(); ?>
                    </div><!-- #comments --><?php
                }

            endwhile;
        ?>


    </div><!--end contents-->

    <?php get_sidebar(); ?>

  </main><!--end main container-->

</section><!--wrapper-->
	              	        
<?php get_footer(); ?>