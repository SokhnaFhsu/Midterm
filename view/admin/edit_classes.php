<?php
require __DIR__ . '/../../model/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['class_name'])) {
        $class_name = $_POST['class_name'];
        $stmt = $db->prepare("INSERT INTO classes (class_name) VALUES (?)");
        $stmt->execute([$class_name]);
    } elseif (isset($_POST['delete_class_id'])) {
        $delete_class_id = $_POST['delete_class_id'];
        $stmt = $db->prepare("DELETE FROM classes WHERE class_id = ?");
        $stmt->execute([$delete_class_id]);
    }
    header("Location: edit_classes.php");
}
$classes = $db->query("SELECT * FROM classes")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="http://localhost/MIDTERM/css/styles.css">
    <title>Document</title>

<body>
    
<div id="edit-makes-page">
    <h2>Edit Vehicle Classes</h2>
    <form action="edit_classes.php" method="post">
        Class Name: <input type="text" name="class_name">
        <input type="submit" value="Add Class">
    </form>
    <div class="makes-list">
    <?php foreach ($classes as $class): ?>
        <form action="edit_classes.php" method="post">
            <?php echo htmlspecialchars($class['class_name']); ?>
            <button type="submit" name="delete_class_id" value="<?php echo $class['class_id']; ?>">Delete</button>
        </form>
    <?php endforeach; ?>
</body>
</html>
