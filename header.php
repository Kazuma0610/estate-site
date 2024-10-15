<?php

  // （５）▼▼▼
  $position = 0;
  // （５）▲▲▲
  $msg = null;

  // （６）▼▼▼
  if ((isset($_REQUEST["position"]) == true)	// ボタンが押された？
   && (isset($_REQUEST["reset"]) != true))	// リセットボタンでない？
  {
  // （６）▲▲▲

  // （７）▼▼▼
	  $position = $_REQUEST["position"];
  // （７）▲▲▲
  }

?>

<!DOCTYPE html><!--htmlで書かれていることを宣言-->
<html <?php language_attributes(); ?>><!--日本語のサイトであることを指定-->
<head>
<meta charset="<?php bloginfo('charset'); ?>"/><!--エンコードがUTF-8であることを指定-->
<meta name="viewport" content="width=device-width, initial-scale=1.0 "><!--viewportの設定-->
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>"><!--スタイルシートの呼び出し-->
<link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200&display=swap" rel="stylesheet"><!--notoserifjpフォント-->
<link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/><!--SwiperのCSS-->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script><!--SwiperのCDN-->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYYQvxDcDFadXR2A5P0YBGpAylAwuaw94"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function()
  {
    // （２）▼▼▼ 
	  window.onload = function (){	$(window).scrollTop(<?php echo $position; ?>);}
    // （２）▲▲▲
 
    // （３）▼▼▼
	  $("input[type=submit]").click(function()
	  {
    // （３）▲▲▲
 
    // （４）▼▼▼
	 	  var position = $(window).scrollTop();
		  $("input:hidden[name=position]").val(position);
    // （４）▲▲▲
 
		  $("#form").submit();
	  });
  });
</script>
<?php wp_head(); ?><!--システム・プラグイン用-->
<!--条件分岐でのCSS変更用-->
<style type="text/css">
  <?php if ( is_front_page() ): ?>
      .top-container {
      margin-top: -80px;
      }
      .contents {
        padding:0px;
      }
    @media (min-width: 62.5rem) {
      .top-container {
      margin-top: -150px;
      }
    }
  <?php endif; ?>
</style>
<!--条件分岐でのCSS変更用-->
<style type="text/css">
  <?php if ( !is_front_page() ): ?>
    #header {
      background-color: #fff;
    }
    .header-inner {
      background-color: #fff;
    }
  <?php endif; ?>
</style>
<!--条件分岐でのCSS変更用-->
<style type="text/css">
  <?php if ( !is_front_page() ): ?>
    @media (min-width: 55rem) {
      .breadcrumb {
        font-size: 1rem;
        width: 100%;
        margin: 0 auto;
        text-align: left;
        background: #efefef;
        margin-top: 88px;
      }
    }
  <?php endif; ?>
</style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="modal">
  <div class="modal_bg js-modal-close"></div>
    <div class="modalScroll">
      <div class="modal_content">

        <div class="sso_content_modal">
          <?php
            $args = array(
		          'post_type'   => 'page',
		          'name'        => 'filter-search-3',
		          'post_status' => array( 'publish', 'private' ),
	          );
	          $posts_array = get_posts( $args );
	          if ( $posts_array && is_array( $posts_array ) ) {
		        $content = $posts_array[0]->post_content;
		        echo apply_filters( 'the_content', $content );
	          }
          ?>
        </div>
                        
        <span class="popup-close" onclick="closePopUp()"></span>
      </div>
    </div>
  </div>
</div><!--modal-->

<header id="header" class="header">

  <div class="header-top"></div>
  
  <div class="header-inner">

    <div class="member-and-other-bar-pc">
      <div class="header-other">
        <p>東京都世田谷区・渋谷区専門の不動産業者 | DAIEI不動産（デモサイト）</p>
      </div>
      <div class="header-member-pc">
        <?php if (is_user_logged_in()) : ?>
        <div class="member-in">
          <p><?php global $current_user; echo $current_user->nickname ?>さん</p>
          <div class="header-mypage"><a href="https://sample-one.tokyo/mypage">マイページ</a></div>
          <div class="header-logout"><a href="https://sample-one.tokyo/login/?a=logout">ログアウト</a></div>
        </div>
        <?php else : ?>
          <div class="member-out">
            <p>ようこそゲストさん</p>
            <div class="header-login"><a href="https://sample-one.tokyo/login/">ログイン</a></div>
            <div class="header-add"><a href="https://sample-one.tokyo/sign-up/">新規登録</a></div>
          </div>
        <?php endif ; ?>
      </div>
    </div>

    <div class="header-logo-and-tel">
      <div class="logo-img">
        <a href="http://sample-one.tokyo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/daiei.png" alt="ロゴ"/></a>
      </div>
      <div class="tel-contact-wrap">

        <div class="tel-contents">
          <p class="tel-text-one">物件に関するご相談・ご質問はお気軽に</p>
          <div class="tel">
            <a href="tel:000-1234-5678"><i class="fa-solid fa-square-phone-flip"></i>000-1234-5678</a>
          </div>
          <p class="tel-text-two">営業時間 10:00～18:00[祝日を除く平日]</p>
        </div>
        <div class="res-con-wrap">
          <div class="reserve-view">
            <a href="#"><i class="fa-solid fa-house-circle-check"></i>内覧のご予約</a>
          </div>
          <div class="contact-header">
            <a href="#"><i class="fa-solid fa-envelope"></i>お問い合せ</a>
          </div>
        </div>
        

      </div>
    </div>

    <div class="header-tablet">
      <div class="logo-and-menu">
        <div class="logo-img">
          <a href="http://sample-one.tokyo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/daiei.png" alt="ロゴ"/></a>
        </div>
      </div>
      <div class="openbtn">
        <span></span><span></span><span></span>
      </div>
        <nav id="g-nav">

          <div class="member-sp-contents">

            <div class="header-member-tablet">
             <?php if (is_user_logged_in()) : ?>
              <div class="member-in">
                <p><?php global $current_user; echo $current_user->nickname ?>さん</p>
                <div class="m-in-flex">
                  <div class="header-mypage"><a href="https://sample-one.tokyo/mypage">マイページ</a></div>
                  <div class="header-logout"><a href="https://sample-one.tokyo/login/?a=logout">ログアウト</a></div>
                </div>
              </div>
              <?php else : ?>
              <div class="member-out">
                <p>ようこそゲストさん</p>
                <div class="m-out-flex">
                  <div class="header-login"><a href="https://sample-one.tokyo/login/">ログイン</a></div>
                  <div class="header-add"><a href="https://sample-one.tokyo/sign-up/">新規登録</a></div>
                </div>
              </div>
              <?php endif ; ?>
            </div>

          </div>

          <div id="g-nav-list">

           <div class="section s_07">
             
             <div class="accordion_one"><!--accordion_one1-->
               <div class="accordion_header"><a href="https://sample-one.tokyo/">ホーム</a></div>
             </div>

             <div class="accordion_one"><!--accordion_one2-->

               <div class="accordion_header">賃貸物件<div class="i_box"><i class="one_i"></i></div>
               </div>

                <div class="accordion_inner">

                   <div class="accordion_one"><!--accordion_one1-1-->
                    
                     <div class="accordion_header">○○物件</div>

                   </div><!--accordion_one1-1-->

                   <div class="accordion_one"><!--accordion_one1-2-->
                    
                     <div class="accordion_header">○○物件</div>
                  
                   </div><!--accordion_one1-2-->

                   <div class="accordion_one"><!--accordion_one1-3-->
                    
                     <div class="accordion_header">○○物件</div>
                  
                   </div><!--accordion_one1-3-->

                   <div class="accordion_one"><!--accordion_one1-4-->
                    
                     <div class="accordion_header">○○物件</div>
                  
                   </div><!--accordion_one1-4-->

                   <div class="accordion_one"><!--accordion_one1-5-->
                    
                     <div class="accordion_header">○○物件</div>

                   </div><!--accordion_one1-5-->

                   <div class="accordion_one"><!--accordion_one1-6-->
                    
                     <div class="accordion_header">○○物件</div>
                  
                   </div><!--accordion_one1-6-->

                   <div class="accordion_one"><!--accordion_one1-7-->
                    
                     <div class="accordion_header">○○物件</div>
                  
                   </div><!--accordion_one1-7-->

                   <div class="accordion_one"><!--accordion_one1-8-->
                    
                     <div class="accordion_header">○○物件</div>
                  
                   </div><!--accordion_one1-8-->
            
                </div><!--accordion_inner-->
            
             </div>

             <div class="accordion_one"><!--accordion_one3-->
               <div class="accordion_header"><a href="https://sample-one.tokyo/">スタッフ紹介</a></div>
             </div>

             <div class="accordion_one"><!--accordion_one4-->
               <div class="accordion_header"><a href="https://sample-one.tokyo/">会社概要</a></div>
             </div>

             <div class="accordion_one"><!--accordion_one5-->
               <div class="accordion_header"><a href="https://sample-one.tokyo/">お問合せ</a></div>
             </div>

           </div><!--section s_07-->

          </div><!--g-nav-list-->

        </nav>
    </div>

  </div><!--end header-inner-->

  <?php if(!is_front_page()): ?>

    <div class="header-navi-top">

      <nav class="header-nav">
        <ul class="header-list">
          <li class="header-item">
            <a href="https://sample-one.tokyo"><i class="fa-solid fa-house"></i>ホーム<span class="h-change">HOME</span></a>
          </li>
          <li class="header-item">
            <p><i class="fa-solid fa-magnifying-glass"></i>賃貸物件<i class="fa-solid fa-chevron-down"></i><span class="h-change">RENT</span></p>
            <div class="megaMenu">
              <ul class="megaMenu-list">
                <li>
                  <a href="#">
                    <div class="mega-pic">
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/demo1.png" alt="画像"/>
                    </div>
                    <div class="mega-text"><p>一人暮らし物件</p></div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="mega-pic">
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/demo2.png" alt="画像"/>
                    </div>
                    <div class="mega-text"><p>二人暮らし物件</p></div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="mega-pic">
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/demo3.png" alt="画像"/>
                    </div>
                    <div class="mega-text"><p>2LDK物件</p></div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="mega-pic">
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/demo4.png" alt="画像"/>
                    </div>
                    <div class="mega-text"><p>ファミリー物件</p></div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="mega-pic">
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/demo5.png" alt="画像"/>
                    </div>
                    <div class="mega-text"><p>タワマン物件</p></div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="mega-pic">
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/demo2.png" alt="画像"/>
                    </div>
                    <div class="mega-text"><p>戸建て賃貸物件</p></div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="mega-pic">
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/demo4.png" alt="画像"/>
                    </div>
                    <div class="mega-text"><p>防音物件</p></div>
                  </a>
                </li>
                <li>
                  <a href="#">
                    <div class="mega-pic">
                      <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/park.png" alt="画像"/>
                    </div>
                    <div class="mega-text"><p>駅近物件</p></div>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="header-item">
            <a href="https://sample-one.tokyo"><i class="fa-solid fa-person"></i>スタッフ紹介<span class="h-change">Staff</span></a>
          </li>
          <li class="header-item">
            <a href="https://sample-one.tokyo"><i class="fa-solid fa-building"></i>会社概要<span class="h-change">COMPANY</span></a>
          </li>
          <li class="header-item">
            <a href="https://sample-one.tokyo"><i class="fa-solid fa-envelope"></i>お問合せ<span class="h-change">CONTACT</span></a>
          </li>
        </ul>
      </nav>
    
    </div>

  <?php endif; ?>
  
</header>

<!--パンクズ＊ヘッダー枠外に設置-->
<?php if(!is_front_page()): ?>

<div class="breadcrumb">
    <?php
        if(function_exists( 'yoast_breadcrumb' )){
        yoast_breadcrumb( '<p id="breadcrumbs">', '</p>');
        }
    ?>
</div>

<?php endif; ?>