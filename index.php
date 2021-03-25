
<?php
//1.  DB接続します xxxにDB名を入れます
try {
// mampは''にrootいる
$pdo = new PDO('mysql:dbname=php_db_sql;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
//作ったテーブル名を書く場所  xxxにテーブル名を入れます
$stmt = $pdo->prepare("SELECT * FROM kadai_table");
$status = $stmt->execute();

//３．データ表示
$view="";

if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる $resultの中に「カラム名」が入ってくるのでそれを表示させる例
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<p>";
    
    // $view .= $result["id"].":".$result["email"].":".$result["indate"].":".$result["name"];
    $view .= '<a href="u_view.php?id='.$result["id"].'">';
    $view .= $result["indate"]." : 学習内容　".$result["sub"];
    $view .= "</a>";
    $view .= '　';
    $view .= '<a href="delet.php?id='.$result["id"].'">';
    $view .= '[削除] ';
    $view .= "</a>";
    $view .= "</p>";
  }

}
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>学習記録登録ページ</title>
  <link rel='stylesheet' href='css/reset.css'>
  <link href="css/style.css?v=2" rel="stylesheet">
  <!-- <style>div{padding: 10px;font-size:16px;}</style> -->
</head>
<body>

<!-- Head[Start] -->


<header class="header">
 <h1>学習記録</h1>
</header>
<!-- Head[End] -->

<div id="main-container">

  <form method="post" action="insert.php">
    <div class="nyuryoku">
      <fieldset>
        <legend>学習記録をつける</legend>
        <label>学習科目：<input type="text" name="sub"></label><br>
        <label>学習教材：<input type="text" name="text"></label><br>
        <label>明日の目標<br><textArea name="em" rows="4" cols="40"></textArea></label><br>
        
        <input type="submit" value="記入する">
        
        
        
      </fieldset>
    </div>
  </div>
    
    
  </form>
  <!-- Main[End] -->
<div class="container">
  <div class="kiroku"><h2>これまでの学習記録</h2><?=$view?></div>
</div>

</body>
</html>
