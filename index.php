<?php get_header(); ?>

<section id="wrapper">

    <div class="mv-pc">

      <div class="mv-text">
        <p class="eachTextAnime">最高の住まいを、あなたの手に</p>
      </div>
    
    </div>

    <div class="mv-tablet">

      <div class="mv-text">
        <p class="eachTextAnime">最高の住まいを、あなたの手に</p>
      </div>

    </div>

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

  <main id="main" class="top-container two-columns site-main">

    

    <div class="contents">

      <!--検索窓-->

	    <div class="main-search-pc">

        <?php
          $args = array(
	        'post_type'   => 'page',
	        'name'        => 'filter-search-1',
	        'post_status' => array( 'publish', 'private' ),
          );
          $posts_array = get_posts( $args );
            if ( $posts_array && is_array( $posts_array ) ) {
	          $content = $posts_array[0]->post_content;
	          echo apply_filters( 'the_content', $content );
            }
        ?>

      </div>

      <div class="main-search-sp">

        <?php
          $args = array(
	        'post_type'   => 'page',
	        'name'        => 'filter-search-4',
	        'post_status' => array( 'publish', 'private' ),
          );
          $posts_array = get_posts( $args );
            if ( $posts_array && is_array( $posts_array ) ) {
	          $content = $posts_array[0]->post_content;
	          echo apply_filters( 'the_content', $content );
            }
        ?>

      </div>

      <!--検索窓-->

      <!--section1-->
      <div class="reco-aria-shibuya">

        <div class="fixed-background background-1">
        </div>

        <div class="fixed-background-sp">
        </div>

        <div class="reco-area-contents">

          <div class="reco-area-text">
            <i class="fa-solid fa-building"></i>
            <h2>渋谷エリア・オススメ物件</h2>
            <p>
              ああああああああああああああああああああ
              ああああああああああああああああああああ
              ああああああああああああああああああああ
              ああああああああああああああああああああ
              ああああああああああああああああああああ
            </p>
          </div>

          <div class="reco-area-property-pc">
            <!-- 渋谷区オススメ物件 -->

            <?php query_posts( array(
              'post_type' => 'rent', //カスタム投稿名
              'taxonomy' => 'recommendation',
              'term' => 'osu-sibuyaku',
              'posts_per_page' => 6 //表示件数（ -1 = 全件 ）
              )); ?>
              
              <?php if(have_posts()): ?>
              <ul class="reco_rent_container">
                <?php while(have_posts()):the_post(); ?>
                    <li>
                      <a href="<?php the_permalink(); ?>">
                        <div class="related_thumb"><?php the_post_thumbnail(); ?></div>
                      </a>

                      <table>
                        <tbody>

                          <tr class=first-border>
                            <th class="property-view-table-ttl">物件名</th>
                            <td class="property-view-table-body"><?php the_field ( "name" ); ?></td>
                          </tr>

                          <tr class=first-border>
                            <th class="property-view-table-ttl">賃料</th>
                            <td class="property-view-table-body"><?php the_field ( "rent" ); ?>万円</td>
                          </tr>

                          <tr class=first-border>
                            <th class="property-view-table-ttl">所在地</th>
                            <td class="property-view-table-body"><?php the_field ( "Street_address" ); ?></td>
                          </tr>

                          <tr class=first-border>
                            <th class="property-view-table-ttl">築年数</th>
                            <td class="property-view-table-body"><?php the_field ( "Age" ); ?>年</td>
                          </tr>
              
                        </tbody>

                      </table>
                      
                      <div class="btn-wrap"><a href="<?php the_permalink(); ?>" class="btn btn--cart-2 btn-c-2">詳細を見る</a></div>
                    </li>
                <?php endwhile; else: ?>
                  <p>オススメ物件はまだありません。</p>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
              </ul>

          </div>

          <div class="reco-area-property-sp">

            <?php query_posts( array(
              'post_type' => 'rent', //カスタム投稿名
              'taxonomy' => 'recommendation',
              'term' => 'osu-sibuyaku',
              'posts_per_page' => 6 //表示件数（ -1 = 全件 ）
              )); ?>
              
              <?php if(have_posts()): ?>
              <ul class="reco_rent_container_sp">
                <?php while(have_posts()):the_post(); ?>
                    <li>

                      <a href="<?php the_permalink(); ?>">
                        <div class="related_thumb"><?php the_post_thumbnail(); ?></div>
                      </a>

                      <table class="table-sp">
                        <tbody>
                          <tr class=first-border-sp>
                            <th class="property-view-table-ttl">物件名</th>
                            <td class="property-view-table-body"><?php the_field ( "name" ); ?></td>
                          </tr>

                          <tr class=first-border-sp>
                            <th class="property-view-table-ttl">賃料</th>
                            <td class="property-view-table-body"><?php the_field ( "rent" ); ?>万円</td>
                          </tr>

                          <tr class=first-border-sp>
                            <th class="property-view-table-ttl">所在地</th>
                            <td class="property-view-table-body"><?php the_field ( "Street_address" ); ?></td>
                          </tr>

                          <tr class=first-border-sp>
                            <th class="property-view-table-ttl">築年数</th>
                            <td class="property-view-table-body"><?php the_field ( "Age" ); ?>年</td>
                          </tr>
                        </tbody>
                      </table>
                      
                      <div class="btn-wrap-sp">
                        <a href="<?php the_permalink(); ?>" class="btn btn--cart-2 btn-c-2">詳細を見る</a>
                      </div>
                      
                    </li>
                <?php endwhile; else: ?>
                  <p>オススメ物件はまだありません。</p>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
              </ul>

              <div class="more">
					      <button>もっと物件を見る</button>
				      </div>

          </div><!--reco-area-property-sp-->

        </div>

      </div>

      <!--section2-->
      <div class="reco-aria-setagaya">

        <div class="fixed-background background-2">
        </div>

        <div class="fixed-background-sp-2">
        </div>

        <div class="reco-area-contents">
          
          <div class="reco-area-text-setagaya-right">
            <div class="reco-area-text-setagaya">
              <i class="fa-solid fa-building"></i>
              <h2>世田谷エリア・オススメ物件</h2>
              <p>
                ああああああああああああああああああああ
                ああああああああああああああああああああ
                ああああああああああああああああああああ
                ああああああああああああああああああああ
                ああああああああああああああああああああ
              </p>
            </div>
          </div>

          <div class="reco-area-property-pc">
            <!-- 世田谷区オススメ物件 -->

            <?php query_posts( array(
              'post_type' => 'rent', //カスタム投稿名
              'taxonomy' => 'recommendation',
              'term' => 'osu-setagayaku',
              'posts_per_page' => 6 //表示件数（ -1 = 全件 ）
              )); ?>
              
              <?php if(have_posts()): ?>
              <ul class="reco_rent_container">
                <?php while(have_posts()):the_post(); ?>
                    <li>
                      <a href="<?php the_permalink(); ?>">
                        <div class="related_thumb"><?php the_post_thumbnail(); ?></div>
                      </a>

                      <table>
                        <tbody>

                          <tr class=first-border>
                            <th class="property-view-table-ttl">物件名</th>
                            <td class="property-view-table-body"><?php the_field ( "name" ); ?></td>
                          </tr>

                          <tr class=first-border>
                            <th class="property-view-table-ttl">賃料</th>
                            <td class="property-view-table-body"><?php the_field ( "rent" ); ?>万円</td>
                          </tr>

                          <tr class=first-border>
                            <th class="property-view-table-ttl">所在地</th>
                            <td class="property-view-table-body"><?php the_field ( "Street_address" ); ?></td>
                          </tr>

                          <tr class=first-border>
                            <th class="property-view-table-ttl">築年数</th>
                            <td class="property-view-table-body"><?php the_field ( "Age" ); ?>年</td>
                          </tr>
              
                        </tbody>

                      </table>
                      
                      <div class="btn-wrap"><a href="<?php the_permalink(); ?>" class="btn btn--cart-2 btn-c-2">詳細を見る</a></div>
                    </li>
                <?php endwhile; else: ?>
                  <p>オススメ物件はまだありません。</p>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
              </ul>

          </div>

          <div class="reco-area-property-sp">

            <?php query_posts( array(
              'post_type' => 'rent', //カスタム投稿名
              'taxonomy' => 'recommendation',
              'term' => 'osu-setagayaku',
              'posts_per_page' => 6 //表示件数（ -1 = 全件 ）
              )); ?>
              
              <?php if(have_posts()): ?>
              <ul class="reco_rent_container_setagaya_sp">
                <?php while(have_posts()):the_post(); ?>
                    <li>

                      <a href="<?php the_permalink(); ?>">
                        <div class="related_thumb"><?php the_post_thumbnail(); ?></div>
                      </a>

                      <table class="table-sp">
                        <tbody>
                          <tr class=first-border-sp>
                            <th class="property-view-table-ttl">物件名</th>
                            <td class="property-view-table-body"><?php the_field ( "name" ); ?></td>
                          </tr>

                          <tr class=first-border-sp>
                            <th class="property-view-table-ttl">賃料</th>
                            <td class="property-view-table-body"><?php the_field ( "rent" ); ?>万円</td>
                          </tr>

                          <tr class=first-border-sp>
                            <th class="property-view-table-ttl">所在地</th>
                            <td class="property-view-table-body"><?php the_field ( "Street_address" ); ?></td>
                          </tr>

                          <tr class=first-border-sp>
                            <th class="property-view-table-ttl">築年数</th>
                            <td class="property-view-table-body"><?php the_field ( "Age" ); ?>年</td>
                          </tr>
                        </tbody>
                      </table>
                      
                      <div class="btn-wrap-sp">
                        <a href="<?php the_permalink(); ?>" class="btn btn--cart-2 btn-c-2">詳細を見る</a>
                      </div>
                      
                    </li>
                <?php endwhile; else: ?>
                  <p>オススメ物件はまだありません。</p>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
              </ul>

              <div class="more-setagaya">
					      <button>もっと物件を見る</button>
				      </div>

          </div><!--reco-area-property-sp-->


        </div>

      </div>

      <!--section3（ブログ）-->
      <div class="blog-contents">

        <div class="fixed-background background-3">
        </div>

        <div class="fixed-background-sp-3">
        </div>

        <div class="blog-area-content">

          <div class="blog-text-left">
            <i class="fa-solid fa-book-open"></i>
            <h2>スタッフブログ</h2>
            <p>
              ああああああああああああああああああああ
              ああああああああああああああああああああ
              ああああああああああああああああああああ
              ああああああああああああああああああああ
              ああああああああああああああああああああ
            </p>
          </div>

          <div class="blog-wrapper">

            <ul class="blog-flex">
              
              <?php
                $args = array(
                  'posts_per_page' => 4 //表示件数の指定
                );
                $posts = get_posts($args);
                foreach ($posts as $post):
                setup_postdata($post);
              ?>
                <li>
                  <a href="<?php the_permalink(); ?>">
                    <!-- アイキャッチ表示 -->
                    <div class="blog_thumb">
                      <?php the_post_thumbnail('medium'); ?>
                      <span class="thumb-cat">
                        <?php
                          $categories = get_the_category();
                          if ( $categories ) {
	                          echo $categories[1]->name;
                          }
                        ?>
                      </span>
                    </div>
                    <!-- タイトル表示 -->
                    <p class="blog_title"><?php the_title(); ?></p>
                    <!--日付表示-->
                    <p class="blog_date"><?php the_date(); ?></p>
                  </a>
                </li>
              <?php 
                endforeach;//ループの終了
                wp_reset_postdata();
              ?>

            </ul>

            <div class="blog-archive">
              <a href="https://sample-one.tokyo/category/blog/" class="btn btn-radius-solid">ブログ一覧<i class="fas fa-angle-right fa-position-right"></i></a>
            </div>

          </div>

        </div>

        <div class="news-area-content">

          <h2><span>最新のお知らせ</span></h2>
          <div class="news-content">
            <?php echo do_shortcode('[news_list]'); ?>
            <div class="news-btn">
              <a href="https://sample-one.tokyo/news/" class="btn btn-radius-solid">お知らせ一覧<i class="fas fa-angle-right fa-position-right"></i></a>
            </div>
          </div>

        </div>

      </div>




    </div><!--end contents-->

	<!--ここにサイドバー有った-->

  </main><!--end main container-->

</section><!--wrapper-->
	              	        
<?php get_footer(); ?>