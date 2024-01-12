<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title> kadai6-3-1</title>
    </head>
    <body>
    <table border='3'>
    <tr>
        <th>番号</th>
        <th>音楽名</th>
        <th>アーティスト名</th>
        <th>プレイリスト</th>
    </tr>
    <?php
    $pdo=new PDO('mysql:host=mysql219.phy.lolipop.lan;dbname=LAA1517468-final;charset=utf8','LAA1517468','pass1218');
    foreach ($pdo->query('select * from music') as $row){ 

        echo '<tr>';
        echo '<td>',$row['id'],'</td>';
        echo '<td>',$row['music'],'</td>';
        echo '<td>',$row['artist'],'</td>';
        echo '<td>',$row['list'],'</td>';
        echo '</tr>';
        echo "\n";
    }
    ?>
    </table>
    </body>
</html>