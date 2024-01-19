<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="css/playlist.css">
    <title>Playlist</title>  
</head>
<body>
    <h1>Playlist List Screen</h1>
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title>Playlist Edit Screen</title>
        </head>
        <body>

        <br><br><br>
        <table>
            <tr><th>List Name</th></tr>
        <?php
            require 'db-connect.php';
            $pdo = new PDO($connect, USER, PASS);
            foreach ($pdo->query('select * from LIST') as $row) {
                echo '<tr>';
                echo '<td>', $row['listname'], '</td>';
                echo '</td>';
                echo '<td>';
                echo '<form action="playlist_up.php" method="post">';
                echo '<input type="hidden" name="list" value="', $row['list'], '">';
                echo '<button type="submit">Edit</button>';
                echo '</form>';
                echo '</td>';
                echo '<td>';
                echo '<form action="playlist_de.php" method="post">';
                echo '<input type="hidden" name="list" value="', $row['list'], '">';
                echo '<button type="submit">Delete</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
                echo "\n";
            } 
        ?>
        </table>
        <form action="playlist_re.php" method="post">
            <button type="submit">Add</button>
        </form>
        <form action="index.php" method="post">
            <button type="submit">Back to Top</button>
        </form>
        </body>
    </html>
</body>
</html>
