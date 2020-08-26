<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

//商品総数とページ数を取得する
$total_item_count = get_item_total_count($db);
$total_page_count = calc_total_pages($total_item_count['total_count']);

//GETでページ番号が送られてきた場合
if(isset($_GET['page']) === true){
    $current_page = intval($_GET['page']);
    //GETで不正な数字が送られてきていないか確認
    if($current_page < 1 || $current_page > $total_page_count){
      set_error("存在しないページを参照しようとしました。");
      redirect_to(HOME_URL);
    }
    //SQLのLIMIT句で使用するoffsetの値を計算する
    $offset = ($current_page - 1) * ITEM_COUNT_PER_PAGE;
    $items = get_open_items($db,$offset);
}
else{
  //初回読み込み時の処理
  $items = get_open_items($db);
  $current_page = 1;
}


$token = get_csrf_token();
include_once VIEW_PATH . 'index_view.php';