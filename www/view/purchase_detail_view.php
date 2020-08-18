<!DOCTYPE html>
<html lang="ja">
    <head>
        <?php include VIEW_PATH . 'templates/head.php'; ?>
        <title>購入明細</title>
        <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'purchase_detail.php'); ?>">
    </head>
    <body>
        <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
        <h1>購入明細</h1>
        <div class="container">
            
            <?php include VIEW_PATH . 'templates/messages.php'; ?>
            
            <p>注文番号：<?php print($_POST['history_id']); ?></p>
            <p>購入日時：<?php print($_POST['created']); ?></p>
            <p>合計金額：<?php print(number_format($_POST['total_price'])); ?></p>
            
            <?php if(count($details) > 0){ ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>商品名</th>
                            <th>購入時の商品価格</th>
                            <th>購入数</th>
                            <th>小計</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($details as $detail){ ?>
                            <tr>
                                <td><?php print(h($detail['name'])); ?></td>
                                <td><?php print(number_format(h($detail['purchase_price']))); ?></td>
                                <td><?php print(h($detail['amount'])); ?></td>
                                <td><?php print(calclate_subtotal_price($detail['purchase_price'],$detail['amount'])); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else{ ?>
                <p>購入明細は存在しません。</p>
            <?php } ?>
        </div>
        
    </body>
</html>