<?php
require __DIR__ . '/../../model/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset($_POST['make_name'])) {
    $make_name = $_POST['make_name'];
    $stmt = $db->prepare("INSERT INTO makes (make_name) VALUES (?)");
    $stmt->execute([$make_name]);
} elseif (isset($_POST['delete_makes_id'])) {
    $delete_type_id = $_POST['delete_makes_id'];
    $stmt = $db->prepare("DELETE FROM makes WHERE make_id = ?");
    $stmt->execute([$delete_type_id]);
}
header("Location: edit_makes.php");
}

$makes = $db->query("SELECT * FROM makes")->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="http://localhost/MIDTERM/css/styles.css">
    <title>Document</title>
</head>
<body>

<div id="edit-makes-page">

    <h2>Edit Vehicle Makes</h2>
    <form action="edit_makes.php" method="post">
        Make Name: <input type="text" name="make_name">
        <input type="submit" value="Add Make">
    </form>
    <div class="makes-list">
        <?php foreach ($makes as $make): ?>
            <div class="make-item">
                <span><?php echo $make['make_name']; ?></span>
                <form action="edit_makes.php" method="post">
                    <button type="submit" name="delete_make_id" value="<?php echo $make['make_id']; ?>">Delete</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    
   
</body>
</html>

