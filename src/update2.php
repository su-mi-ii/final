<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/update2.css">
    <title>Update Music Information</title>
</head>
<body>

<div class="table-container">
    <div class="th th0">Music</div>
    <div class="th th1">Artist</div>

    <?php
    require 'db-connect.php';
    $pdo = new PDO($connect, USER, PASS);
    $sql = $pdo->prepare('SELECT * FROM music where list = ?');
    $sql->execute([$_POST['listname']]);
    foreach ($sql as $row) {
        echo '<form action="update3.php" method="post" class="table-row">';
        echo '<input type="hidden" name="id" value="' . htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8') . '">';
        echo '<div class="td td1">';
        echo '<input type="text" name="music" value="' . htmlspecialchars($row['music'], ENT_QUOTES, 'UTF-8') . '">';
        echo '</div> ';
        echo '<div class="td td1">';
        echo '<input type="text" name="artist" value="' . htmlspecialchars($row['artist'], ENT_QUOTES, 'UTF-8') . '">';
        echo '</div>';
        echo '<div class="td td2"><input type="submit" value="Update"></div>';
        echo '</form>';
    }
    ?>
</div>

</body>
</html>
