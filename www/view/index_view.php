<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>商品一覧</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'index.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  

  <div class="container">
    <h1>商品一覧</h1>
    <div class="sort text-right">
      <form method="get" id="sort_form">
        <select name="sort" id="sort">
          <option value="1" <?php print_selected(NEW_ARRIVALS_ORDER,$category_num); ?>>新着順</option>
          <option value="2" <?php print_selected(ORDER_LOW_PRICE,$category_num); ?>>価格の安い順</option>
          <option value="3" <?php print_selected(ORDER_HIGH_PRICE,$category_num); ?>>価格の高い順</option>
        </select>
        <input id="submit-sort" type="submit" value="並べ替え">
      </form>
    </div>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <div class="card-deck">
      <div class="row">
      <?php foreach($items as $item){ ?>
        <div class="col-6 item">
          <div class="card h-100 text-center">
            <div class="card-header">
              <?php print(h($item['name'])); ?>
            </div>
            <figure class="card-body">
              <img class="card-img" src="<?php print(h(IMAGE_PATH . $item['image'])); ?>">
              <figcaption>
                <?php print(h(number_format($item['price']))); ?>円
                <?php if($item['stock'] > 0){ ?>
                  <form action="index_add_cart.php" method="post">
                    <input type="submit" value="カートに追加" class="btn btn-primary btn-block">
                    <input type="hidden" name="item_id" value="<?php print(h($item['item_id'])); ?>">
                    <input type="hidden" name="token" value="<?php print($token) ;?>">
                  </form>
                <?php } else { ?>
                  <p class="text-danger">現在売り切れです。</p>
                <?php } ?>
              </figcaption>
            </figure>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
    <!--ページ番号のリンク-->
    <?php if($items !== false){?>
      <div class="mt-5">
        <ul class="pagination justify-content-center">
          <!--「前へ」ボタン-->
          <li class="page-item <?php if($current_page === FIRST_PAGE){ print('disabled'); }; ?>">
            <form method="get">
              <input type="submit" class="page-link" value="前へ">
              <input type="hidden" name="page" value="<?php print($current_page - 1); ?>">
              <?php if(isset($category_num) === true){ ?>
                <input type="hidden" name="category_num" value="<?php print($category_num); ?>">
              <?php } ?>
            </form>
          </li>
          <!--ページ番号ボタン-->
          <?php for($i=0;$i<$total_page_count;$i++){ ?>
          <li class="page-item <?php if($i+1 === $current_page){ print('active'); }; ?>">
              <form method="get">
                <input type="submit" class="page-link" name="page" value="<?php print($i+1); ?>">
                <?php if(isset($category_num) === true){ ?>
                  <input type="hidden" name="category_num" value="<?php print($category_num); ?>">
                <?php } ?>
              </form>
          </li>
          <?php } ?>
          <!--「次へ」ボタン-->
          <li class="page-item <?php if($current_page === $total_page_count){ print('disabled'); }; ?>">
            <form method="get">
              <input type="submit" class="page-link" value="次へ">
              <input type="hidden" name="page" value="<?php print($current_page + 1); ?>">
              <?php if(isset($category_num) === true){ ?>
                <input type="hidden" name="category_num" value="<?php print($category_num); ?>">
              <?php } ?>
            </form>
          </li>
        </ul>
      </div>
      <p class="text-center">
        <?php print(number_format($total_item_count['total_count'])); ?>件中 
        <?php print(number_format(($current_page - 1) * ITEM_COUNT_PER_PAGE + 1)); ?> - 
        <?php
          if(($current_page * ITEM_COUNT_PER_PAGE) > $total_item_count['total_count']){
            print(number_format($total_item_count['total_count']));
          }
          else{
            print(number_format($current_page * ITEM_COUNT_PER_PAGE));
          }
        ?>件目の商品
      </p>
    <?php }; ?>
  </div>
</body>
<script type="text/javascript" src="../assets/javascript/sort.js"></script>
</html>