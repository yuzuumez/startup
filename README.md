# startup
成果物
TECH-BASEインターン2022年度7期で作成した成果物です。
m5-1.php

// DB接続設定
    $dsn = 'データベース名';
    $user = 'ユーザ名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    


の部分に実際のデータベース名、ユーザ名、パスワードを入力すると動作します。

