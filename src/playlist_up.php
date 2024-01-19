<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/playlist_up.css">
    <title>Update</title>
</head>
<body>
    <table>
        <tr><th>List Name</th></tr>
        <?php
        require 'db-connect.php';
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo->prepare('select * from LIST where list=?');
        $sql->execute([$_POST['list']]);
        foreach ($sql as $row) {
            echo '<form action="playlist_up2.php" method="post">';
            echo '<td>';
            echo '<input type="text" name="listname" value="', $row['listname'], '">';
            echo '</td>';
            echo '<td><input type="hidden" name="list" value="', $row['list'], '"></td>';
            echo '<td><input type="submit" value="Update"></td>';
            echo '</form>';
        }
        ?>
    </table>
    <button onclick="location.href='index.php'" class="btn">Back to Top</button>
</body>
</html>
