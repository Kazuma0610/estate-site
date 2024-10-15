<?php if( comments_open() ){ ?>
	<div id="comments">
		<p class="com-p">comments</p>
		<?php if( have_comments() ){ ?>
		<ol id="comments-list">
			<?php wp_list_comments(); ?>
		</ol>
		<?php } ?>
		<?php
          $args = array(
	      //ユーザー登録してログインしたユーザーのみコメントをつけられるようにする設定がONの場合。
	      'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'コメントを残すには<a href="https://sample-one.tokyo/login/">ログイン</a>してください。' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
	      //ログイン中の場合
	      'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( '<a href="%1$s">%2$s</a>としてログイン中です。<br><a href="%3$s" title="Log out of this account">ログアウトする。</a>' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
	      //通常のゲスト
	      'comment_notes_before' => '<p class="comment-notes">' . __( 'メールアドレスが公開されることはありません。<br>' ) . ( get_option( 'require_name_email' ) ? sprintf( ' ' . __( 'Required fields are marked %s' ), '<span class="required">*</span>' ) : '' ) . '</p>',
           );
           comment_form( $args );
        ?>
	</div>
<?php } ?>