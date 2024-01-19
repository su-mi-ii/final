<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/update3.css">
    <title>Update Music Information</title>
</head>
<body>
<?php
require 'db-connect.php';
$pdo = new PDO($connect, USER, PASS);

$sql = $pdo->prepare('UPDATE music SET music=?, artist=? WHERE id=?');
if (empty($_POST['music'])) {
    echo '音楽を入力してください。';
} else if (empty($_POST['artist'])) {
    echo 'アーティストを入力してください';
} else {
        $id = $_POST['id'];  
        if ($sql->execute([htmlspecialchars($_POST['music'], ENT_QUOTES, 'UTF-8'), $_POST['artist'], $id])) {
            echo '更新に成功しました';
        } else {
            echo '更新に失敗しました';
        }
}

?>
 <form action="index.php" method="post">
            <button type="submit" class="btn">追加画面へ戻る</button>
        </form>
        </body>
</html>


