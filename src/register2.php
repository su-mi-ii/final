<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/register2.css">
    <title>Registration</title>
</head>

<body>
    <div>
        <h1>Registration Page</h1>
        <button onclick="location.href='index.php'" class="btn">Back to Top</button>

        <?php
        require 'db-connect.php';
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo->prepare('INSERT INTO music (music, artist, list) VALUES (?, ?, ?)');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['music'])) {
                echo 'Please enter the music name.';
            } else if (empty($_POST['artist'])) {
                echo 'Please enter the artist name.';
            } else if (empty($_POST['list'])) {
                echo 'Please select a playlist.';
            } else if ($sql->execute([$_POST['music'], $_POST['artist'], $_POST['list']])) {
                echo '<font color="red">Successfully added.</font>';
            } else {
                echo '<font color="red">Failed to add. Error: ' . implode(" ", $sql->errorInfo()) . '</font>';
            }
        }

        $sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'name';

        $list_query = 'SELECT list, listname FROM LIST';
        $list_query .= ' ORDER BY listname ASC';  // プレイリストの名前でソート

        ?>

        <br><hr><br>

        <button onclick="sortList('name')">Playlist Name (Alphabetical Order)</button>
        <button onclick="sortList('added')">Playlist Name (Order Added)</button>

        <table>
            <tr><th>Playlist</th><th>Music</th><th>Artist</th></tr>
            <?php
            foreach ($pdo->query($list_query) as $list_row) {
                echo '<tr>';
                echo '<td>', $list_row['listname'], '</td>';

                $music_query = $pdo->prepare('SELECT music, artist FROM music WHERE list = ? ORDER BY ' . ($sortOrder === 'added' ? 'id' : 'music') . ' ASC');
                $music_query->execute([$list_row['list']]);

                foreach ($music_query as $music_row) {
                    echo '<tr>';
                    echo '<td></td>';
                    echo '<td>', $music_row['music'], '</td>';
                    echo '<td>', $music_row['artist'], '</td>';
                    echo '</tr>';
                    echo "\n";
                }
            }
            ?>
        </table>

        <form action="register.php" method="post">
            <button type="submit" class="btn">Back to Add Screen</button>
        </form>
    </div>

    <script>
        function sortList(orderBy) {
            window.location.href = 'register2.php?sort=' + orderBy;
        }
    </script>
</body>

</html>
