<?php
//1. POSTデータ取得

if(
    !isset($_POST["sub"]) || $_POST["sub"]==""||
    !isset($_POST["text"]) || $_POST["text"]==""||
    !isset($_POST["em"]) || $_POST["em"]==""
    ){
    exit('ParamError');
}

//まず前のphpからデーターを受け取る（この受け取ったデータをもとにbindValueと結びつけるため）
$sub = $_POST["sub"];
$text = $_POST["text"];
$em = $_POST["em"];
// $level = $_POST["level"];

//2. DB接続します xxxにDB名を入力する
//ここから作成したDBに接続をしてデータを登録します xxxxに作成したデータベース名を書きます
// mamppの方は
// $pdo = new PDO('mysql:dbname=xxx;charset=utf8;host=localhost', 'root', 'root');

try {
    $pdo = new PDO('mysql:dbname=php_db_sql;charset=utf8;host=localhost', 'root', '');
} catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
}


$sql = "INSERT INTO kadai_table(id, sub, text, em, indate )VALUES(NULL,:sub,:text,:em,sysdate())";

//３．データ登録SQL作成 //ここにカラム名を入力する
//xxx_table(テーブル名)はテーブル名を入力します
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':sub', $sub, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':text', $text, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':em', $em, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if ($status==false) {
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
} else {
    //５．index.phpへリダイレクト 書くときにLocation: in この:　のあとは半角スペースがいるので注意！！
    header("Location: index.php");
    exit;
}
