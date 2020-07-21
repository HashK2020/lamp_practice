<?php
/*var_dump*/
function dd($var){
  var_dump($var);
  exit();
}
/*リダイレクトを行う*/
/*@param str $url URL*/
function redirect_to($url){
  header('Location: ' . $url);
  exit;
}
/*スーパーグローバル関数GETからデータを取り出す*/
/*@param str $name キーの名前*/
/*@return str キーに対応付けられた内容*/
function get_get($name){
  if(isset($_GET[$name]) === true){
    return $_GET[$name];
  };
  return '';
}
/*スーパーグローバル関数POSTからデータを取り出す*/
/*@param str キーの名前*/
/*@return str キーに対応付けられた内容*/
function get_post($name){
  if(isset($_POST[$name]) === true){
    return $_POST[$name];
  };
  return '';
}
/*スーパーグローバル関数FILEからデータを取り出す*/
/*@param str キーの名前*/
/*@return str キーに対応付けられた内容*/
function get_file($name){
  if(isset($_FILES[$name]) === true){
    return $_FILES[$name];
  };
  return array();
}
/*スーパーグローバル関数SESSIONからデータを取り出す*/
/*@param str キーの名前*/
/*@return str キーに対応付けられた内容*/
function get_session($name){
  if(isset($_SESSION[$name]) === true){
    return $_SESSION[$name];
  };
  return '';
}
/*スーパーグローバル関数SESSIONにデータを登録する*/
/*@param str $name 登録するデータのキー名*/
/*@param str $value 登録するデータの内容*/
function set_session($name, $value){
  $_SESSION[$name] = $value;
}
/*スーパーグローバル関数SESSIONにエラー情報を登録する*/
/*@param str $error エラーの内容*/
function set_error($error){
  $_SESSION['__errors'][] = $error;
}
/*エラーを取得する*/
/*@return array エラー情報*/
function get_errors(){
  $errors = get_session('__errors');
  if($errors === ''){
    return array();
  }
  set_session('__errors',  array());
  return $errors;
}
/*エラーが存在するかどうか*/
/*return boolean*/
function has_error(){
  return isset($_SESSION['__errors']) && count($_SESSION['__errors']) !== 0;
}
/*メッセージをスーパーグローバル関数SESSIONに登録する*/
/*@param str $message メッセージの内容*/
function set_message($message){
  $_SESSION['__messages'][] = $message;
}
/*スーパーグローバル関数SESSIONからメッセージを取得する*/
/*@return array　メッセージ*/
function get_messages(){
  $messages = get_session('__messages');
  if($messages === ''){
    return array();
  }
  set_session('__messages',  array());
  return $messages;
}
/*ユーザがログインしているかどうか*/
/*@return boolean*/
function is_logined(){
  return get_session('user_id') !== '';
}
/*アップロードする画像の名前を生成*/
function get_upload_filename($file){
  if(is_valid_upload_image($file) === false){
    return '';
  }
  $mimetype = exif_imagetype($file['tmp_name']);
  $ext = PERMITTED_IMAGE_TYPES[$mimetype];
  return get_random_string() . '.' . $ext;
}
/*Hash関数を用いて、ランダムな名前を生成する*/
/*@return str 生成した文字列*/
function get_random_string($length = 20){
  return substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, $length);
}
/*画像を保存する*/
function save_image($image, $filename){
  return move_uploaded_file($image['tmp_name'], IMAGE_DIR . $filename);
}
/*画像を削除する*/
/*@param str $filename 画像名*/
function delete_image($filename){
  if(file_exists(IMAGE_DIR . $filename) === true){
    unlink(IMAGE_DIR . $filename);
    return true;
  }
  return false;
  
}


/*文字列の長さが最小長以上最大長以下かどうか*/
/*@param str $string チェックしたい文字列*/
/*@param int $minimum_length 最小長*/
/*@param int $maximum_length 最大長*/
/*@return boolean*/
function is_valid_length($string, $minimum_length, $maximum_length = PHP_INT_MAX){
  $length = mb_strlen($string);
  return ($minimum_length <= $length) && ($length <= $maximum_length);
}
/*渡された文字列が英数字かどうか*/
/*@param str $string チェックしたい文字列*/
/*@return boolean*/
function is_alphanumeric($string){
  return is_valid_format($string, REGEXP_ALPHANUMERIC);
}
/*渡された文字列が正の整数かどうか*/
/*@param str $string チェックしたい文字列*/
/*@return boolean*/
function is_positive_integer($string){
  return is_valid_format($string, REGEXP_POSITIVE_INTEGER);
}
/*渡された文字列が正規表現と一致しているかどうか*/
/*@param str $string チェックしたい文字列*/
/*@param str $format 正規表現*/
/*@return boolean*/
function is_valid_format($string, $format){
  return preg_match($format, $string) === 1;
}

/*アップロードされる画像のエラーチェック*/
function is_valid_upload_image($image){
  if(is_uploaded_file($image['tmp_name']) === false){
    set_error('ファイル形式が不正です。');
    return false;
  }
  $mimetype = exif_imagetype($image['tmp_name']);
  if( isset(PERMITTED_IMAGE_TYPES[$mimetype]) === false ){
    set_error('ファイル形式は' . implode('、', PERMITTED_IMAGE_TYPES) . 'のみ利用可能です。');
    return false;
  }
  return true;
}
/*HTMLエスケープ処理を施す*/
/*@param str $String エスケープ処理を施す文字列*/
/*@return str エスケープ処理を施した文字列*/
function h($String){
  return htmlspecialchars($String,ENT_QUOTES,'UTF-8');
}