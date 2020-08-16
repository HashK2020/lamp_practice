<?php 
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'purchase_detail.php';
require_once MODEL_PATH . 'purchase_history.php';
require_once MODEL_PATH . 'user.php';

session_start();

if(is_logined() === false){
    redirect_to(LOGIN_URL);
}

$db = get_db_connect();

$user = get_login_user($db);

if(is_valid_csrf_token($_POST['token']) === false){
    set_error('csrfを検出しました。');
    redirect_to(HISTORY_URL);
}

$historys = get_purchase_history($db,$user['user_id']);

if(is_my_history_id($historys,$_POST['history_id']) === false){
    set_error('他のユーザーの購入明細は閲覧できません。');
    redirect_to(HISTORY_URL);
}

$details = get_purchase_detail($db,$_POST['history_id']);

include_once VIEW_PATH . 'purchase_detail_view.php';

?>