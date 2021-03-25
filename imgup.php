<?php


$file = $_FILES['img'];
$filename = $file['name'];
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];

$caption = filter_input(INPUT_POST,'caption',FILTER_SANITIZE_FULL_SPECIAL_CHARS);

if(empty($caption)){
 echo '140文字以内で入力してください。';
}
if(strlen($caption)> 140){
  echo 'キャプションは140文字以内で入力してください。';
}
if($filesize > 1048576 || $file_err== 2){
  echo 'ファイルサイズは1MB未満にしてください。';
}

$allow_ext = array('jpg', 'jpeg', 'png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if(in_array(strtolower($fole_ext),$allow_ext)){
  echo '画像ファイルを添付してください。';
}

if(is_uploaded_file($tmp_path)){
  echo $filename. 'をアップしました。';
}else{
  echo 'ファイルが選択されていません。';
}

// var_dump($file);

?>
<!-- ①フォームの説明 -->
<!-- ②$_FILEの確認 -->
<!-- ③バリデーション -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>アップロードフォーム</title>
  </head>
  <style>
    body {
      padding: 30px;
      margin: 0 auto;
      width: 50%;
    }
    textarea {
      width: 98%;
      height: 60px;
    }
    .file-up {
      margin-bottom: 10px;
    }
    .submit {
      text-align: right;
    }
    .btn {
      display: inline-block;
      border-radius: 3px;
      font-size: 18px;
      background: #67c5ff;
      border: 2px solid #67c5ff;
      padding: 5px 10px;
      color: #fff;
      cursor: pointer;
    }
  </style>
  <body>
    <form enctype="multipart/form-data" action="imgup.php" method="POST">
      <div class="file-up">
        <input type="hidden" name="MAX_FILE_SIZE" value="1048676" />
        <input name="img" type="file" accept="image/*" />
      </div>
      <div>
        <textarea
          name="caption"
          placeholder="キャプション（140文字以下）"
          id="caption"
        ></textarea>
      </div>
      <div class="submit">
        <input type="submit" value="送信" class="btn" />
      </div>
    </form>
  </body>
</html>
