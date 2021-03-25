<?php
//1.GETでid値を取得
$id = $_GET["id"];
// echo $id;
// exit;


// 2.DB接続など
try {
  $pdo = new PDO('mysql:dbname=php_db_sql;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした'.$e->getMessage());
}


//3.SELECT * FROM gs_an_table WHERE id=:id;
$sql = "SELECT * FROM kadai_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();


//4.データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

} else {
  //１データのみ抽出の場合はwhileループで取り出さない
  $row = $stmt->fetch();

}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link rel='stylesheet' href='css/reset.css'>
  <link href="css/style.css?v=2" rel="stylesheet">
  <!-- <style>div{padding: 10px;font-size:16px;}</style> -->
</head>
<body>

<!-- Head[Start] -->
<header class="header">
<a class="navbar-brand" href="index.php">学習記録画面に戻る</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="update.php">
  <div id="main-container">
    <div class="nyuryoku">
   <fieldset>
    <legend>学習記録</legend>
     <label>学習科目：<input type="text" name="sub" value="<?=$row["sub"]?>"></label><br>
     <label>学習教材：<input type="text" name="text" value="<?=$row["text"]?>"></label><br>
     <label><textArea name="em" rows="4" cols="40"><?=$row["em"]?></textArea></label><br>
     <input type="hidden" name="id" value="<?=$row["id"]?>">
     <input type="submit" value="更新する">
    </fieldset>
    
  
    </div>
    </div>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>


