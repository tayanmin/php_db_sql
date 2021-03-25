<?php
//1.GETでid値を取得
$id = $_GET["id"];
$sub = $_GET["sub"];
$em = $_GET["em"];
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
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="index.php">学習記録画面に戻る</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>学習記録</legend>
     <label>学習科目：<h3 name="sub" value="<?=$row["sub"]?>"></h3></label><br>
     <label>学習教材：<h name="text" value="<?=$row["text"]?>"></h></label><br>
     <label><p name="em" ><?=$row["em"]?></p></label><br>
     <input type="hidden" name="id" value="<?=$row["id"]?>">
     <input type="submit" value="更新する">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>


