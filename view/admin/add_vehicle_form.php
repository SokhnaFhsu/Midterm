<?php
require __DIR__ . '/../../model/database.php';

// Fetch makes
$makes = $db->query("SELECT * FROM makes")->fetchAll(PDO::FETCH_ASSOC);


$types = $db->query("SELECT * FROM types")->fetchAll(PDO::FETCH_ASSOC);


$classes = $db->query("SELECT * FROM classes")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $year = $_POST['year'];
    $make_id = $_POST['make_id'];
    $model = $_POST['model'];
    $price = $_POST['price'];
    $type_id = $_POST['type_id'];
    $class_id = $_POST['class_id'];

    
    $stmt = $db->prepare("INSERT INTO vehicles (year, make_id, model, price, type_id, class_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$year, $make_id, $model, $price, $type_id, $class_id]);
    
    
    echo "Vehicle added successfully!";
    
}
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

    <div class="form-container">
    <h2>Add New Vehicle</h2>

    <form action="add_vehicle_form.php" method="post">
        
        Make: <select name="make_id">
            <?php foreach ($makes as $make): ?>
                <option value="<?= $make['make_id'] ?>"><?= htmlspecialchars($make['make_name']) ?></option>
            <?php endforeach; ?>
            </select><br>
            Type: <select name="type_id">
            <?php foreach ($types as $type): ?>
                <option value="<?= $type['type_id'] ?>"><?= htmlspecialchars($type['type_name']) ?></option>
            <?php endforeach; ?>
        </select><br>
        Class: <select name="class_id">
            <?php foreach ($classes as $class): ?>
                <option value="<?= $class['class_id'] ?>"><?= htmlspecialchars($class['class_name']) ?></option>
            <?php endforeach; ?>
        </select><br>
        Year: <input type="text" name="year"><br>
        Model: <input type="text" name="model"><br>
        Price: <input type="text" name="price"><br>
        
        
        <input type="submit" value="Add Vehicle">
    </form>
</body>
</html>
