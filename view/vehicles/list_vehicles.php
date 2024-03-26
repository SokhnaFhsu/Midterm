
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
            <th></th> 
        </tr>
    </thead>
    <tbody>
        <?php foreach ($vehicles as $vehicle) : ?>
            <tr>
                <td><?= htmlspecialchars($vehicle['year']); ?></td>
                <td><?= htmlspecialchars($vehicle['make_name']); ?></td>
                <td><?= htmlspecialchars($vehicle['model']); ?></td>
                <td><?= htmlspecialchars($vehicle['type_name']); ?></td>
                <td><?= htmlspecialchars($vehicle['class_name']); ?></td>
                <td>$<?= htmlspecialchars(number_format($vehicle['price'], 2)); ?></td>
                <td>
                    <form action="index.php" method="post">
                    <input type="hidden" name="action" value="delete_vehicle">
    <input type="hidden" name="vehicle_id" value="<?php echo htmlspecialchars($vehicle['vehicle_id']); ?>">
    <input type="submit" value="Remove">
</form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<div>
    <a href="../view/admin/add_vehicle_form.php">Click here to add a vehicle.</a><br>
    <a href="../view/admin/edit_makes.php">View/Edit Vehicle Makes</a><br>
    <a href="../view/admin/edit_types.php">View/Edit Vehicle Types</a><br>
    <a href="../view/admin/edit_classes.php">View/Edit Vehicle Classes</a><br>
</div>

<?php include('../view/footer.php'); ?>

</form>
</body>
</html>