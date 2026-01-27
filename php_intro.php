<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP基本出力</title>
</head>
<body>
    <h1>PHPの基本的な出力</h1>
    
    <h2>printを使った出力</h2>
    <?php
    print "<p>これはprintで出力されたテキストです。</p>";
    ?>
    
    <h2>echoを使った出力</h2>
    <?php
    echo "<p>これはechoで出力されたテキストです。</p>";
    echo "<p>echoは複数の引数を取ることができます。</p>";
    ?>
    
    <h2>変数の出力</h2>
    <?php
    $name = "Tomoya";
    $age = 20;
    echo "<p>名前: " . $name . "</p>";
    echo "<p>年齢: " . $age . "</p>";
    ?>
    
    <h2>日付の出力</h2>
    <?php
    echo "<p>現在の日時: " . date("Y-m-d H:i:s") . "</p>";
    ?>
</body>
</html>
