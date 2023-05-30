<?php 

class GET_HANDLER {
    function HANDLE_GET() {
        require_once "./system/DB.php";
        $username = 'root';
        $password = '';
        $db = 'drive-up';
        $host = 'drive-up';

        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );

        $dsn = 'mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8;';

        try {
            DB::getInstance()->connect($dsn, $username, $password, $opt);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        $pdo = DB::getInstance()->get_pdo();

        $requestURI = trim($_SERVER['REQUEST_URI'], '/');
        $segments = explode('/', $requestURI);
        
        if ($segments[0] === 'admin') {
            if (isset($segments[1]) && $segments[1] === 'admin_actions.php') {
                require './pages/admin_actions.php';
                exit;
            }
            require './pages/Admin.php';
        }

        else if (empty($segments[0])) {
            require './pages/Main.php';
        } elseif (count($segments) == 1) {
            $manufacturer = $segments[0];
            $query = $pdo->query('SELECT * FROM Manufacturer WHERE ManufacturerName = "' . $manufacturer . '"')->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($query)) {
                require './pages/Manufacturer.php';
            } else {
                require './404.php';
            }
        } elseif (count($segments) == 2) {
            $manufacturer = $segments[0];
            $model = $segments[1];
            $query_manufacturer = $pdo->query('SELECT * FROM Manufacturer WHERE ManufacturerName = "' . $manufacturer . '"')->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($query_manufacturer)) {
                $query_model = $pdo->query('SELECT * FROM Car WHERE Name = "' . $model . '"')->fetchAll(PDO::FETCH_ASSOC);

                if (!empty($query_model)) {
                    require './pages/Model.php';
                } else {
                    require './404.php';
                }
            } else {
                require './404.php';
            }
        } else {
            require './404.php';
        }
    }
}

?>