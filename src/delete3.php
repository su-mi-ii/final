<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/delete3.css">
    <title>Delete</title>
</head>
<body>
<?php
require 'db-connect.php';
$pdo = new PDO($connect, USER, PASS);

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = $pdo->prepare('DELETE FROM music WHERE id = ?');
    if ($sql->execute([$id])) {
        echo 'Deletion successful.';
    } else {
        echo 'Deletion failed.';
    }
} else {
    echo 'Correct ID for deletion has not been provided.';
}
?>
<form action="index.php" method="post">
    <button type="submit">Back to Top</button>
</form>
</body>
</html>
