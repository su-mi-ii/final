<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/list.css">
    <title>Update</title>
</head>

<body>
<?php

require 'db-connect.php';
$pdo = new PDO($connect, USER, PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['listname'])) {
    try {
        $selectedListname = $_POST['listname'];

        $stmt = $pdo->prepare("SELECT music, artist FROM music WHERE list = (SELECT list FROM LIST WHERE listname = :listname)");
        $stmt->bindParam(':listname', $selectedListname, PDO::PARAM_STR);
        $stmt->execute();
        $musicData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($musicData)) {
            echo "<h2>Music List for " . htmlspecialchars($selectedListname, ENT_QUOTES, 'UTF-8') . "</h2>";
            echo "<ul>";
            foreach ($musicData as $row) {
                echo "<li>" . htmlspecialchars($row['music'], ENT_QUOTES, 'UTF-8') . " by " . htmlspecialchars($row['artist'], ENT_QUOTES, 'UTF-8') . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>No music found for " . htmlspecialchars($selectedListname, ENT_QUOTES, 'UTF-8') . "</p>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

else {
    try {
        $stmt = $pdo->prepare("SELECT * FROM LIST");
        $stmt->execute();
        $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<form action='update2.php' method='post'>";
        echo "<label for='listname'>Select List:</label>";
        echo "<select name='listname' id='listname'>";
        foreach ($lists as $list) {
            echo "<option value='{$list['list']}'>{$list['listname']}</option>";
        }
        echo "</select>";
        echo "<button type='submit'>Show Music</button>";
        echo "</form>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

