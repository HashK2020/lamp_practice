<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'cart.php';


session_start();

if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);

$carts = get_user_carts($db, $user['user_id']);

/*トークンの内容が不一致なら*/
if(is_valid_csrf_token($_POST['token']) === false){
  set_error('csrfを検出しました。');
  redirect_to(CART_URL);
}

$total_price = sum_carts($carts);

if(purchase_carts($db, $carts,$user['user_id'],$total_price) === false){
  set_error('商品が購入できませんでした。');
  redirect_to(CART_URL);
} 



include_once '../view/finish_view.php';