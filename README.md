# startup

閲覧いただきありがとうございます。
m5-1.phpは、TECH-BASEインターン2022年度7期で作成したWEB掲示板です。
phpファイル内の

// DB接続設定
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
の部分に実際のデータベース名、ユーザ名、パスワードを入力すると動作します。

