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
  /*直接値を指定するとエラーが発生しない...しかし、変数を指定するとエラーが発生する...
  つまり、変数内に適切な数字が入っていない可能性がある。続きは明日から。 */
  return execute_query($db,$sql,array($history_id["LAST_INSERT_ID()"],$purchase_price,$amount,$item_id));
  /*set_error(var_dump($history_id));
  set_error(var_dump($history_id["LAST_INSERT_ID()"]));
  set_error(var_dump($purchase_price));
  set_error(var_dump($amount));
  set_error(var_dump($item_id));
  return execute_query($db,$sql,array(1,25000,1,1));
  */
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