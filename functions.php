<?php

// bodyclassにクラス名を追加
add_filter( 'body_class', function( $classes ){
  $classes[] = 'my-body-class';
  return $classes;
} );


//テーマのセットアップ
// HTML5でマークアップさせる
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
// Feedのリンクを自動で生成する
add_theme_support( 'automatic-feed-links' );
//アイキャッチ画像を使用する設定
add_theme_support( 'post-thumbnails' );


/*ヘッダーのナビゲーションの登録*/
register_nav_menus([
  'global_nav' => 'グローバルナビ',
  'hamburger_nav' => 'ハンバーガーナビ',
  'footer_nav' => 'フッターナビ',
]);


//CDN形式のCSSとJSの読み込み
function add_my_files() {
  wp_enqueue_style(
  'fontawesome4.7',  //$handle
  '//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'  //$src
  );
  wp_enqueue_style(
    'fontawesome5.15.4',  //$handle
    '//use.fontawesome.com/releases/v5.15.4/css/all.css'  //$src
    );
  wp_enqueue_style(
    'fontawesome6.5.1',  //$handle
    '//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css'  //$src
    );
  wp_enqueue_style(
    'swiper9',  //$handle
    '//cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css'  //$src
    );
  wp_enqueue_style(
    'bxslider',  //$handle
    '//cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css'  //$src
    );
  wp_enqueue_script(
    'jquery3.1.1',  //$handle
    '//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js',  //$src
    array(),  //$deps
    null,  //$ver
    true  //$in_footer
    );
  wp_enqueue_script(
    'jquery3.4.1',  //$handle
    '//code.jquery.com/jquery-3.4.1.min.js',  //$src
    array(),  //$deps
    null,  //$ver
    true  //$in_footer
    );
  wp_enqueue_script(
    'swiper9',  //$handle
    '//cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js',  //$src
    array(),  //$deps
    null,  //$ver
    true  //$in_footer
    );
  wp_enqueue_script(
    'bxslider',  //$handle
    '//cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js',  //$src
    array(),  //$deps
    null,  //$ver
    true  //$in_footer
    );
}
add_action( 'wp_enqueue_scripts', 'add_my_files' );




//CSSとJSの読み込み
function my_enqueue_scripts()
{
  $version = wp_get_theme()->get( 'Version' );
  wp_enqueue_style('index-style', get_template_directory_uri() . '/css/index.css', array(), $version);
  wp_enqueue_style('top-contents-style', get_template_directory_uri() . '/css/top-contents.css', array(), $version);
  wp_enqueue_style('singular-style', get_template_directory_uri() . '/css/singular.css', array(), $version);
  wp_enqueue_style('header-style', get_template_directory_uri() . '/css/header.css', array(), $version);
  wp_enqueue_style('content-style', get_template_directory_uri() . '/css/content.css', array(), $version);
  wp_enqueue_style('archive-style', get_template_directory_uri() . '/css/archive.css', array(), $version);
  wp_enqueue_style('comments-style', get_template_directory_uri() . '/css/comments.css', array(), $version);
  wp_enqueue_style('404-style', get_template_directory_uri() . '/css/404.css', array(), $version);
  wp_enqueue_style('search-form-style', get_template_directory_uri() . '/css/searchform.css', array(), $version);
  wp_enqueue_style('search-style', get_template_directory_uri() . '/css/search.css', array(), $version);
  wp_enqueue_style('sidebar-style', get_template_directory_uri() . '/css/sidebar.css', array(), $version);
  wp_enqueue_style('archive-rent-style', get_template_directory_uri() . '/css/archive-rent.css', array(), $version);
  wp_enqueue_style('single-rent-style', get_template_directory_uri() . '/css/single-rent.css', array(), $version);
  wp_enqueue_style('button-style', get_template_directory_uri() . '/css/button.css', array(), $version);
  wp_enqueue_style('modal-style', get_template_directory_uri() . '/css/modal.css', array(), $version);
  wp_enqueue_style('mypage-style', get_template_directory_uri() . '/css/mypage.css', array(), $version);
  wp_enqueue_style('login-style', get_template_directory_uri() . '/css/login.css', array(), $version);
  wp_enqueue_style('navi-style', get_template_directory_uri() . '/css/navi.css', array(), $version);
  wp_enqueue_style('navi-accordion-style', get_template_directory_uri() . '/css/navi-accordion.css', array(), $version);
  wp_enqueue_style('move-text-style', get_template_directory_uri() . '/css/move-text.css', array(), $version);
  wp_enqueue_style('blog-news-style', get_template_directory_uri() . '/css/blog-news.css', array(), $version);
  wp_enqueue_style('contact-style', get_template_directory_uri() . '/css/contact.css', array(), $version);
  wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js', array('jquery'), $version, true);
  wp_enqueue_script('bxslider-script', get_template_directory_uri() . '/js/bxslider.js', array('jquery'), $version, true);
  wp_enqueue_script('swiper-script', get_template_directory_uri() . '/js/swiper.js', array('jquery'), $version, true);
  wp_enqueue_script('tab-script', get_template_directory_uri() . '/js/tab.js', array('jquery'), $version, true);
  wp_enqueue_script('map-script', get_template_directory_uri() . '/js/map.js', array('jquery'), $version, true);
  wp_enqueue_script('modal-script', get_template_directory_uri() . '/js/modal.js', array('jquery'), $version, true);
  wp_enqueue_script('navi-script', get_template_directory_uri() . '/js/navi.js', array('jquery'), $version, true);
  wp_enqueue_script('move-text-script', get_template_directory_uri() . '/js/move-text.js', array('jquery'), $version, true);
  wp_enqueue_script('more-script', get_template_directory_uri() . '/js/more.js', array('jquery'), $version, true);
  wp_enqueue_script('page-top-script', get_template_directory_uri() . '/js/page-top.js', array('jquery'), $version, true);
}
add_action('wp_enqueue_scripts', 'my_enqueue_scripts');


function post_has_archive($args, $post_type){
  if('post'== $post_type){
    $args['rewrite']=true;
    $args ["label"] = '記事一覧'; /*「投稿」のラベル名 */
    $args['has_archive']='post'; /* アーカイブにつけるスラッグ名 */
  }
  return $args;
}

add_filter('register_post_type_args', 'post_has_archive', 10, 2);


/* the_archive_title 余計な文字を削除 */
add_filter( 'get_the_archive_title', function ($title) {
  if (is_category()) {
      $title = single_cat_title('',false);
  } elseif (is_tag()) {
      $title = single_tag_title('',false);
} elseif (is_tax()) {
    $title = single_term_title('',false);
} elseif (is_post_type_archive() ){
  $title = post_type_archive_title('',false);
} elseif (is_date()) {
    $title = get_the_time('Y年n月');
} elseif (is_search()) {
    $title = '検索結果：'.esc_html( get_search_query(false) );
} elseif (is_404()) {
    $title = '「404」ページが見つかりません';
} else {

}
  return $title;
});


//-----------------------------------------------------
// 検索対象にカテゴリやタグを含める
//-----------------------------------------------------
function custom_search($search, $wp_query) {
  global $wpdb;

  //検索ページ以外
  if (!$wp_query->is_search)
  return $search;

  if (!isset($wp_query->query_vars))
  return $search;

  $search_words = explode(' ', isset($wp_query->query_vars['s']) ? $wp_query->query_vars['s'] : '');
  if ( count($search_words) > 0 ) {
      $search = '';
      foreach ( $search_words as $word ) {
          if ( !empty($word) ) {
              $search_word = $wpdb-> _escape("%{$word}%");
              $search .= " AND (
                      {$wpdb->posts}.post_title LIKE '{$search_word}'
                      OR {$wpdb->posts}.post_content LIKE '{$search_word}'
          /*タグ名・カテゴリ名を検索対象に含める記述 start*/
                      OR {$wpdb->posts}.ID IN (
                          SELECT distinct r.object_id
                          FROM {$wpdb->term_relationships} AS r
                          INNER JOIN {$wpdb->term_taxonomy} AS tt ON r.term_taxonomy_id = tt.term_taxonomy_id
                          INNER JOIN {$wpdb->terms} AS t ON tt.term_id = t.term_id
                          WHERE t.name LIKE '{$search_word}'
                      OR t.slug LIKE '{$search_word}'
                      OR tt.description LIKE '{$search_word}'
                      )
        /*タグ名・カテゴリ名を検索対象に含める記述 end*/
              ) ";
          }
      }
  }

  return $search;
}
add_filter('posts_search','custom_search', 10, 2);


/*サイドバーのウィジェット登録*/
if (function_exists('register_sidebar')) {
  register_sidebar(array(
    'name' => 'サイドバー',
    'id' => 'sidebar',
    'description' => 'サイドバーウィジェット',
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="side-title">',
    'after_title' => '</h3>'
 ));
}

/*サイドバーのウィジェット登録２*/
if (function_exists('register_sidebar')) {
  register_sidebar(array(
    'name' => 'サイドバーレント',
    'id' => 'rent-sd',
    'description' => 'サイドバーウィジェット不動産用',
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="side-title">',
    'after_title' => '</h3>'
 ));
}


/*お知らせの設定*/
function create_post_type_news(){
  register_post_type( 
   'news',
   array(
    'labels' => array(
     'name' => 'お知らせ'
    ),
    'public' => true,
    'has_archive' => true,
    'supports' => array('title','editor','thumbnail','author'),
    'show_in_rest' => true,
   )
  );
 }
 add_action( 'init', 'create_post_type_news' );

function shortcode_news_list() {
  global $post;
  $args = array(
   'posts_per_page' => 4,  // 一覧に表示させる件数
   'post_type' => 'news',  // お知らせのスラッグ
   'post_status' => 'publish'
  );
  $the_query = new WP_Query( $args );
  // お知らせ一覧用HTMLコード作成
  if ( $the_query->have_posts() ) {
   $html .= '<ul>';
   while ( $the_query->have_posts() ) :
   $the_query->the_post();
   $url = get_permalink();
   $title = get_the_title();
   $date = get_the_date('Y/m/d');
   $html .= '<li>';
   $html .= '<a href="'.$url.'">';
   $html .= '<p class="news_date">'.$date.'</p>';
   $html .= '<div class="news_title">'.$title.'</div>';
   $html .= '</a></li>';
   endwhile;
   $html .= '</ul>';
  }
  return $html;
 }
 add_shortcode("news_list", "shortcode_news_list");


 //ページネーションの設定
 function pagination($pages = '', $range = 2) {
  $showitems = ($range * 2) + 1;

  // 現在のページ数
  global $paged;
  if(empty($paged)) {
    $paged = 1;
  }

  // 全ページ数
  if($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages) {
      $pages = 1;
    }
  }

  // ページ数が2ぺージ以上の場合のみ、ページネーションを表示
  if(1 != $pages) {
    echo '<div class="pagination">';
    echo '<ul>';
    // 1ページ目でなければ、「前のページ」リンクを表示
    if($paged > 1) {
      echo '<li class="prev"><a href="' . esc_url(get_pagenum_link($paged - 1)) . '"><i class="fa-regular fa-circle-left"></i></a></li>';
    }

    // ページ番号を表示（現在のページはリンクにしない）
    for ($i=1; $i <= $pages; $i++) {
      if (1 != $pages &&(!($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
        if ($paged == $i) {
          echo '<li class="active">' .$i. '</li>';
        } else {
          echo '<li><a href="' . esc_url(get_pagenum_link($i)) . '">' .$i. '</a></li>';
        }
      }
    }

    // 最終ページでなければ、「次のページ」リンクを表示
    if ($paged < $pages) {
      echo '<li class="next"><a href="' . esc_url(get_pagenum_link($paged + 1)) . '"><i class="fa-regular fa-circle-right"></i></a></li>';
    }
    echo '</ul>';
    echo '</div>';
  }
}

//Google-map読み込み
function my_acf_google_map_api( $api ){
  $api['key'] = 'AIzaSyBYYQvxDcDFadXR2A5P0YBGpAylAwuaw94';
  return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


//カスタム投稿用post_typeセット
add_filter('template_include','custom_search_template');
function custom_search_template($template){
  if ( is_search() ){
    $post_types = get_query_var('post_type');
    foreach ( (array) $post_types as $post_type )
    $templates[] = "{$post_type}-search.php";
    $templates[] = 'search.php';
    $template = get_query_template('search',$templates);
  }
  return $template;
}

//WP-membaersの設定(会員登録の為）//
//ログイン後に管理バーを出さない//
add_action( 'after_setup_theme', 'subscriber_hide_admin_bar' );
function subscriber_hide_admin_bar() {
    $user = wp_get_current_user();
    if ( isset( $user->data ) && !$user->has_cap( 'edit_posts' ) ) {
        show_admin_bar( false );
    }
}
//ログイン後にホームにリダイレクト
add_filter( 'login_redirect', 'my_login_redirect' );
function my_login_redirect() {
    wp_safe_redirect( home_url(), 301 );
    exit;
}
//delete me（プラグイン）の退会コード//
function fudoukaiin_user_delete_link(){
  echo '<span class="delpass_title"><a href="https://sample-one.tokyo/delete/">退会</a></span>';
}
add_action( 'fudoukaiin_userlogin_success_other_link', 'fudoukaiin_user_delete_link');



/*** cookieの設定 ***/
add_action( 'get_header', 'readpost');
 
function readpost() {
global $browsing_histories;
$browsing_histories = null;
$set_this_ID = null;
    if(is_single()){
if( isset($_COOKIE['postid_history']) ){
//postid_historyの部分は任意の文字列でOKです
//cookieの値を呼び出し
$browsing_histories = explode(",", $_COOKIE['postid_history']);
if($browsing_histories[0] != get_the_ID()){
if(count($browsing_histories) >= 50 ){
$set_browsing_histories = array_slice($browsing_histories , 0, 49);
}else{
$set_browsing_histories = $browsing_histories;
}
//値の先頭が現在の記事IDでなければ文字列の一番最初に追加
$set_this_ID = get_the_ID().','.implode(",", $set_browsing_histories);
setcookie( 'postid_history', $set_this_ID, time() + 60 * 60 * 24 * 365 * 1,'/');
// }else{
// 	$set_this_ID = $_COOKIE['postid_history'];
}
}else{
//cookieがなければ、現在の記事IDを保存
$set_this_ID = get_the_ID();
setcookie( 'postid_history', $set_this_ID, time() + 60 * 60 * 24 * 365 * 1,'/');
}
//詳細ページ以外なら呼び出しのみ
}else{
if( isset($_COOKIE['postid_history']) ){
$browsing_histories = explode(",", $_COOKIE['postid_history']);
}
}
$postread = explode(",", $_COOKIE['postid_history']);
$postread = array_unique($postread);
$postread = array_values($postread);
return $postread;
}

/*** 履歴閲覧記事の設定 ***/
function readpost_typecheack($postnum) {
  global $post;
  $postdate = readpost();
  $numlist = 0;
  if(!empty($postdate)):
  ?>
  <div class="post-check-wrap">
    <ul class="my-post-check"><?php
  foreach($postdate as $key =>$val):
  $posttype = get_post_type( $val );
  if($posttype==="rent")://ここで記事かどうかを見る。
  if($postnum==$numlist){ break; }
  ?>
      <li>
        <a href="<?php echo get_permalink($val); ?>">

          <figure class="my-widget__img">
            <?php echo get_the_post_thumbnail($val, 'thumb-160'); ?>
          </figure>
          <div class="my-widget__text"><?php echo get_the_title($val); ?>
	        </div>
  
        </a>
      <!--<?php print_r($postcustom); ?>-->
      </li>
  <?php
  $numlist++;
  endif;
  endforeach;
  ?>
    </ul>
  </div>
  <?php
  endif;
  }

?>