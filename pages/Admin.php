<?php
// Admin.php

require_once "./system/DB.php";

$pdo = DB::getInstance()->get_pdo();



// Вывод списка автомобилей
$carQuery = $pdo->query("SELECT * FROM Car");
$cars = $carQuery->fetchAll(PDO::FETCH_ASSOC);

// Вывод списка производителей
$manufacturerQuery = $pdo->query("SELECT * FROM Manufacturer");
$manufacturers = $manufacturerQuery->fetchAll(PDO::FETCH_ASSOC);

?>

<h2>Add New Car</h2>
<form id="add-car-form" method="post">
    <input type="hidden" name="action" value="add_car">
    <label for="add-car-manufacturerID">Manufacturer ID:</label>
    <input type="text" name="car_manufacturerID" id="add-car-manufacturerID" required>
    <label for="add-car-name">Name:</label>
    <input type="text" name="car_name" id="add-car-name" required>
    <label for="add-car-photo">Photo:</label>
    <input type="text" name="car_photo" id="add-car-photo" required>
    <label for="add-car-bodyType">Body Type:</label>
    <input type="text" name="car_bodyType" id="add-car-bodyType" required>
    <label for="add-car-transmission">Transmission:</label>
    <input type="text" name="car_transmission" id="add-car-transmission" required>
    <label for="add-car-engine">Engine:</label>
    <input type="text" name="car_engine" id="add-car-engine" required>
    <label for="add-car-speed">Speed:</label>
    <input type="text" name="car_speed" id="add-car-speed" required>
    <label for="add-car-cost">Cost:</label>
    <input type="text" name="car_cost" id="add-car-cost" required>
    <label for="add-car-aboutModel">About Model:</label>
    <textarea name="car_aboutModel" id="add-car-aboutModel" required></textarea>
    <input type="submit" value="Add Car">
</form>

<h2>Add New Manufacturer</h2>
<form id="add-manufacturer-form" method="post">
    <input type="hidden" name="action" value="add_manufacturer">
    <label for="add-manufacturer-name">Manufacturer Name:</label>
    <input type="text" name="manufacturer_name" id="add-manufacturer-name" required>
    <label for="add-manufacturer-logo">Logo:</label>
    <input type="text" name="manufacturer_logo" id="add-manufacturer-logo" required>
    <label for="add-manufacturer-description">Description:</label>
    <textarea name="manufacturer_description" id="add-manufacturer-description" required></textarea>
    <input type="submit" value="Add Manufacturer">
</form>

<!-- HTML-разметка для вывода и управления автомобилями -->
<h2>Car List</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Manufacturer ID</th>
            <th>Name</th>
            <th>Photo</th>
            <th>Body Type</th>
            <th>Transmission</th>
            <th>Engine</th>
            <th>Speed</th>
            <th>Cost</th>
            <th>About Model</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cars as $car) : ?>
        <tr>
            <td><?php echo $car['id']; ?></td>
            <td><?php echo $car['ManufacturerID']; ?></td>
            <td><?php echo $car['Name']; ?></td>
            <td><?php echo $car['Photo']; ?></td>
            <td><?php echo $car['BodyType']; ?></td>
            <td><?php echo $car['Transmision']; ?></td>
            <td><?php echo $car['Engine']; ?></td>
            <td><?php echo $car['Speed']; ?></td>
            <td><?php echo $car['Cost']; ?></td>
            <td><?php echo $car['AboutModel']; ?></td>
            <td>
                <button class="edit-car-button" data-car-id="<?php echo $car['id']; ?>">Edit</button>
                <button class="delete-car-button" data-car-id="<?php echo $car['id']; ?>">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- HTML-разметка для вывода и управления производителями -->
<h2>Manufacturer List</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Manufacturer Name</th>
            <th>Logo</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($manufacturers as $manufacturer) : ?>
        <tr>
            <td><?php echo $manufacturer['id']; ?></td>
            <td><?php echo $manufacturer['ManufacturerName']; ?></td>
            <td><?php echo $manufacturer['Logo']; ?></td>
            <td><?php echo $manufacturer['Description']; ?></td>
            <td>
                <button class="edit-manufacturer-button" data-manufacturer-id="<?php echo $manufacturer['id']; ?>">Edit</button>
                <button class="delete-manufacturer-button" data-manufacturer-id="<?php echo $manufacturer['id']; ?>">Delete</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- HTML-разметка для модального окна редактирования автомобиля -->
<div id="edit-car-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Edit Car</h3>
        <form id="edit-car-form" method="post">
            <input type="hidden" name="action" value="car_edit">
            <input type="hidden" name="car_id" id="edit-car-id">
            <label for="edit-car-manufacturerID">Manufacturer ID:</label>
            <input type="text" name="car_manufacturerID" id="edit-car-manufacturerID" required>
            <label for="edit-car-name">Name:</label>
            <input type="text" name="car_name" id="edit-car-name" required>
            <label for="edit-car-photo">Photo:</label>
            <input type="text" name="car_photo" id="edit-car-photo" required>
            <label for="edit-car-bodyType">Body Type:</label>
            <input type="text" name="car_bodyType" id="edit-car-bodyType" required>
            <label for="edit-car-transmission">Transmission:</label>
            <input type="text" name="car_transmission" id="edit-car-transmission" required>
            <label for="edit-car-engine">Engine:</label>
            <input type="text" name="car_engine" id="edit-car-engine" required>
            <label for="edit-car-speed">Speed:</label>
            <input type="text" name="car_speed" id="edit-car-speed" required>
            <label for="edit-car-cost">Cost:</label>
            <input type="text" name="car_cost" id="edit-car-cost" required>
            <label for="edit-car-aboutModel">About Model:</label>
            <textarea name="car_aboutModel" id="edit-car-aboutModel" required></textarea>
            <input type="submit" value="Save">
        </form>
    </div>
</div>

<!-- HTML-разметка для модального окна редактирования производителя -->
<div id="edit-manufacturer-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Edit Manufacturer</h3>
        <form id="edit-manufacturer-form" method="post">
            <input type="hidden" name="action" value="edit_manufacturer">
            <input type="hidden" name="manufacturer_id" id="edit-manufacturer-id">
            <label for="edit-manufacturer-name">Manufacturer Name:</label>
            <input type="text" name="manufacturer_name" id="edit-manufacturer-name" required>
            <label for="edit-manufacturer-logo">Logo:</label>
            <input type="text" name="manufacturer_logo" id="edit-manufacturer-logo" required>
            <label for="edit-manufacturer-description">Description:</label>
            <textarea name="manufacturer_description" id="edit-manufacturer-description" required></textarea>
            <input type="submit" value="Save">
        </form>
    </div>
</div>

<!-- JQuery для взаимодействия с сервером без перезагрузки страницы -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Открытие модального окна редактирования автомобиля
        $('.edit-car-button').click(function () {
            var carID = $(this).data('car-id');
            $.ajax({
                url: 'admin/admin_actions.php',
                type: 'post',
                dataType: 'json',
                data: {
                    action: 'get_car',
                    id: carID
                },
                success: function (response) {
                    if (response.status === 'success') {
                        $('#edit-car-id').val(response.car.id);
                        $('#edit-car-manufacturerID').val(response.car.ManufacturerID);
                        $('#edit-car-name').val(response.car.Name);
                        $('#edit-car-photo').val(response.car.Photo);
                        $('#edit-car-bodyType').val(response.car.BodyType);
                        $('#edit-car-transmission').val(response.car.Transmision);
                        $('#edit-car-engine').val(response.car.Engine);
                        $('#edit-car-speed').val(response.car.Speed);
                        $('#edit-car-cost').val(response.car.Cost);
                        $('#edit-car-aboutModel').val(response.car.AboutModel);
                        $('#edit-car-modal').css('display', 'block');
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('Error occurred while retrieving car data.');
                }
            });
        });

        // Закрытие модального окна редактирования автомобиля
        $('.modal .close').click(function () {
            $(this).closest('.modal').css('display', 'none');
        });

        // Открытие модального окна редактирования производителя
        $('.edit-manufacturer-button').click(function () {
            var manufacturerID = $(this).data('manufacturer-id');
            $.ajax({
                url: 'admin/admin_actions.php',
                type: 'post',
                dataType: 'json',
                data: {
                    action: 'get_manufacturer',
                    manufacturer_id: manufacturerID
                },
                success: function (response) {
                    if (response.status === 'success') {
                        $('#edit-manufacturer-id').val(response.manufacturer.id);
                        $('#edit-manufacturer-name').val(response.manufacturer.ManufacturerName);
                        $('#edit-manufacturer-logo').val(response.manufacturer.Logo);
                        $('#edit-manufacturer-description').val(response.manufacturer.Description);
                        $('#edit-manufacturer-modal').css('display', 'block');
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('Error occurred while retrieving manufacturer data.');
                }
            });
        });

        // Отправка формы редактирования автомобиля
        $('#edit-car-form').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: 'admin/admin_actions.php',
                type: 'post',
                dataType: 'json',
                data: $(this).serialize(),
                success: function (response) {
                    console.log(response);
                    if (response.status === 'success') {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('Error occurred while updating car data.');
                }
            });
        });

        // Отправка формы редактирования производителя
        $('#edit-manufacturer-form').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: 'admin/admin_actions.php',
                type: 'post',
                dataType: 'json',
                data: $(this).serialize(),
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('Error occurred while updating manufacturer data.');
                }
            });
        });

        // Удаление автомобиля
        $('.delete-car-button').click(function () {
            if (confirm('Are you sure you want to delete this car?')) {
                var carID = $(this).data('car-id');
                $.ajax({
                    url: 'admin/admin_actions.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        action: 'delete_car',
                        car_id: carID
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function () {
                        alert('Error occurred while deleting car.');
                    }
                });
            }
        });

        // Удаление производителя
        $('.delete-manufacturer-button').click(function () {
            if (confirm('Are you sure you want to delete this manufacturer?')) {
                var manufacturerID = $(this).data('manufacturer-id');
                console.log(manufacturerID);
                $.ajax({
                    url: 'admin/admin_actions.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        action: 'delete_manufacturer',
                        manufacturer_id: manufacturerID
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function () {
                        alert('Error occurred while deleting manufacturer.');
                    }
                });
            }
        });

        //Отправка формы добавления авто
        $('#add-car-form').submit(function (e) {
            e.preventDefault();
            console.log($(this).serialize())
            $.ajax({
                url: 'admin/admin_actions.php',
                type: 'post',
                dataType: 'json',
                data: $(this).serialize(),
                success: function (response) {
                    console.log(response);
                    if (response.status === 'success') {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('Error occurred while updating car data.');
                }
            });
        });
    });
</script>