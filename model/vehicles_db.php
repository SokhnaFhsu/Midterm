<?php
require('database.php');


function get_vehicles() {
    global $db;
    $query = 'SELECT v.*, m.make_name, t.type_name, c.class_name FROM vehicles v
              JOIN makes m ON v.make_id = m.make_id
              JOIN types t ON v.type_id = t.type_id
              JOIN classes c ON v.class_id = c.class_id
              ORDER BY v.price DESC';
    $statement = $db->prepare($query);
    $statement->execute();
    $vehicles = $statement->fetchAll();
    $statement->closeCursor();
    return $vehicles;
}



function get_vehicles_by_price() {
    global $db;
    $query = 'SELECT * FROM vehicles ORDER BY price DESC';
    $statement = $db->prepare($query);
    $statement->execute();
    $vehicles = $statement->fetchAll();
    $statement->closeCursor();
    return $vehicles;
}

function get_vehicles_by_year() {
    global $db;
    $query = 'SELECT * FROM vehicles ORDER BY year DESC';
    $statement = $db->prepare($query);
    $statement->execute();
    $vehicles = $statement->fetchAll();
    $statement->closeCursor();
    return $vehicles;
}

function delete_vehicle($vehicle_id) {
    global $db;
    if (!isset($vehicle_id) || !is_numeric($vehicle_id)) {
        error_log("Invalid or missing vehicle ID.");
        return false;
    }

    $query = "DELETE FROM vehicles WHERE vehicle_id = :vehicle_id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':vehicle_id', $vehicle_id, PDO::PARAM_INT);
    return $stmt->execute();
}




function add_vehicle($make_id, $type_id, $class_id, $year, $model, $price) {
    global $db;
    $query = 'INSERT INTO vehicles (make_id, type_id, class_id, year, model, price)
              VALUES (:make_id, :type_id, :class_id, :year, :model, :price)';
    $statement = $db->prepare($query);
    $statement->bindValue(':make_id', $make_id);
    $statement->bindValue(':type_id', $type_id);
    $statement->bindValue(':class_id', $class_id);
    $statement->bindValue(':year', $year);
    $statement->bindValue(':model', $model);
    $statement->bindValue(':price', $price);
    $statement->execute();
    $statement->closeCursor();
}


function get_vehicles_sorted($sort = 'price', $make_id = null, $type_id = null, $class_id = null) {
    global $db;
    $orderBy = $sort === 'year' ? 'year DESC' : 'price DESC';
    $query = "SELECT v.year, v.model, v.price, m.make_name AS make, t.type_name AS type, c.class_name AS class
              FROM vehicles v
              JOIN makes m ON v.make_id = m.make_id
              JOIN types t ON v.type_id = t.type_id
              JOIN classes c ON v.class_id = c.class_id";

    $conditions = [];
    $parameters = [];

    if ($make_id !== null && $make_id !== 'all') {
        $conditions[] = "m.make_id = :make_id";
        $parameters[':make_id'] = $make_id;
    }
    if ($type_id !== null && $type_id !== 'all') {
        $conditions[] = "t.type_id = :type_id";
        $parameters[':type_id'] = $type_id;
    }
    if ($class_id !== null && $class_id !== 'all') {
        $conditions[] = "c.class_id = :class_id";
        $parameters[':class_id'] = $class_id;
    }

    if (!empty($conditions)) {
        $query .= " WHERE " . join(" AND ", $conditions);
    }

    $query .= " ORDER BY $orderBy";
    $statement = $db->prepare($query);
    $statement->execute($parameters);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}



