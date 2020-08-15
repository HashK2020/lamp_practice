<?php 
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'purchase_history.php';
require_once MODEL_PATH . 'user.php';

session_start();

if(is_logined() === false){
    redirect_to(LOGIN_URL);
}

$db = get_db_connect();

$user = get_login_user($db);

$token = get_csrf_token();

//ユーザが管理者(admin)なら
if ($user['type'] === USER_TYPE_ADMIN){
    //履歴情報をすべて読み込む
    $historys = get_purchase_historys($db);
}
else{
    //ログインユーザの履歴情報を読み込む
    $historys = get_purchase_history($db,$user['user_id']);
}

include_once VIEW_PATH . '/purchase_history_view.php';

?>