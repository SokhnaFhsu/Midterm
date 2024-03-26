<?php
require('../model/database.php'); 
require('../model/vehicles_db.php');

$make_id = filter_input(INPUT_GET, 'make', FILTER_SANITIZE_STRING);
$type_id = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
$class_id = filter_input(INPUT_GET, 'class', FILTER_SANITIZE_STRING);
$sort = filter_input(INPUT_GET, 'sort', FILTER_SANITIZE_STRING) ?: 'price';

$vehicles = get_vehicles_sorted($sort, $make_id, $type_id, $class_id);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">

    <title>Document</title>
</head>
<body>

<?php include('../view/header.php'); ?>

<form action="index.php" method="get">
    <label for="makes">Make:</label>
    <select name="make" id="makes" onchange="this.form.submit()">
        <option value="all">All Makes</option>
        <option value="1">Chevy</option>
        <option value="2">Ford</option>
        <option value="3">Cadillac</option>
        <option value="4">Nissan</option>
        <option value="5">Hyundai</option>
        <option value="6">Dodge</option>
        <option value="7">Infiniti</option>
        <option value="8">Buick</option>
    </select>
</form>

    <form action="index.php" method="get">
    <label for="types">Type:</label>
    <select name="type" id="types" onchange="this.form.submit()">
        <option value="all">All Types</option>
        <option value="1">SUV</option>
        <option value="2">Truck</option>
        <option value="3">Sedan</option>
        <option value="4">Coupe</option>
    </select>
</form>

<form action="index.php" method="get">
    <label for="classes">Class:</label>
    <select name="class" id="classes" onchange="this.form.submit()">
        <option value="all">All Classes</option>
        <option value="1">Utility</option>
        <option value="2">Economy</option>
        <option value="3">Luxury</option>
        <option value="4">Sports</option>
    </select>
</form>


<form action="index.php" method="get"> 
    Sort by:
    <input type="radio" name="sort" value="price" checked> Price
    <input type="radio" name="sort" value="year"> Year
    <input type="submit" value="Submit">
</form>

 <table>
        <thead>
            <tr>
                <th>Year</th>
                <th>Make</th>
                <th>Model</th>
                <th>Type</th>
                <th>Class</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vehicles as $vehicle) : ?>
                <tr>
                    <td><?= htmlspecialchars($vehicle['year']); ?></td>
                    <td><?= htmlspecialchars($vehicle['make']); ?></td> <!-- Ensure these match your DB column names -->
                    <td><?= htmlspecialchars($vehicle['model']); ?></td>
                    <td><?= htmlspecialchars($vehicle['type']); ?></td> <!-- Adjust if needed -->
                    <td><?= htmlspecialchars($vehicle['class']); ?></td> <!-- Adjust if needed -->
                    <td>$<?= htmlspecialchars(number_format($vehicle['price'], 2)); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php include('../view/footer.php'); ?>

</body>
</html>