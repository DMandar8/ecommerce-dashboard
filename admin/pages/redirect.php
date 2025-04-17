<?php
include('../classes/productclass.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product_btn']))
{   
    $productobj->add_product();
}

?>