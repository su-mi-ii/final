<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/list2.css">

    <title>List</title>
    <script>
        function toggleSortOrder() {
            var sortOrderInput = document.getElementById('sortOrder');
            sortOrderInput.value = sortOrderInput.value === 'alphabetical' ? 'addition' : 'alphabetical';
            document.getElementById('listForm').submit();
        }
    </script>
</head>
<body>
<?php
require 'db-connect.php';
$pdo = new PDO($connect, USER, PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function displayMusicList($musicData) {
    if (!empty($musicData)) {
        echo "<ul>";
        foreach ($musicData as $row) {
            echo "<li>{$row['music']} by {$row['artist']}</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>No music found</p>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['listname'])) {
    $selectedListname = $_POST['listname'];
    $sortOrder = isset($_POST['sortOrder']) ? $_POST['sortOrder'] : 'alphabetical';

    $orderColumn = $sortOrder === 'alphabetical' ? 'music' : 'id';
    
    $stmt = $pdo->prepare("SELECT music, artist FROM music WHERE list = (SELECT list FROM LIST WHERE listname = :listname) ORDER BY $orderColumn");
    $stmt->bindParam(':listname', $selectedListname, PDO::PARAM_STR);
    $stmt->execute();
    $musicData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Music List for {$selectedListname} ($sortOrder Order)</h2>";
    displayMusicList($musicData);

    echo "<form id='listForm' action='list2.php' method='post'>";
    echo "<input type='hidden' name='sortOrder' id='sortOrder' value='$sortOrder'>";
    echo "<label for='listname'>Select List:</label>";
    echo "<select name='listname' id='listname'>";
    
    $stmt = $pdo->prepare("SELECT listname FROM LIST");
    $stmt->execute();
    $lists = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($lists as $list) {
        $selected = $list['listname'] === $selectedListname ? 'selected' : '';
        echo "<option value='{$list['listname']}' $selected>{$list['listname']}</option>";
    }
    
    echo "</select>";
    echo "<button type='submit'>Show Music</button>";
    echo "</form>";

    echo "<button onclick='toggleSortOrder()'>Toggle Sort Order</button>";
}

else {
    echo "Select a playlist to display music.";
}
?>
<form action="index.php" method="post">
    <button type="submit">Back to TOP</button>
</form>
</body>
</html>
