<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';

session_start();

if(is_logined() === true){
  redirect_to(HOME_URL);
}

$name = get_post('name');
$password = get_post('password');

$db = get_db_connect();

/*トークンの内容が不一致なら*/
if(is_valid_csrf_token($_POST['token']) === false){
  set_error('csrfを検出しました。');
  redirect_to(LOGIN_URL);
}

$user = login_as($db, $name, $password);
if( $user === false){
  set_error('ログインに失敗しました。');
  //set_error(var_dump($user));
  redirect_to(LOGIN_URL);
}

set_message('ログインしました。');
if ($user['type'] === USER_TYPE_ADMIN){
  redirect_to(ADMIN_URL);
}
redirect_to(HOME_URL);