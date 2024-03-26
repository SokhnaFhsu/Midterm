<?php
require __DIR__ . '/../../model/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['type_name'])) {
        $type_name = $_POST['type_name'];
        $stmt = $db->prepare("INSERT INTO types (type_name) VALUES (?)");
        $stmt->execute([$type_name]);
    } elseif (isset($_POST['delete_type_id'])) {
        $delete_type_id = $_POST['delete_type_id'];
        $stmt = $db->prepare("DELETE FROM types WHERE type_id = ?");
        $stmt->execute([$delete_type_id]);
    }
    header("Location: edit_types.php");
}
$types = $db->query("SELECT * FROM types")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="http://localhost/MIDTERM/css/styles.css">
    <title>Document</title>
</head>
<body >
<div id="edit-makes-page">
    <h2>Edit Vehicle Types</h2>
    <form action="edit_types.php" method="post">
        Type Name: <input type="text" name="type_name">
        <input type="submit" value="Add Type">
    </form>
    <div class="makes-list">
    <?php foreach ($types as $type): ?>
        <form action="edit_types.php" method="post">
            <?php echo htmlspecialchars($type['type_name']); ?>
            <button type="submit" name="delete_type_id" value="<?php echo $type['type_id']; ?>">Delete</button>
        </form>
    <?php endforeach; ?>
</body>
</html>
