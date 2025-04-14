<?php 
//session_start();
if(isset($_SESSION['admin_login_token']))
{
    $productobj->isloggedinuser();
}
else
{
    session_destroy();
    // echo "Hello";
    echo "<script> window.location.replace('../home/login.php'); </script> ";
    // echo "No token found";
}
?>