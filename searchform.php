<form method="get" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
  <input type="text" placeholder="キーワード検索" name="s" class="searchfield" value="" />
  <button type="submit" value="submit" class="searchsubmit">
    <span class="material-symbols-outlined"><img src="<?php echo esc_url(get_theme_file_uri('images/search.png')); ?>" alt=""></span>
  </button>
</form>