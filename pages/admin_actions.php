<?php

require_once "./system/DB.php";

$pdo = DB::getInstance()->get_pdo();

// Обработка действий с автомобилями
//Получение автомобиля - DONE
if ($_POST['action'] === 'get_car') {
    $carID = $_POST['id'];
    $stmt = $pdo->prepare("SELECT * FROM Car WHERE id=?");
    $stmt->execute([$carID]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($car) {
        echo json_encode(['status' => 'success', 'car' => $car]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Car not found.']);
    }
}

//УДАЛЕНИЕ АВТОМОБИЛЯ - DONE
elseif ($_POST['action'] === 'delete_car') {
    $carID = $_POST['car_id'];
    $stmt = $pdo->prepare("DELETE FROM Car WHERE id=?");
    $stmt->execute([$carID]);
    $rowCount = $stmt->rowCount();
    if($result->rount){
        echo json_encode(['status' => 'success', 'message' => 'Car delete successfully.']);
    }
    else{
        echo json_encode(['status' => 'false', 'message' => 'Car delete false.']);
    }
} 

//РЕДАКТИРОВАНИЕ АВТОМОБИЛЯ - DONE
elseif($_POST['action'] === 'car_edit'){
    $carID = $_POST['car_id'];
    $manufacturerID = $_POST['car_manufacturerID'];
    $car_name = $_POST['car_name'];
    $car_photo = $_POST['car_photo'];
    $car_bodyType = $_POST['car_bodyType'];
    $car_transmission = $_POST['car_transmission'];
    $car_engine = $_POST['car_engine'];
    $car_speed = $_POST['car_speed'];
    $car_cost = $_POST['car_cost'];
    $car_aboutModel = $_POST['car_aboutModel'];
    $stmt = $pdo->prepare("UPDATE Car SET ManufacturerID=?, Name=?, Photo=?,
    BodyType=?,Transmision=?, Engine=?, Speed=?, Cost=?, AboutModel=? WHERE id=?");
    $stmt->execute([$manufacturerID,$car_name,$car_photo,$car_bodyType,$car_transmission,
    $car_engine,$car_speed,$car_cost,$car_aboutModel,$carID]);
    $rowCount = $stmt->rowCount();
    if($rowCount>0){
        echo json_encode(['status' => 'success', 'message' => 'Car edit successfully.']);
    }
    else{
        echo json_encode(['status' => 'false', 'message' => 'Car edit false.']);
    }
}

// Обработка действий с производителями
//ПОЛУЧЕНИЕ ПРОИЗВОДИТЕЛЯ - DONE
elseif ($_POST['action'] === 'get_manufacturer') {
    $manufacturerID = $_POST['manufacturer_id'];
    $stmt = $pdo->prepare("SELECT * FROM Manufacturer WHERE id=?");
    $stmt->execute([$manufacturerID]);
    $manufacturer = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($manufacturer) {
        echo json_encode(['status' => 'success', 'manufacturer' => $manufacturer]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Manufacturer not found.']);
    }
}

//УДАЛЕНИЕ ПРОИЗВОДИТЕЛЯ - DONE
elseif ($_POST['action'] === 'delete_manufacturer') {
    $manufacturerID = $_POST['manufacturer_id'];
    $stmt = $pdo->prepare("DELETE FROM Manufacturer WHERE id=?");
    $stmt->execute([$manufacturerID]);
    $rowCount = $stmt->rowCount();
    if($rowCount>0){
        echo json_encode(['status' => 'success', 'message' => 'Manufacturer delete successfully.']);
    }
    else{
        echo json_encode(['status' => 'false', 'message' => 'Manufacturer delete false.']);
    }
}

//РЕДАКТИРОВАНИЕ ПРОИЗВОДИТЕЛЯ - DONE
elseif ($_POST['action'] === 'edit_manufacturer') {
    $manufacturerID = $_POST['manufacturer_id'];
    $manufacturer_name = $_POST['manufacturer_name'];
    $manufacturer_logo = $_POST['manufacturer_logo'];
    $_manufacturer_description = $_POST['manufacturer_description'];
    $stmt = $pdo->prepare("UPDATE Manufacturer SET ManufacturerName=?, Logo=?, Description=? WHERE id=?");
    $stmt->execute([$manufacturer_name,$manufacturer_logo,$_manufacturer_description,$manufacturerID]);
    echo json_encode(['status' => 'success', 'message' => 'Manufacturer edit successfully.']);
    
}


//ДОБАВЛЕНИЕ АВТОМОБИЛЯ - DONE
elseif($_POST['action'] === 'add_car'){
    $manufacturerID = $_POST['car_manufacturerID'];
    $car_name = $_POST['car_name'];
    $car_photo = $_POST['car_photo'];
    $car_bodyType = $_POST['car_bodyType'];
    $car_transmission = $_POST['car_transmission'];
    $car_engine = $_POST['car_engine'];
    $car_speed = $_POST['car_speed'];
    $car_cost = $_POST['car_cost'];
    $car_aboutModel = $_POST['car_aboutModel'];

    $stmt = $pdo->prepare("INSERT INTO Car (ManufacturerID, Name, Photo, BodyType, Transmision, Engine, Speed, Cost, AboutModel)
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    
    $stmt->execute([$manufacturerID,$car_name,$car_photo,$car_bodyType,$car_transmission,$car_engine,$car_speed,$car_cost,$car_aboutModel]);
    $rowCount = $stmt->rowCount();
    if($rowCount>0){
        echo json_encode(['status' => 'success', 'message' => 'Car add successfully.']);
    }
    else{
        echo json_encode(['status' => 'false', 'message' => 'Car add false.']);
    }
}

elseif($_POST['action'] === 'add_manufacturer'){
    $manufacturer_name = $_POST['manufacturer_name'];
    $manufacturer_logo = $_POST['manufacturer_logo'];
    $manufacturer_description = $_POST['manufacturer_description'];

    $stmt = $pdo->prepare("INSERT INTO Manufacturer (ManufacturerName, Logo, Description)
                        VALUES (?, ?, ?)");

    

    $stmt->execute([$manufacturer_name,$manufacturer_logo,$manufacturer_description]);
    $rowCount = $stmt->rowCount();
    if($rowCount>0){
        echo json_encode(['status' => 'success', 'message' => 'Manufacturer add successfully.']);
    }
    else{
        echo json_encode(['status' => 'false', 'message' => 'Manufacturer add false.']);
    }
}

?>