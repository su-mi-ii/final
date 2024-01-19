<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/playlist_up2.css">
    <title>Update</title>
</head>
<body>
<?php
require 'db-connect.php';

    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (empty($_POST['listname']) || empty($_POST['list'])) {
        echo 'Please enter a list name';
    } else {
        $sql = $pdo->prepare('UPDATE LIST SET listname=? WHERE list=?');
        $result = $sql->execute([$_POST['listname'], $_POST['list']]);
        
        if ($result) {
            echo 'Update successful';
        } else {
            echo 'Update failed';
        }
    }

?>
<hr>
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
<button onclick="location.href='index.php'" class="btn">Back to Top</button>
</body>
</html>
