<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/register.css">
    <title>Product Registration</title>
</head>
<body>
    <h1>Product Registration</h1>
    <p>Add a new music to the database</p>
    <form action="register2.php" method="post">
        Music Name: <input type="text" name="music"><br>
        Artist Name: <input type="text" name="artist"><br>
        Playlist Name:
        <select name="list">
            <?php
                require 'db-connect.php';
                $new_mysqli = new mysqli(SERVER, USER, PASS, DBNAME);

                if ($new_mysqli->connect_error) {
                    die("Connection failed: " . $new_mysqli->connect_error);
                }

                $sql = 'SELECT * FROM LIST';

                if ($Playlist_data = $new_mysqli->query($sql)) {
                    foreach ($Playlist_data as $Playlist_data_val) {
                        echo "<option value='" . $Playlist_data_val['list'] . "'>" . $Playlist_data_val['listname'] . "</option>";
                    }
                }

                $new_mysqli->close();
            ?>
        </select>

        <button type="submit">Add</button>
    </form>
</body>
</html>
