<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/playlist_de.css">
    <title>Delete</title>
</head>
<body>
<?php
require 'db-connect.php';
$pdo = new PDO($connect, USER, PASS);

// 外部キー制約を無効にする
$pdo->exec('SET foreign_key_checks = 0');

$sql = $pdo->prepare('DELETE FROM LIST WHERE list = ?');

if ($sql->execute([$_POST['list']])) {
    echo 'Deletion successful.';
} else {
    echo 'Deletion failed.';
}

// 外部キー制約を有効に戻す
$pdo->exec('SET foreign_key_checks = 1');
?>
<br><hr><br>
<table>
    <tr><th>List Name</th></tr>
    <?php
    foreach ($pdo->query('SELECT * FROM LIST') as $row) {
        echo '<tr>';
        echo '<td>', $row['listname'], '</td>';
        echo '</tr>';
        echo "\n";
    }
    ?> 
</table>
<form action="index.php" method="post">
    <button type="submit">Back to TOP</button>
</form>
</body>
</html>
