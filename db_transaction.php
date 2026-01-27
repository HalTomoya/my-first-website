<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>データベーストランザクション処理</title>
</head>
<body>
    <h1>データベーストランザクション処理（INSERT/UPDATE/DELETE）</h1>
    
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
        
        // トランザクション開始
        $pdo->beginTransaction();
        
        try {
            // INSERT例
            echo "<h2>INSERTの例</h2>";
            $sql = "INSERT INTO users (name, email, created_at) VALUES (:name, :email, :created_at)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => '山田太郎',
                ':email' => 'yamada@example.com',
                ':created_at' => date('Y-m-d H:i:s')
            ]);
            echo "<p>データを追加しました。（影響を受けた行数: " . $stmt->rowCount() . "）</p>";
            
            // 挿入されたIDを取得
            $lastInsertId = $pdo->lastInsertId();
            echo "<p>追加されたID: " . $lastInsertId . "</p>";
            
            // UPDATE例
            echo "<h2>UPDATEの例</h2>";
            $sql = "UPDATE users SET name = :name WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => '山田花子',
                ':id' => $lastInsertId
            ]);
            echo "<p>データを更新しました。（影響を受けた行数: " . $stmt->rowCount() . "）</p>";
            
            // DELETE例
            echo "<h2>DELETEの例</h2>";
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':id' => $lastInsertId
            ]);
            echo "<p>データを削除しました。（影響を受けた行数: " . $stmt->rowCount() . "）</p>";
            
            // トランザクションをコミット
            $pdo->commit();
            echo "<p><strong>トランザクションをコミットしました。</strong></p>";
            
        } catch (Exception $e) {
            // エラーが発生した場合はロールバック
            $pdo->rollBack();
            echo "<p>エラーが発生したため、ロールバックしました: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
        
    } catch (PDOException $e) {
        echo "<p>データベース接続エラー: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
    
    // 接続を閉じる
    $pdo = null;
    ?>
    
    <hr>
    <h2>プリペアドステートメントの利点</h2>
    <ul>
        <li>SQLインジェクション攻撃を防ぐ</li>
        <li>同じクエリを複数回実行する際のパフォーマンス向上</li>
        <li>コードの可読性と保守性の向上</li>
    </ul>
    
</body>
</html>
