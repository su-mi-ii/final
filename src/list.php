<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/list.css">
    <title>List</title>
</head>
<body>
<?php
require 'db-connect.php';
$pdo = new PDO($connect, USER, PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['listname'])) {
    $selectedListname = $_POST['listname'];

    $stmt = $pdo->prepare("SELECT music, artist FROM music WHERE list = (SELECT list FROM LIST WHERE listname = :listname)");
    $stmt->bindParam(':listname', $selectedListname, PDO::PARAM_STR);
    $stmt->execute();
    $musicData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($musicData)) {
        echo "<h2>Music List for {$selectedListname}</h2>";
        echo "<ul>";
        foreach ($musicData as $row) {
            echo "<li>{$row['music']} by {$row['artist']}</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No music found for {$selectedListname}</p>";
    }
}

else {
    $stmt = $pdo->prepare("SELECT listname FROM LIST");
    $stmt->execute();
    $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<form action='list2.php' method='post'>";
    echo "<label for='listname'>Select List:</label>";
    echo "<select name='listname' id='listname'>";
    foreach ($lists as $list) {
        echo "<option value='{$list['listname']}'>{$list['listname']}</option>";
    }
    echo "</select>";
    echo "<button type='submit'>Show Music</button>";
    echo "</form>";
}
?>
</body>
</html>