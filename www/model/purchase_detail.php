<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

/*購入詳細の保存処理*/
function insert_purchase_detail($db,$history_id,$purchase_price,$amount,$item_id){
  $sql = "
    INSERT INTO
      purchase_detail(
        history_id,
        purchase_price,
        amount,
        item_id
      )
    VALUES(?,?,?,?)
  ";

  return execute_query($db,$sql,array($history_id["LAST_INSERT_ID()"],$purchase_price,$amount,$item_id));
}

function get_purchase_detail($db,$history_id){
    $sql = "
      SELECT
        detail.purchase_price,
        detail.amount,
        items.name
      FROM
        purchase_detail as detail
      INNER JOIN
        items
      ON
        detail.item_id = items.item_id
      WHERE
        detail.history_id = ?
    ";
  
    return fetch_all_query($db,$sql,array($history_id));
  }

?>