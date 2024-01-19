<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/playlist_re2.css">
    <title>Add Playlist</title>
</head>
<body>
    <div>
        <h1>Add Playlist</h1>
        <button onclick="location.href='index.php'" class="btn">Back to Top</button>
        <?php
        require 'db-connect.php';
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo->prepare('insert into LIST(listname) values (?)');
        if (empty($_POST['listname'])) {
            echo 'Please enter a playlist name.';
        } else if ($sql->execute([htmlspecialchars($_POST['listname'])])) {
            echo '<font color="red">Addition successful.</font>';
        } else {
            echo '<font color="red">Addition failed.</font>';
        }
        ?>
        <br><hr><br>
        <table>
            <tr><th>List Name</th></tr>
            <?php
            $pdo = new PDO($connect, USER, PASS);
            foreach ($pdo->query('select * from LIST') as $row) {
                echo '<tr>';
                echo '<td>', $row['listname'], '</td>';
                echo '</tr>';
                echo "\n";
            }
            ?>
        </table>
        <form action="playlist.php" method="post">
            <button type="submit" class="btn">Back to Playlist Screen</button>
        </form>
    </div>
</body>
</html>
