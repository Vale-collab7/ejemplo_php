<?php
    require_once 'models/Database.php';
    require_once 'controllers/Users.php';
    $controller = new Users;
    $controller->userDelete();
    ?>