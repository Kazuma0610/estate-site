<?php get_header(); ?>

<section id="wrapper">
    
  <main id="main" class="container two-columns site-main">

    <div class="contents">
      <section class="mypage-contents">

      <?php if( is_user_logged_in() ) : ?>
        <!-- 会員向けコンテンツ -->
        <div class="mypage-pro">
          <h2>プロフィール</h2>
            <div class="pro-name">
              <p>ユーザー名：<?php global $current_user; echo $current_user->nickname ?></p>
            </div>
            <div class="pro-email">
              <p>ご登録メール：<?php global $current_user; echo $current_user->user_email ?></p>
            </div>
        </div>

        <div class="mypage-set">
          <h2>プロフィールの設定・変更</h2>
          <div class="set-short-code"><?php echo do_shortcode('[wpmem_profile]'); ?></div>
        </div>

        <div class="mypage-set-bk">
          <h2>お気に入りの物件</h2>
          <div>
            <?php echo do_shortcode('[user_favorites include_thumbnails ="true" include_buttons ="true" include_excerpts ="false"]'); ?>
          </div>
        </div>

        <div class="mypage-logout">
            <h2>ログアウト</h2>
            <div><?php echo do_shortcode('[wpmem_logout]ログアウトはこちら[/wpmem_logout]'); ?></div>
        </div>

        <div class="mypage-delete">
            <h2>退会</h2>
            <?php do_action('fudoukaiin_userlogin_success_other_link'); ?>
        </div>
      <?php else: ?>
        <!-- 非会員向けコンテンツ -->
        <div class="passreset">
          <div><?php echo do_shortcode('[wpmem_form password]'); ?></div>
        </div>
      <?php endif; ?>

       

      </section>


    </div><!--end contents-->

  </main><!--end main container-->

</section><!--wrapper-->
	              	        
<?php get_footer(); ?>