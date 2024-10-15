<form role="search" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <input name="s" type="text" value="<?php echo get_search_query(); ?>" placeholder="キーワード">
  
  <?php
  /* セレクトボックス */
  $tax = 'area';
  $placeholder = 'エリアを選ぶ';

  // 選択中のterm
  $term_selected = get_query_var($tax, ''); 

  // タームリストを出力
  $terms = get_terms(array(
    'taxonomy' => $tax,
    'hide_empty' => false, // 空のタームも表示する場合
    'pad_counts' => true, // 子タームの件数を含める
  ));

  // 出力
  $html = "<select name='{$tax}'><option value=''>{$placeholder}</option>";
  foreach($terms as $term){
    $term_id = $term->term_id;
    $selected = $term_id == $term_selected ? ' selected' : ''; // 選択中のtermならselected
    $disabled = $term->count == 0 ? ' disabled' : ''; // 0件のタームはdisabled
    $term_name = $term->parent > 0 ? ' '.$term->name : $term->name; // 子termにインデントを付ける      
    $html .= "<option value='{$term_id}'{$selected}{$disabled}>{$term_name}</option>";
  }
  $html .= "</select>";
  echo $html;

  /* チェックボックス */
  $tax = 'kind';

  // 選択中のterm
  $term_selected = get_query_var($tax, []); // 複数なので配列

  // タームリストを出力
  $terms = get_terms(array(
    'taxonomy' => $tax,
    'orderby' => 'count', // 件数順にする場合
    'order' => 'DESC',
  ));

  //　出力
  $html = "<div>";   
  foreach($terms as $term){
    $term_id = $term->term_id;
    $checked = $term_id == $term_checked ? ' checked' : ''; // 選択中のtermならchecked      
    $term_name = $term->name;      
    $html .= "<label><input name='{$tax}[]' type='checkbox' value='{$term_id}'{$checked}>{$term_name}</label>";
  }
  $html .= "</div>";
  echo $html;

  /* 範囲指定 */
  $min_num = 'min_num';
  $max_num = 'max_num';

  // 入力された数値
  $min_value = get_query_var($min_num, '');
  $max_value = get_query_var($max_num, '');

  //　出力
  echo "<div>
    <input name='{$min_num}' type='number' min='0' step='10' value='{$min_value}'>〜
    <input name='{$max_num}' type='number' min='0' step='10' value='{$max_value}'>
    </div>";
  ?>

  <button type="submit">検索する</button>
</form>