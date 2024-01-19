<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/delete2.css">

    <title>Delete</title>
</head>
<body>
    <table>
        <?php
        require 'db-connect.php';
        $pdo = new PDO($connect, USER, PASS);
        $sql = $pdo->prepare('SELECT * FROM music where list = ?');
        $sql->execute([$_POST['listname']]);
        
        echo "<h2>Music List for {$_POST['listname']}</h2>"; 
        
        if ($sql->rowCount() > 0) {
            echo "<ul>";
            
            foreach ($sql as $row) {
                echo "<li>{$row['music']} by {$row['artist']} <a href=\"delete3?id={$row['id']}\">削除</a></li>";
            }

            echo "</ul>";
        } else {
            echo "<p>No music found for {$_POST['listname']}</p>";
        }
        ?>
    </table>
</body>
</html>
