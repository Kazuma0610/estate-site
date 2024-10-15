<?php get_header(); ?>

<section id="wrapper">

  <?php

    // 変数の初期化
    $page_flag = 0;
    $clean = array();
    $error = array();

    // サニタイズ
    if( !empty($_POST) ) {
	    foreach( $_POST as $key => $value ) {
		  $clean[$key] = htmlspecialchars( $value, ENT_QUOTES);
	    }
    }

    if( !empty($clean['btn_confirm']) ) {

      $error = validation($clean);

	    if( empty($error) ) {
		    $page_flag = 1;
	    }


    } elseif( !empty($clean['btn_submit']) ) {

      $page_flag = 2;

      // 変数とタイムゾーンを初期化
      $header = null;
	    $auto_reply_subject = null;
	    $auto_reply_text = null;
	    date_default_timezone_set('Asia/Tokyo');

      // ヘッダー情報を設定
	    $header = "MIME-Version: 1.0\n";
	    $header .= "From:". mb_encode_mimeheader("DAIEI不動産") . "<mail@daieirecord.jp>\n";
	    $header .= "Reply-To:". mb_encode_mimeheader("DAIEI不動産") . "<mail@daieirecord.jp>\n";

	    // 件名を設定
	    $auto_reply_subject = 'お問い合わせありがとうございます。';

	    // 本文を設定
	    $auto_reply_text = "この度は、お問い合わせ頂き誠にありがとうございます。下記の内容でお問い合わせを受け付けました。\n\n";
	    $auto_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n\n";
      $auto_reply_text .= "物件名：" . $clean['property_name'] . "\n\n";
	    $auto_reply_text .= "氏名：" . $clean['your_name'] . "\n\n";
	    $auto_reply_text .= "メールアドレス：" . $clean['email'] . "\n\n";
      $auto_reply_text .= "電話番号：" . $clean['tel'] . "\n\n";

      if( $clean['content'] === "one" ){
        $auto_reply_text .= "お問い合わせ内容：最新の空室状況を知りたい\n\n";
      } elseif ( $clean['content'] === "two" ){
        $auto_reply_text .= "お問い合わせ内容：実際に見学したい\n\n";
      } elseif ( $clean['content'] === "three" ){
        $auto_reply_text .= "お問い合わせ内容：その他の問合せ（詳細はお問い合わせ内容に記載）\n\n";
      }

      $auto_reply_text .= "お問い合わせ内容：" . nl2br($clean['contact']) . "\n\n";

	    $auto_reply_text .= "DAIEI不動産";

	    // メール送信
	    mb_send_mail( $clean['email'], $auto_reply_subject, $auto_reply_text,$header);

      // 運営側へ送るメールの件名
	    $admin_reply_subject = "お問い合わせを受け付けました";
	
	    // 本文を設定
	    $admin_reply_text = "下記の内容でお問い合わせがありました。\n\n";
	    $admin_reply_text .= "お問い合わせ日時：" . date("Y-m-d H:i") . "\n\n";
      $admin_reply_text .= "物件名：" . $clean['property_name'] . "\n\n";
	    $admin_reply_text .= "氏名：" . $clean['your_name'] . "\n\n";
	    $admin_reply_text .= "メールアドレス：" . $clean['email'] . "\n\n";
      $admin_reply_text .= "電話番号：" . $clean['tel'] . "\n\n";

      if( $clean['content'] === "one" ){
        $admin_reply_text .= "お問い合わせ内容：最新の空室状況を知りたい\n\n";
      } elseif ( $clean['content'] === "two" ){
        $admin_reply_text .= "お問い合わせ内容：実際に見学したい\n\n";
      } elseif ( $clean['content'] === "three" ){
        $admin_reply_text .= "お問い合わせ内容：その他の問合せ（詳細はお問い合わせ内容に記載）\n\n";
      }

      $admin_reply_text .= "お問い合わせ内容：" . nl2br($clean['contact']) . "\n\n";

	    // 運営側へメール送信
	    mb_send_mail( 'mail@daieirecord.jp', $admin_reply_subject, $admin_reply_text, $header);

    }

    function validation($data) {

      $error = array();
    
      // 氏名のバリデーション
			if( empty($data['your_name']) ) {
			  $error[] = "「氏名」は必ず入力してください。";
			} elseif( 20 < mb_strlen($data['your_name']) ) {
			  $error[] = "「氏名」は20文字以内で入力してください。";
			}

			// メールアドレスのバリデーション
			if( empty($data['email']) ) {
			  $error[] = "「メールアドレス」は必ず入力してください。";
		  } elseif( !preg_match( '/^[0-9a-z_.\/?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$/', $data['email']) ) {
				$error[] = "「メールアドレス」は正しい形式で入力してください。";
			}

			// 電話番号のバリデーション
			if( empty($data['tel']) ) {
			  $error[] = "「電話番号」は必ず入力してください。";
			} elseif( !preg_match( '/^[0-9.-]+$/', $data['tel']) ) {
			  $error[] = "「電話番号」は正しい形式で入力してください。";
			} elseif( 10 > mb_strlen($data['tel']) ) {
			  $error[] = "電話番号は10桁以上でご記入ください";
			}

      // 問い合わせ内容のバリデーション
			if( empty($data['content']) ) {
			  $error[] = "「お問い合わせ内容の選択」は必ず入力してください。";
			} 

      // プライバシーポリシー同意のバリデーション
			if( empty($data['agreement']) ) {
			  $error[] = "プライバシーポリシーをご確認ください。";
			} elseif( (int)$data['agreement'] !== 1 ) {
				$error[] = "プライバシーポリシーをご確認ください。";
			}

    
      return $error;
    }

  ?>
  
    
  <main id="main" class="container two-columns site-main">

    <div class="contents">

    <?php while ( have_posts() ) : the_post(); ?>  <!--WPループ開始-->
 
      <article id="post-<?php the_ID(); ?>" <?php post_class('rent_single'); ?>>  <!--後でsuumo風のcssにするために追加-->
        

        <!--PC・SP版（タブレット含む）物件タイトルエリア=-->
        <h1><?php the_field ( "name" ); ?>の賃貸情報</h1><!--PC・SP版（タブレット含む）物件タイトルエリア=-->

        <!--PC版（タブレット含む）プライスエリア=-->
        <section class="price-block-pc">
          <div class="price-wrapper">
            <div class="price-contents">
              <div class="price-pt-1">
                <?php if( get_field('point_2') ):?>
                    <div class="point_2_p"><span>POINT</span><?php the_field('point_2');?></div>
                  <?php else:?>
                <?php endif; ?>
                <span class="price-ttl"><?php the_field ( "rent" ); ?>万円</span>
                <span class="other-ttl-1"><span class="other-ttl-sub">管理費・共益費：</span><?php the_field ( "Administrative" ); ?></span>
              </div>
              <div class="price-pt-2">
                <span class="other-ttl-1"><span class="other-ttl-sub-no-before">敷金：</span><?php the_field ( "Deposit" ); ?></span>
                <span class="other-ttl-1"><span class="other-ttl-sub">礼金：</span><?php the_field ( "deposit2" ); ?></span>
                <span class="other-ttl-1"><span class="other-ttl-sub">保証金：</span><?php the_field ( "deposit3" ); ?></span>
                <span class="other-ttl-1"><span class="other-ttl-sub">敷引・償却：</span><?php the_field ( "Amortization" ); ?></span>
              </div>
              <?php if( is_user_logged_in() ) : ?>
                <div class="bookmark-list">
                  <div class="bk-main">
                    <?php echo do_shortcode('[favorite_button post_id="" site_id=""]'); ?>
                  </div>
                  <div class="bk-text">
                    <p>マイページでお気に入り一覧がみれます</p>
                  </div>
                </div>
                <?php else: ?> 
                  <div class="bookmark-list-out">
                    <div class="bk-text">
                      <p>会員登録するとお気に入り機能が使えます</p>
                    </div>
                  </div>
                <?php endif; ?>
            </div>
            <div class="btn-wrap-contact">
              <a href="" class="btn btn--orange-2 btn-c">
              <i class="fa far fa-envelope"></i> 空室状況を問い合わせる</a>
            </div>
          </div>
        </section><!--PC版（タブレット含む）プライスエリア=-->

        <!--スマホ版ギャラリーエリア-->
        <section class="bxslider-gallery-sp-only">
          <?php if( is_user_logged_in() ) : ?>
            <div class="bookmark-sp-list">
              <div class="bk-main">
                <?php echo do_shortcode('[favorite_button post_id="" site_id=""]'); ?>
              </div>
              <div class="bk-text">
                <p>マイページでお気に入り一覧がみれます</p>
              </div>
            </div>
            <?php else:?>
              <div class="bookmark-sp-list-out">
                <div class="bk-text">
                  <p>会員登録するとお気に入り機能が使えます</p>
                </div>
              </div>  
            <?php endif;?>
          <div class="example bxslider1">
	          <div class="bxslider">
              <ul id="js-imageGallery-main">
                <?php $s_images = get_field( 'photo' );  //ギャラリーの表示ここから
                $s_images_count = count($s_images);
                if ( $s_images ) {
                  foreach ( $s_images as $key => $s_image ) { ?>
                <li class="is-active" data-caption="<?php echo $s_image['alt']; ?>">
                  <div class="dtlslider_cstphoto">
                    <div class="dtlslider_cstphoto-inner">
                      <img src="<?php echo $s_image['url']; ?>" alt="" />
                    </div>
                    <div class="dtlslider_cstphoto-count-sp"><p><?php echo $s_image['title'];?></p><?php echo $key + 1; ?>/<?php echo $s_images_count; ?></div>
                  </div>
                </li>
                  <?php 
                  }
                }  //ギャラリーの表示ここまで
                ?>
              </ul>

	          </div>
          </div>
         
          
        </section><!--スマホ版ギャラリーエリア=-->

        <!--PC版（タブレット含む）ギャラリーエリア-->
        <section class="swiper-gallery pc-only">

          <div class="p-myswiper">
            <div class="swiper">
              <div class="swiper-wrapper">
                <?php $s_images = get_field( 'photo' );  //ギャラリーの表示ここから
                    $s_images_count = count($s_images);
                    if ( $s_images ) {
                      foreach ( $s_images as $key => $s_image ) { ?>
                        <div class="swiper-slide p-myswiper__slide">
                          <img src="<?php echo $s_image['url']; ?>" alt="" />
                          <div class="dtlslider_cstphoto-count"><p><?php echo $s_image['title'];?></p><?php echo $key + 1; ?>/<?php echo $s_images_count; ?></div>
                        </div>
                      <?php 
                      }
                    }  //ギャラリーの表示ここまで
                ?>
              </div>
            </div>
              <div class="swiper-thumbs-button-prev main-pic-prev">&lt;</div>
              <div class="swiper-thumbs-button-next main-pic-next">&gt;</div>
          </div>
          <div class="swiper-thumbs-container">
            <div class="p-myswiper-thumbs">
              <div class="swiper-thumbs">
                <div class="swiper-wrapper">
                  <?php $s_images_thumbnail = get_field ( 'photo' );  //ギャラリーのスライダー用の小さい画像用にもう一度
                    if ( $s_images_thumbnail ) {
                      foreach ( $s_images_thumbnail as $s_image_thumbnail ) { ?>
                          <div class="swiper-slide p-myswiper-thumbs__slide">
                            <img src="<?php echo $s_image_thumbnail['url']; ?>" alt="" />
                          </div>
                        <?php 
                        }
                    }  //ギャラリーのスライダー用の小さい画像用にもう一度ここまで
                  ?>
                </div>
              </div>
              <div class="swiper-scrollbar"></div>
            </div>
              <div class="swiper-thumbs-button-prev">&lt;</div>
              <div class="swiper-thumbs-button-next">&gt;</div>
          </div><!--swiper-thumbs-container-->
          
        </section><!--PC版（タブレット含む）ギャラリーエリア-->

        
        <!--SP版、プライス・物件詳細エリア=-->
        <section class="detail-top-sp-only">
          <div class="price-sp-wrap">
            <?php if( get_field('point_2') ):?>
              <div class="point_2_p"><span>POINT</span><?php the_field('point_2');?></div>
            <?php else:?>
            <?php endif; ?>
            <div class="price-ttl-sp"><?php the_field ( "rent" ); ?>万円</div>
            <div class="other-ttl-sp-1">(<span class="other-ttl-sp-sub">管理費：</span><span class="price-sp"><?php the_field ( "Administrative" ); ?></span>)</div>
          </div>
          <div class="prope-flex">
            <div class="prope-block"><span class="prope-ttl">敷/礼</span><?php the_field ( "deposit_deposit2" ); ?></div>
            <div class="prope-block"><span class="prope-ttl">間取り</span><?php the_field ( "Floor_plan" ); ?></div>
            <div class="prope-block"><span class="prope-ttl">専用面積</span><?php the_field ( "occupied_area" ); ?></div>
            <div class="prope-block"><span class="prope-ttl">階</span><?php the_field ( "story2" ); ?></div>
            <div class="prope-block"><span class="prope-ttl">築年数</span><?php the_field ( "Age" ); ?></div>
            <div class="prope-block"><span class="prope-ttl">建物種別</span><?php the_field ( "Building_Type" ); ?></div>
            <div class="prope-block"><span class="prope-ttl">向き</span><?php the_field ( "direction" ); ?></div>
            <div class="prope-block"><span class="prope-ttl">契約期間</span><?php the_field ( "Contract_period" ); ?></div>
          </div>
          <div class="prope-wrap">
            <div class="prope-block-long"><span class="prope-ttl-long">所在地</span><?php the_field ( "Street_address" ); ?></div>
            <div class="prope-block-long-flex"><span class="prope-ttl-long">駅徒歩</span>

              <?php
                  if ( have_rows ( 'Nearest_station' ) ) :  //繰り返しフィールドに設定した項目の表示方法
                    echo '<section class="detailnote-value">';
                    while ( have_rows ( 'Nearest_station' ) ) : the_row();
                    echo '<div id="station">';
                    echo get_sub_field( 'station' );  //子フィールドを表示する関数。get_sub_field( '子フィールド名' )
                    echo '</div>';
                    endwhile;
                    echo '</section>';
                    endif;
              ?>
          
            </div>
            <div class="prope-block-long-flex-center"><span class="prope-ttl-long">情報<br>更新日</span><?php the_modified_date('Y/n/j'); ?></div>
          </div>
          <section class="about_property_contents">
            <div class="a_p_wrapper">
              <?php
              //フィールド名property_detailsを取得
              $property_details = get_field('property_details');
              //ラジオボタンフィールドの値を取得
              $property_details_Value = $property_details['value'];
              //ラジオボタンフィールドのラベルを取得
              $property_details_Label = $property_details['label'];
              ?>
              <?php if($property_details_Value === 'yes'): ?>
                <h3>この物件について</h3>
              <?php elseif($property_details_Value === 'no'): ?>
              <?php else: ?>
              <?php endif; ?>

              <div class="a_p_p_contents">
                <div class="a_p_p_wrapper">

                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $toile_check = get_field('toile-check');
                      //ラジオボタンフィールドの値を取得
                      $toile_check_Value = $toile_check['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $toile_check_Label = $toile_check['label'];
                    ?>
                    <?php if($toile_check_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/toile-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($toile_check_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/toile-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>

                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $floor_over = get_field('floor_over');
                      //ラジオボタンフィールドの値を取得
                      $floor_over_Value = $floor_over['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $floor_over_Label = $floor_over['label'];
                    ?>
                    <?php if($floor_over_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/nikai-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($floor_over_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/nikai-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>

                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $parking_ck = get_field('parking_ck');
                      //ラジオボタンフィールドの値を取得
                      $parking_ck_Value = $parking_ck['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $parking_ck_Label = $parking_ck['label'];
                    ?>
                    <?php if($parking_ck_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/park-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($parking_ck_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/park-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>

                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $washing_machine = get_field('washing_machine');
                      //ラジオボタンフィールドの値を取得
                      $washing_machine_Value = $washing_machine['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $washing_machine_Label = $washing_machine['label'];
                    ?>
                    <?php if($washing_machine_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/senntaku-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($washing_machine_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/senntaku-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>

                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $air_conditioner_ck = get_field('air_conditioner_ck');
                      //ラジオボタンフィールドの値を取得
                      $air_conditioner_ck_Value = $air_conditioner_ck['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $air_conditioner_ck_Label = $air_conditioner_ck['label'];
                    ?>
                    <?php if($air_conditioner_ck_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/eakonn-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($air_conditioner_ck_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/eakonn-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>

                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $pets_ok = get_field('pets_ok');
                      //ラジオボタンフィールドの値を取得
                      $pets_ok_Value = $pets_ok['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $pets_ok_Label = $pets_ok['label'];
                    ?>
                    <?php if($pets_ok_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/pet-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($pets_ok_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/pet-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>

                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $auto_lock_ck = get_field('auto_lock_ck');
                      //ラジオボタンフィールドの値を取得
                      $auto_lock_ck_Value = $auto_lock_ck['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $auto_lock_ck_Label = $auto_lock_ck['label'];
                    ?>
                    <?php if($auto_lock_ck_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/lock-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($auto_lock_ck_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/lock-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>

                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $Washroom_independent = get_field('Washroom_independent');
                      //ラジオボタンフィールドの値を取得
                      $Washroom_independent_Value = $Washroom_independent['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $Washroom_independent_Label = $Washroom_independent['label'];
                    ?>
                    <?php if($Washroom_independent_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/sennmenn-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($Washroom_independent_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/sennmenn-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="a_p_contents">
                <div class="a_p_one">
                  <?php if( get_field('Cost_Information') ):?>
                      <div class="a_p_one_single"><span><img src="<?php echo esc_url(get_theme_file_uri('images/hiyou.png')); ?>" alt="アイコン"></span><p><?php the_field('Cost_Information');?></p></div>
                    <?php else:?>
                  <?php endif; ?>
                </div>
                <div class="a_p_one">
                  <?php if( get_field('prevention') ):?>
                      <div class="a_p_one_single"><span><img src="<?php echo esc_url(get_theme_file_uri('images/bouhan.png')); ?>" alt="アイコン"></span><p><?php the_field('prevention');?></p></div>
                    <?php else:?>
                  <?php endif; ?>
                </div>
                <div class="a_p_one">
                  <?php if( get_field('Room_Facilities') ):?>
                      <div class="a_p_one_single"><span><img src="<?php echo esc_url(get_theme_file_uri('images/situnai.png')); ?>" alt="アイコン"></span><p><?php the_field('Room_Facilities');?></p></div>
                    <?php else:?>
                  <?php endif; ?>
                </div>
                <div class="a_p_one">
                  <?php if( get_field('Common_Areas') ):?>
                      <div class="a_p_one_single"><span><img src="<?php echo esc_url(get_theme_file_uri('images/kyouyou.png')); ?>" alt="アイコン"></span><p><?php the_field('Common_Areas');?></p></div>
                    <?php else:?>
                  <?php endif; ?>
                </div>
              </div>
            </div>

          </section>
        </section><!--SP版物件詳細エリア=-->
    
        <!--PC版（タブレット含む）物件詳細エリア=-->
        <section class="detail-top-tablet-pc-only">
          <table>
            <tbody>

              <tr class=first-border>
                <th class="property-view-table-ttl">所在地</th>
                <td class="property-view-table-body"><?php the_field ( "Street_address" ); ?></td>
              </tr>
              <tr>
              <th class="property-view-table-ttl">駅徒歩</th>
                <td class="property-view-table-body">
                  <?php
                     if ( have_rows ( 'Nearest_station' ) ) :  //繰り返しフィールドに設定した項目の表示方法
                     echo '<section class="detailnote-value">';
                     while ( have_rows ( 'Nearest_station' ) ) : the_row();
                     echo '<div id="station">';
                     echo get_sub_field( 'station' );  //子フィールドを表示する関数。get_sub_field( '子フィールド名' )
                     echo '</div>';
                     endwhile;
                     echo '</section>';
                     endif;
                  ?>
                </td>
              </tr>
              <tr>
                <th class="property-view-table-ttl">間取り</th>
                <td class="property-view-table-body"><?php the_field ( "Floor_plan" ); ?></td>
                <th class="property-view-table-ttl">専用面積</th>
                <td class="property-view-table-body"><?php the_field ( "occupied_area" ); ?></td>
              </tr>
              <tr>
                <th class="property-view-table-ttl">築年数</th>
                <td class="property-view-table-body"><?php the_field ( "Age" ); ?></td>
                <th class="property-view-table-ttl">階</th>
                <td class="property-view-table-body"><?php the_field ( "story2" ); ?></td>
              </tr>
              <tr>
                <th class="property-view-table-ttl">向き</th>
                <td class="property-view-table-body"><?php the_field ( "direction" ); ?></td>
                <th class="property-view-table-ttl">建物種別</th>
                <td class="property-view-table-body"><?php the_field ( "Building_Type" ); ?></td>
              </tr>
              <tr>
                <th class="property-view-table-ttl">契約期間</th>
                <td class="property-view-table-body"><?php the_field ( "Contract_period" ); ?></td>
                <th class="property-view-table-ttl">情報更新日</th>
                <td class="property-view-table-body"><?php the_modified_date('Y/n/j'); ?></td>
              </tr>
              
            </tbody>
          </table>
          <section class="about_property_contents">
            <div class="a_p_wrapper">
              <?php
              //フィールド名property_detailsを取得
              $property_details = get_field('property_details');
              //ラジオボタンフィールドの値を取得
              $property_details_Value = $property_details['value'];
              //ラジオボタンフィールドのラベルを取得
              $property_details_Label = $property_details['label'];
              ?>
              <?php if($property_details_Value === 'yes'): ?>
                <h3>この物件について</h3>
              <?php elseif($property_details_Value === 'no'): ?>
              <?php else: ?>
              <?php endif; ?>
              <div class="a_p_p_contents">
                <div class="a_p_p_wrapper">

                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $toile_check = get_field('toile-check');
                      //ラジオボタンフィールドの値を取得
                      $toile_check_Value = $toile_check['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $toile_check_Label = $toile_check['label'];
                    ?>
                    <?php if($toile_check_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/toile-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($toile_check_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/toile-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>

                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $floor_over = get_field('floor_over');
                      //ラジオボタンフィールドの値を取得
                      $floor_over_Value = $floor_over['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $floor_over_Label = $floor_over['label'];
                    ?>
                    <?php if($floor_over_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/nikai-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($floor_over_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/nikai-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>

                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $parking_ck = get_field('parking_ck');
                      //ラジオボタンフィールドの値を取得
                      $parking_ck_Value = $parking_ck['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $parking_ck_Label = $parking_ck['label'];
                    ?>
                    <?php if($parking_ck_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/park-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($parking_ck_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/park-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>

                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $washing_machine = get_field('washing_machine');
                      //ラジオボタンフィールドの値を取得
                      $washing_machine_Value = $washing_machine['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $washing_machine_Label = $washing_machine['label'];
                    ?>
                    <?php if($washing_machine_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/senntaku-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($washing_machine_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/senntaku-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>

                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $air_conditioner_ck = get_field('air_conditioner_ck');
                      //ラジオボタンフィールドの値を取得
                      $air_conditioner_ck_Value = $air_conditioner_ck['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $air_conditioner_ck_Label = $air_conditioner_ck['label'];
                    ?>
                    <?php if($air_conditioner_ck_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/eakonn-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($air_conditioner_ck_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/eakonn-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>

                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $pets_ok = get_field('pets_ok');
                      //ラジオボタンフィールドの値を取得
                      $pets_ok_Value = $pets_ok['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $pets_ok_Label = $pets_ok['label'];
                    ?>
                    <?php if($pets_ok_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/pet-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($pets_ok_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/pet-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>

                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $auto_lock_ck = get_field('auto_lock_ck');
                      //ラジオボタンフィールドの値を取得
                      $auto_lock_ck_Value = $auto_lock_ck['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $auto_lock_ck_Label = $auto_lock_ck['label'];
                    ?>
                    <?php if($auto_lock_ck_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/lock-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($auto_lock_ck_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/lock-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>
                  
                  <div class="a_p_p_one">
                    <?php
                      //フィールド名を取得
                      $Washroom_independent = get_field('Washroom_independent');
                      //ラジオボタンフィールドの値を取得
                      $Washroom_independent_Value = $Washroom_independent['value'];
                      //ラジオボタンフィールドのラベルを取得
                      $Washroom_independent_Label = $Washroom_independent['label'];
                    ?>
                    <?php if($Washroom_independent_Value === 'yes'): ?>
                      <div class="image_ari"><img src="<?php echo esc_url(get_theme_file_uri('images/sennmenn-on.png')); ?>" alt="アイコン"></div>
                    <?php elseif($Washroom_independent_Label === 'no'): ?>
                      <div class="image_nashi"><img src="<?php echo esc_url(get_theme_file_uri('images/sennmenn-off.png')); ?>" alt="アイコン"></div>
                    <?php else: ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <div class="a_p_contents">
                <div class="a_p_one">
                  <?php if( get_field('Cost_Information') ):?>
                      <div class="a_p_one_single"><span><img src="<?php echo esc_url(get_theme_file_uri('images/hiyou.png')); ?>" alt="アイコン"></span><p><?php the_field('Cost_Information');?></p></div>
                    <?php else:?>
                  <?php endif; ?>
                </div>
                <div class="a_p_one">
                  <?php if( get_field('prevention') ):?>
                      <div class="a_p_one_single"><span><img src="<?php echo esc_url(get_theme_file_uri('images/bouhan.png')); ?>" alt="アイコン"></span><p><?php the_field('prevention');?></p></div>
                    <?php else:?>
                  <?php endif; ?>
                </div>
                <div class="a_p_one">
                  <?php if( get_field('Room_Facilities') ):?>
                      <div class="a_p_one_single"><span><img src="<?php echo esc_url(get_theme_file_uri('images/situnai.png')); ?>" alt="アイコン"></span><p><?php the_field('Room_Facilities');?></p></div>
                    <?php else:?>
                  <?php endif; ?>
                </div>
                <div class="a_p_one">
                  <?php if( get_field('Common_Areas') ):?>
                      <div class="a_p_one_single"><span><img src="<?php echo esc_url(get_theme_file_uri('images/kyouyou.png')); ?>" alt="アイコン"></span><p><?php the_field('Common_Areas');?></p></div>
                    <?php else:?>
                  <?php endif; ?>
                </div>
              </div>
            </div>

          </section>
        </section><!--PC版（タブレット含む）物件詳細エリア=-->

       
        <!--PC版（タブレット含む）ポイント詳細エリア=-->
        <section class="rent_contents">
          <div class="point-wrapper">
            <div class="point-ttl">POINT</div>
            <div class="cassettepoint">
              <strong><?php the_field ( "point" ); ?></strong>
              <div><?php the_field ( "point_Text" ); ?></div>
            </div>
          </div>
        </section><!--PC・SP版（タブレット含む）ポイント詳細エリア=-->


        <section class="tab-contents">
          
          <div class="wrapper">

	          <ul class="tab">
		          <li><a href="#roominfo">部屋情報</a></li>
		          <li><a href="#mapinfo">地図・周辺環境</a></li>
	          </ul>

		        <div id="roominfo" class="area">
              <div class="room_movie_wrapper">
                <h2>室内の動画</h2>
                <div class="room_movie">
                  <?php
                    // Get the Video Fields
                    $video_mp4 =  get_field('movie'); // MP4 Field Name
 
                    $attr =  array(
                      'mp4'      => $video_mp4,
                      'preload'  => 'auto'
                    );
                  ?>
                  <?php if($video_mp4):?>
                    <div class="movie"><?php echo wp_video_shortcode(  $attr );?></div>
                    <?php else:?><div class="no_movie"><img src="<?php echo esc_url(get_theme_file_uri('images/no_movie.png')); ?>" alt="テキストテキストテキスト"></div>
                  <?php endif; ?>    
                </div>
              </div>
			        <div class="room_info_wrapper">
                <h2>部屋の特徴・設備</h2>
                <div class="room_info"><?php the_field ( "Characteristic" ); ?></div>
              </div>
              <div class="property_overview_wrapper">
                <h2>物件概要</h2>
                <section class="property-top-tablet-pc-only">
                  <table>
                    <tbody>
                      <tr>
                        <th class="property-view-table-ttl">間取り詳細</th>
                        <td class="property-view-table-body"><?php the_field ( "Floor_plan_detail" ); ?></td>
                        <th class="property-view-table-ttl">構造</th>
                        <td class="property-view-table-body"><?php the_field ( "Construction" ); ?></td>
                      </tr>
                      <tr>
                        <th class="property-view-table-ttl">階建</th>
                        <td class="property-view-table-body"><?php the_field ( "Floor" ); ?></td>
                        <th class="property-view-table-ttl">築年月</th>
                        <td class="property-view-table-body"><?php the_field ( "Built_years" ); ?></td>
                      </tr>
                      <tr>
                        <th class="property-view-table-ttl">損保</th>
                        <td class="property-view-table-body"><?php the_field ( "Nonlife_insurance" ); ?></td>
                        <th class="property-view-table-ttl">駐車場</th>
                        <td class="property-view-table-body"><?php the_field ( "Parking_Lot" ); ?></td>
                      </tr>
                      <tr>
                        <th class="property-view-table-ttl">入居</th>
                        <td class="property-view-table-body"><?php the_field ( "Move-in" ); ?></td>
                        <th class="property-view-table-ttl">取引態様</th>
                        <td class="property-view-table-body"><?php the_field ( "torihiki_taiyou" ); ?></td>
                      </tr>
                      <tr>
                        <th class="property-view-table-ttl">情報更新日</th>
                        <td class="property-view-table-body"><?php the_modified_date('Y/n/j'); ?></td>
                        <th class="property-view-table-ttl">次回更新日</th>
                        <td class="property-view-table-body">次回更新日は情報更新日より8日以内</td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">契約期間</th>
                        <td class="property-view-table-body"><?php the_field ( "Contract_period" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">保証会社</th>
                        <td class="property-view-table-body"><?php the_field ( "Guarantor_Company" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">他：初期費用</th>
                        <td class="property-view-table-body"><?php the_field ( "Initial_cost" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">他：諸費用</th>
                        <td class="property-view-table-body"><?php the_field ( "Miscellaneous_Expenses" ); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </section><!--PC版（タブレット含む）物件詳細エリア=-->
                <section class="property-top-tablet-sp-only">
                  <table>
                    <tbody>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">入居条件</th>
                        <td class="property-view-table-body"><?php the_field ( "Occupancy_conditions" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">費用条件</th>
                        <td class="property-view-table-body"><?php the_field ( "Cost_terms_and_conditions" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">バス・トイレ・洗面所</th>
                        <td class="property-view-table-body"><?php the_field ( "Plumbing" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">キッチン</th>
                        <td class="property-view-table-body"><?php the_field ( "kitchen" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">セキュリティ</th>
                        <td class="property-view-table-body"><?php the_field ( "security" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">駐車・駐輪</th>
                        <td class="property-view-table-body"><?php the_field ( "Parking" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">バルコニー・テラス・庭</th>
                        <td class="property-view-table-body"><?php the_field ( "Balconies_Terraces_Gardens" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">共用部</th>
                        <td class="property-view-table-body"><?php the_field ( "Common_Areas" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">収納</th>
                        <td class="property-view-table-body"><?php the_field ( "receipt" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">室内設備・仕様</th>
                        <td class="property-view-table-body"><?php the_field ( "Room_Facilities" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">冷暖房・空調</th>
                        <td class="property-view-table-body"><?php the_field ( "Air_conditioning" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">情報設備・回線</th>
                        <td class="property-view-table-body"><?php the_field ( "Information_Facilities" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">立地・環境</th>
                        <td class="property-view-table-body"><?php the_field ( "Location" ); ?></td>
                      </tr>
                      <tr class=first-border>
                        <th class="property-view-table-ttl">その他の特徴</th>
                        <td class="property-view-table-body"><?php the_field ( "Other_characteristics" ); ?></td>
                      </tr>
                    </tbody>
                  </table>
                </section><!--PC版（タブレット含む）物件詳細エリア=-->
              </div>
		        </div><!--/area-->

		        <div id="mapinfo" class="area">
              <div class="map_info_wrapper">
                <h2>周辺環境写真</h2>
                <div class="map_info">
                  <ul class="map_info_flex">
                      <?php $s_images_facilities = get_field ( 'Nearby_facilities' );  //ギャラリーのスライダー用の小さい画像用にもう一度
                        if ( $s_images ) {
                          foreach ( $s_images_facilities as $s_image_facilities ) { ?>
                            <li>
                              <img src="<?php echo $s_image_facilities['url']; ?>" alt="" />
                              <div class="dtlslider_cstphoto-count"><p><?php echo $s_image_facilities['title'];?></p></div>
                            </li>
                          <?php 
                          }
                          }  //ギャラリーのスライダー用の小さい画像用にもう一度ここまで
                      ?>
                  </ul>
                </div>
                <h2>物件地図</h2>
                <div class="map">
                  <?php 

                    $location = get_field('Property_Map');

                    if( !empty($location) ):
                    ?>
                    <div class="acf-map">
	                    <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
		        </div><!--/area-->

          </div><!--wrapper-->

        </section>

        <section class="single-contact">

          <div class="contact-wrap">

            <h2>お問い合わせフォーム</h2>

              <div class="contact-form">

                <?php if( $page_flag === 1 ): ?>

                  <form method="post" action="">
                    <!-- （１）▼▼▼ -->
                    <input name="position" type="hidden" value="0">
                    <!-- （１）▲▲▲ -->
	                  <input class="dammy" type="submit" name="btn_confirm" value="入力内容を確認する">
                    <div class="element_wrap">
		                  <label>物件名</label>
		                  <p><?php echo $clean['property_name']; ?></p>
	                  </div>
	                  <div class="element_wrap">
		                  <label>お名前</label>
		                  <p><?php echo $clean['your_name']; ?></p>
	                  </div>
	                  <div class="element_wrap">
		                  <label>メールアドレス</label>
		                  <p><?php echo $clean['email']; ?></p>
	                  </div>
                    <div class="element_wrap">
		                  <label>電話番号</label>
		                  <p><?php echo $clean['tel']; ?></p>
	                  </div>
                    <div class="element_wrap">
		                  <label>お問い合わせ内容</label>
		                  <p>
                        <?php 
                          if( $clean['content'] === "one" ){ echo '最新の空室状況を知りたい'; } 
                          elseif( $clean['content'] === "two" ){ echo '実際に見学したい'; }
                          else{ echo 'その他の問合せ（下記のお問合せから内容を記述ください）'; } 
                        ?>
                      </p>
	                  </div>
                    <div class="element_wrap">
		                  <label>お問い合わせ内容</label>
		                  <p><?php echo nl2br($clean['contact']); ?></p>
	                  </div>
	                  <div class="element_wrap">
		                  <label>プライバシーポリシーに同意する</label>
		                  <p><?php if( $clean['agreement'] === "1" ){ echo '同意する'; }
		                    else{ echo '同意しない'; } ?></p>
	                  </div>
	                  <input type="submit" name="btn_back" value="戻る">
	                  <input type="submit" name="btn_submit" value="送信">
                    <input type="hidden" name="property_name" value="<?php echo $clean['property_name']; ?>">
	                  <input type="hidden" name="your_name" value="<?php echo $clean['your_name']; ?>">
	                  <input type="hidden" name="email" value="<?php echo $clean['email']; ?>">
                    <input type="hidden" name="tel" value="<?php echo $clean['tel']; ?>">
                    <input type="hidden" name="content" value="<?php echo $clean['content']; ?>">
                    <input type="hidden" name="contact" value="<?php echo $clean['contact']; ?>">
	                  <input type="hidden" name="agreement" value="<?php echo $clean['agreement']; ?>">
                  </form>

                <?php elseif( $page_flag === 2 ): ?>

                  <p class="sent_text">送信が完了しました。</p>
                  <p class="sent_text">自動送信メールが送られます。<br>担当者からは2営業日以内にご連絡いたします。</p>

                  
              
	                <form method="post" action="">
                       <!-- （１）▼▼▼ -->
                       <input name="position" type="hidden" value="0">
                       <!-- （１）▲▲▲ -->
	                    <input type="submit" name="btn_back_top" value="入力画面に戻る">
                  </form>
                  

                <?php else: ?>

                <?php if( !empty($error) ): ?>
	                <ul class="error_list">
	                  <?php foreach( $error as $value ): ?>
		                  <li><?php echo $value; ?></li>
	                  <?php endforeach; ?>
	                </ul>
                <?php endif; ?>

                <form method="post" action="">

                  <!-- （１）▼▼▼ -->
                  <input name="position" type="hidden" value="0">
                  <!-- （１）▲▲▲ -->
	                <input class="dammy" type="submit" name="btn_confirm" value="入力内容を確認する">

                  <div class="element_wrap">
		                <label>物件名</label>
		                <input class="property" type="text" name="property_name" value="<?php the_field ( "name" ); ?>">
	                </div>
	                <div class="element_wrap">
		                <label>お名前<span class="required">必須</sapn></label>
		                <input type="text" name="your_name" value="<?php if( !empty($clean['your_name']) ){ echo $clean['your_name']; } ?>">
	                </div>
	                <div class="element_wrap">
		                <label>メールアドレス<span class="required">必須</sapn></label>
		                <input type="text" name="email" value="<?php if( !empty($clean['email']) ){ echo $clean['email']; } ?>">
                  </div>
                  <div class="element_wrap">
		                <label>電話番号</label>
		                <input type="text" name="tel" placeholder="例：○○○-○○○○-○○○○" value="<?php if( !empty($clean['tel']) ){ echo $clean['tel']; } ?>">
	                </div>
                  <div class="element_wrap">
		                <label>お問い合わせ内容<span class="required">必須</sapn></label>
		                <label for="contact_one"><input id="contact_one" type="radio" name="content" value="one" <?php if( !empty($clean['content']) && $clean['content'] === "one" ){ echo 'checked'; } ?>>最新の空室状況を知りたい</label>
		                <label for="contact_two"><input id="contact_two" type="radio" name="content" value="two" <?php if( !empty($clean['content']) && $clean['content'] === "two" ){ echo 'checked'; } ?>>実際に見学したい</label>
                    <label for="contact_three"><input id="contact_three" type="radio" name="content" value="three" <?php if( !empty($clean['content']) && $clean['content'] === "three" ){ echo 'checked'; } ?>>その他の問合せ<span>（下記のお問合せから内容を記述ください）</span></label>
	                </div>
                  <div class="element_wrap">
		                <label>お問い合わせ内容</label>
		                <textarea name="contact"><?php if( !empty($clean['contact']) ){ echo $clean['contact']; } ?></textarea>
	                </div>
                  <div class="element_wrap">
		                <label for="agreement"><input id="agreement" type="checkbox" name="agreement" value="1" <?php if( !empty($clean['agreement']) && $clean['agreement'] === "1" ){ echo 'checked'; } ?>>プライバシーポリシーに同意する<span class="required">必須</sapn></label>
	                </div>
                  
	                <input type="submit" name="btn_confirm" value="入力内容を確認する">

                </form>

                <?php endif; ?>

              </div>

          </div>

        </section>
    
    
      </article><!-- #post-## -->

    <?php endwhile; // end of the loop. ?>

    
      <!-- 関連物件 -->
      <?php
        global $post;
        $term = array_shift(get_the_terms($post->ID, 'area'));
        $args = array(
          'numberposts' => 4, //８件表示(デフォルトは５件)
          'post_type' => 'rent', //カスタム投稿タイプ名
          'taxonomy' => 'area', //タクソノミー名 ←ここが追加
          'term' => $term->slug, //ターム名
          'orderby' => 'rand', //ランダム表示
          'post__not_in' => array($post->ID) //表示中の記事を除外
          );
      ?>
      <aside class="related_rent">
        <h3>同じエリアの物件</h3>
        <?php $myPosts = get_posts($args); if($myPosts) : ?>
          <ul class="related_rent_container">
          <?php foreach($myPosts as $post) : setup_postdata($post); ?>
            <li>
              <a href="<?php the_permalink(); ?>">
                <div class="related_thumb"><?php the_post_thumbnail(); ?></div>
                <p class="related_title"><?php the_field ( "name" ); ?></p>
              </a>
            </li>
          <?php endforeach; ?>
          <?php else : ?>
            <p>関連物件はまだありません。</p>
          <?php endif; wp_reset_postdata(); ?>
          </ul>
      </aside>

      <!-- 最近閲覧した物件 -->
      <aside class="latest_post_wrap">
        <h3>最近閲覧した物件</h3>
        <?php readpost_typecheack(4); ?>
      </aside>

      <!-- 人気物件 -->
      <aside class="popular_post">
        <h3>人気閲覧数物件</h3>
        <?php $cat = get_the_category(); ?>
        <?php $cat_id = isset( $cat[0] ) ? $cat[0]->term_id : ''; ?>
        <?php if ( function_exists( 'wpp_get_mostpopular' ) ) : ?>
        <?php $args = array( 
          'limit' => 4,
          'range' => 'last24hours',
          'order_by' => 'views',
          'thumbnail_width' => 600,
          'thumbnail_height' => 480,
          'post_type' => 'rent',
          'wpp_start' => '<ul>',
          'wpp_end' => '</ul>',
          'stats_views' => 0,
          'post_html' => '<li><a href="{url}"><div class="pop-thumb">{thumb_img}</div></a><a href="{url}"><div class="pop-title">{text_title}</div></a><span>{stats}</span></li>' ); ?>
        <?php wpp_get_mostpopular( $args ); ?>
        <?php endif; ?>
      </aside>

    </div><!--end contents-->

    <?php get_sidebar('rent'); ?>

  </main><!--end main container-->

</section><!--wrapper-->
	              	        
<?php get_footer(); ?>