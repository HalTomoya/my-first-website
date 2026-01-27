<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データベース接続とSELECT</title>
</head>
<body>
    <h1>データベース接続とデータ取得</h1>
    
    <?php
    // データベース接続情報
    $host = '130.33.16.125';
    $dbname = 'CB41db';
    $username = 'dbhalhal';
    $password = 'orihayamah';
    
    try {
        // データベースに接続
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        
        // エラーモードを例外に設定
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        echo "<p>データベースに接続しました。</p>";
        
        // SELECTクエリの実行例
        $sql = "SELECT * FROM users LIMIT 10";
        $stmt = $pdo->query($sql);
        
        echo "<h2>取得したデータ</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>名前</th><th>メールアドレス</th></tr>";
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['id'] ?? '') . "</td>";
            echo "<td>" . htmlspecialchars($row['name'] ?? '') . "</td>";
            echo "<td>" . htmlspecialchars($row['email'] ?? '') . "</td>";
            echo "</tr>";
        }
        
        echo "</table>";
        
    } catch (PDOException $e) {
        echo "<p>エラー: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
    
    // 接続を閉じる
    $pdo = null;
    ?>
    
</body>
</html>
