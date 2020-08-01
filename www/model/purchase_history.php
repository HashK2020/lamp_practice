<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

/*購入履歴の保存処理*/
function insert_purchase_history($db,$user_id,$total_price){
  $sql = "
    INSERT INTO
      purchase_history(
        user_id,
        created,
        total_price
      )
    VALUES(?,?,?)
  ";

  return execute_query($db,$sql,array($user_id,date("Y-m-d H:i:s"),$total_price));
}

//管理者(admin)用
function get_purchase_historys($db){
  $sql = "
    SELECT
      history_id,
      created,
      total_price
    FROM
      purchase_history
  ";

  return fetch_all_query($db,$sql);
}



//ログインユーザ用
function get_purchase_history($db,$user_id){
  $sql = "
    SELECT
      history_id,
      created,
      total_price
    FROM
      purchase_history
    WHERE
      user_id = ?
  ";

  return fetch_query($db,$sql,array($user_id));
}

/*最後にinsertされたレコードの、主キーの値を取得*/
function get_last_insert_id($db){
  $sql = "
    SELECT
      LAST_INSERT_ID()
    ";
  
  return fetch_query($db,$sql);
}

?>