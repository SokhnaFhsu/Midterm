<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once('../model/database.php'); 
require_once('../model/vehicles_db.php');


$make_id = filter_input(INPUT_GET, 'make', FILTER_SANITIZE_STRING);
$type_id = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_STRING);
$class_id = filter_input(INPUT_GET, 'class', FILTER_SANITIZE_STRING);
$sort = filter_input(INPUT_GET, 'sort', FILTER_SANITIZE_STRING) ?: 'price';
$vehicles = get_vehicles_sorted($sort, $make_id, $type_id, $class_id);


$vehicles = get_vehicles(); 
      include('../view/vehicles/list_vehicles.php');


$sort_option = isset($_GET['sort']) ? $_GET['sort'] : 'default';
$order_by = 'price DESC'; // Default sorting
          if ($sort_option == 'year') {
    $order_by = 'year DESC';
          } elseif ($sort_option == 'price') {
    $order_by = 'price DESC';
}

$query = "SELECT * FROM vehicles ORDER BY $order_by";
$vehicles = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
$stmt = $db->prepare($query);
$stmt->execute();
$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'delete_vehicle') {
    $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_SANITIZE_NUMBER_INT);
    error_log("Attempting to delete vehicle ID: " . $vehicle_id); 

    if ($vehicle_id) {
        delete_vehicle($vehicle_id); 
        header('Location: index.php'); 
        exit();
    } else {
        
    }
}

if (isset($_POST['sort'])) {
    $sort = $_POST['sort'];
    if ($sort == 'price') {
        $vehicles = get_vehicles_by_price();
    } elseif ($sort == 'year') {
        $vehicles = get_vehicles_by_year();
    }
} else {
    // Default view
    $vehicles = get_vehicles_by_price();
}


if (isset($_POST['delete_vehicle_id'])) {
    $vehicle_id = $_POST['delete_vehicle_id'];
    delete_vehicle($vehicle_id);
    
    header("Location: .");
    exit;
}



?>

<link rel="stylesheet" href="../css/styles.css">
