<?php
require_once('../classes/productclass.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['admin_login'])) {
    $productobj->login_handle();
} else {
    header("Location: login.php");
    exit();
}
?>