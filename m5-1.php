<DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mission5-1</title>
    </head>
    <body>
        <b>掲示板</b>
        
<?php 
         
// DB接続設定
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
//存在していない場合、テーブル5を作成
    $sql = "CREATE TABLE IF NOT EXISTS tb5"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name TEXT,"//名前
    . "comment TEXT,"//コメント
    . "date DATETIME,"//日時
    . "pass TEXT"//パスワード
    .");";
//$sqlに格納したSQL文が実行される
    $stmt = $pdo->query($sql);
    
    
  
           
//条件分岐開始
//入力フォームに値があり隠しテキストボックスが空のとき＝新規投稿を実行
if(!empty($_POST["name"])&&!empty($_POST["str"])&&$_POST["pass"]=="password"&&empty($_POST["hidden"]))
{
        
        $sql = $pdo -> prepare("INSERT INTO tb5 (name, comment, date, pass) VALUES (:name, :comment, now(), :pass)");
        $sql -> bindParam(':name', $name, PDO::PARAM_STR);
        $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
        $sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
    

        $name=$_POST["name"];//氏名
        $comment=$_POST["str"];//コメント内容
        $date=date("Y/m/d H:i:s");//日時  
        $pass=$_POST["pass"];//パスワード
      
        $sql -> execute();}
       
 //編集番号と正しいパスワードが入力されたときに、フォームに名前とコメントを戻す。
            if(!empty($_POST["enum"])&&$_POST["epass"]=="password")
            {
             $enum=$_POST["enum"];
             
             $sql = "SELECT * FROM tb5 WHERE id=$enum";
             $stmt = $pdo->query($sql);
             $result=$stmt->fetchAll();
             foreach ($result as $row){
             
            
            $ename=$row["name"];
            $estr=$row["comment"];
              
            }}
             ?>
         
        
        <form action=""method="post">
            
            <input type="text"name="name"placeholder="氏名"
            value="<?php if(!empty($_POST["enum"])){echo "$ename";}?>"><br>
            
            <input type="text"name="str"placeholder="コメント"
            value="<?php if (!empty($_POST["enum"])){echo "$estr";}?>"><br>
            
            <input type="text"name="pass"placeholder="パスワード"
            value=""><br>
            
             <input type="hidden"name="hidden"
            value="<?php if (!empty($_POST["enum"])){echo ($_POST["enum"]);}?>"><br><!--編集番号を反映する隠しテキストボックス-->
           
           
            <input type="submit"name="submit">
        </form> <!--送信フォーム設置完了-->
        
         <form action=""method="post">
            <input type="number"name="dnum"placeholder="削除対象番号"><br>
             <input type="text"name="dpass"placeholder="パスワード"
            value=""><br>
            <input type="submit"name="delete"value="削除">
        </form> <!--削除フォーム設置完了-->
        
         <form action=""method="post">
            <input type="number"name="enum"placeholder="編集対象番号"><br>
             <input type="text"name="epass"placeholder="パスワード"
            value=""><br>
            <input type="submit"name="edit"value="編集">
        </form> <!--編集フォーム設置完了-->
            
      
<?php        
//隠しボックスに数字があるとき、編集を実行
if(!empty($_POST["name"])&&!empty($_POST["str"])&&$_POST["pass"]=="password"&&!empty($_POST["hidden"]))
        {
       
        $hidden=$_POST["hidden"];
        $pass=$_POST["pass"];
        
               $id = $hidden; //変更する投稿番号
               $name =$_POST["name"];//編集後の名前
               $comment = $_POST["str"]; //編集後のコメント
               $date=date("Y/m/d H:i:s");
               $sql = 'UPDATE tb5 SET name=:name,comment=:comment,date=:date, pass=:pass WHERE id=:id';
               $stmt = $pdo->prepare($sql);
               $stmt->bindParam(':name', $name, PDO::PARAM_STR);
               $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
               $stmt->bindParam(':pass', $comment, PDO::PARAM_STR);
               $stmt->bindParam(':date', $date, PDO::PARAM_STR);
               $stmt->bindParam(':id', $id, PDO::PARAM_INT);
               $stmt->execute();
        }
 

    
  
//削除フォームに値がある場合削除を実行 DELETE文でいけるか
if(!empty($_POST["dnum"])&&$_POST["dpass"]=="password")
{
    //テキストファイルを変数として定義　
    $dnum=$_POST["dnum"];//削除番号の定義
      
    //dnumと一致するデータを削除
    $id = $dnum;
    $sql = 'delete from tb5 where id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
   
}



//すべての処理の後、テーブルの中身をブラウザに表示
//テーブルを選択
    $sql = 'SELECT * FROM tb5';
    $stmt = $pdo->query($sql);
    $results = $stmt->fetchAll();//すべて取ってくるという意味
    foreach ($results as $row){
        //$rowの中にはテーブルのカラム名が入る
        echo $row['id'].',';
        echo $row['name'].',';
        echo $row['comment'].',';
        echo $row['date'].'<br>';
        echo "<hr>";
    }

?>
</body>
</html>
