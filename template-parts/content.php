<article id="post-<?php the_ID(); ?>"<?php post_class(); ?>>

    <header class="entry-header">
        
        <?php the_title('<h1 class="entry-title">','</h1>'); ?>


        <?php if ( is_singular('post')) { ?>
            
            <div class="date-flex">
                <i class="fas fa-sync-alt"></i><?php the_date('','' ); ?>
                <i class="fas fa-folder"></i><?php the_category(','); ?>
            </div>
            
        <?php } // is_singlar('post') ?>

        <?php if ( is_singular('news')) { ?>
            <div class="date-flex">
                <i class="fas fa-sync-alt"></i><?php the_date('','' ); ?>
            </div>
        <?php } // is_singlar('news') ?>

    </header><!--entry-header-->

    <figure class="post-thumbnail">
        <?php the_post_thumbnail(); ?>
    </figure><!--.post-thumbnail-->

    <?php the_tags( '<span class="tags-links">', '', '</span>' ); ?>

    <div class="entry-content">
        <?php
        the_content();//本文表示
        //カスタムフィールドは設定なし
        wp_link_pages(
            [
                'before' => '<div class="page-links">ページ:',
                'after' => '</div>',
            ]
        ); ?>

        <?php if (is_singular('post')) { ?>
            <footer class="entry-footer">
                <i class="fas fa-folder-open"></i><span class="cat-links"><?php the_category(','); ?></span>
            </footer><!--.entry-footer -->
        <?php } // is_singlar('post') ?>

        <!--メインクエリはまだ未設定-->

    </div><!--entry-content-->

</article><!--#post-<?php the_ID(); ?>-->