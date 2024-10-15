<?php get_header(); ?>

<section id="wrapper">
    
  <main id="main" class="container two-columns site-main">

    <div class="contents">

      <div class="search_sort_order_contents">
        <div class="sso_flex">
          <div class="sso_text">
            <i class="fa-solid fa-arrow-up-z-a"></i>
            <p>並び替え</p>
          </div>
          <div class="sso_content">
            <?php
              $args = array(
		            'post_type'   => 'page',
		            'name'        => 'filter-search-2',
		            'post_status' => array( 'publish', 'private' ),
	            );
	            $posts_array = get_posts( $args );
	            if ( $posts_array && is_array( $posts_array ) ) {
		          $content = $posts_array[0]->post_content;
		          echo apply_filters( 'the_content', $content );
	            }
            ?>
          </div>
        </div>
      </div>

      <div class="modal_btn_wrap">
        <buttun class="lead-btn buttun" onclick="buttonClick()">
          <a href="#" class="btn_modal btn btn-border-1"><i class="fas fa-search"></i>より詳細な検索はコチラ</a>
        </buttun>
      </div>

      <?php while ( have_posts() ) : the_post(); ?>  <!--ループ開始-->

        <!--SP版-->
        <article class="archive-rent_article_sp only-sp">
          <div class="lr">
            <div class="block-thumbnail-flex">
              <div class="lr_l">
                <?php the_post_thumbnail();  ?>  <!--サムネイル表示-->
              </div>
              <div class="lr_r">
                <div class="type"><?php the_field ( "Building_Type" ); ?></div>  <!--the_field('フィールド名')でACF（Advanced Custom Fields）設定したカスタムフィールドを表示できます-->
                <h2 class="renttitle"><?php the_title() ?></h2>  <!--タイトル表示-->
                <div>築<?php the_field ( "Age" ); ?>年/<?php the_field ( "story2" ); ?></div>
                <div class="address"><?php the_field ( "Street_address" ); ?></div>
              </div><!--lr_r-->
            </div>
            
        

          <div class="detail">
              
              <div class="detail-flex">
                <div class="bt-contents">
                  <div class="price"><?php the_field ( "rent" ); ?><span class="price-sub">万円</span><span class="kanrihi">（管理費 <?php the_field ( "Administrative" ); ?>）</span></div>
                  <div class="deposit-flex">
                    <div class="deposit"><?php the_field ( "Deposit" ); ?></div>
                    <div class="deposit2"><?php the_field ( "deposit2" ); ?></div>
                  </div>

                  <div class="size-flex">
                    <div class="floor"><?php the_field ( "Floor_plan" ); ?>  / </div>
                    <div class="occupied"><?php the_field ( "occupied_area" ); ?>  / </div>
                    <div class="story"><?php the_field ( "story2" ); ?></div>
                  </div>

                </div>
                <div class="btn-wrap"><a href="<?php the_permalink(); ?>" class="btn btn--cart-2 btn-c-2">詳細を見る</a></div>
              </div>
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
          </div>

        </article>
 
        <!--PCとタブレット版-->
        <article class="archive-rent_article only-tablet-pc">
          <div class="lr">
            <div class="lr_l">
              <?php the_post_thumbnail();  ?>  <!--サムネイル表示-->
            </div>
            <div class="lr_r">
              <div class="type"><?php the_field ( "Building_Type" ); ?></div>  <!--the_field('フィールド名')でACF（Advanced Custom Fields）設定したカスタムフィールドを表示できます-->
              <h2 class="renttitle"><?php the_title() ?></h2>  <!--タイトル表示-->
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
              <div class="place">
                <ul>
                  <li><?php the_field ( "Street_address" ); ?></li>
                    <?php
                      if ( have_rows ( 'Nearest_station' ) ) :  //繰り返しフィールドに設定した項目の表示方法
                      echo '<li>';
                      while ( have_rows ( 'Nearest_station' ) ) : the_row();  //親フィールド名でループ
                      echo '<div id="station">';
                      echo get_sub_field( 'station' );  //子フィールドを表示する関数。get_sub_field( '子フィールド名' )
                      echo '</div>';
                      endwhile;
                      echo '</li>';
                      endif;
                    ?>
                  <li>
                    <div>築<?php the_field ( "Age" ); ?>年</div>
                    <div><?php the_field ( "Building_Type" ); ?></div>
                  </li>
                </ul>
              </div><!--place-->
            </div><!--lr_r-->
          </div><!--lr-->

          <table class="detail">
              <tr>
                <th>階</th>
                <th>賃料</th>
                <th>管理費</th>
                <th>敷/礼/保証/敷引,償却</th>
                <th>間取り</th>
                <th>専有面積</th>
                <th></th>
              </tr>
              <tr>
                <td><?php the_field ( "story2" ); ?></td>
                <td class="rentrent"><?php the_field ( "rent" ); ?>万円</td>
                <td><?php the_field ( "Administrative" ); ?></td>
                <td><?php the_field ( "Deposit" ); ?>/<?php the_field ( "deposit2" ); ?>/<?php the_field ( "deposit3" ); ?>/<?php the_field ( "Amortization" ); ?></td>
                <td><?php the_field ( "Floor_plan" ); ?></td>
                <td><?php the_field ( "occupied_area" ); ?></td>
                <td><div class="btn-wrap"><a href="<?php the_permalink(); ?>" class="btn-rent-arechive btn--cart-2 btn-c-2">詳細を見る</a></div></td>
              </tr>
          </table>

        </article>

      <?php endwhile; ?>  

      <?php
        if (function_exists("pagination")) {
          pagination($wp_query->max_num_pages);
        }
      ?>

    </div><!--end contents-->

  </main><!--end main container-->

</section><!--wrapper-->
	              	        
<?php get_footer(); ?>