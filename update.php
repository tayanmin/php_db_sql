<?php
//1.POSTでid,name,email,naiyouを取得
$id     =$_POST["id"];
$sub = $_POST["sub"];
$text = $_POST["text"];
$em = $_POST["em"];

//2.DB接続
try {
  $pdo = new PDO('mysql:dbname=php_db_sql;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
$sql = 'UPDATE kadai_table SET sub=:sub,text=:text,em=:em WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':sub',$sub,  PDO::PARAM_STR);
$stmt->bindValue(':text',$text,  PDO::PARAM_STR);
$stmt->bindValue(':em',$em,  PDO::PARAM_STR);
$stmt->bindValue(':id',  $id, PDO::PARAM_INT);
$status = $stmt->execute();


if($status==false){

  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{

  header("Location: select.php");
  exit;

}



?>