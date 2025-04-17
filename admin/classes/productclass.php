<?php
session_start();
require('productconfig.php');

class ProductFront extends ProductConfig
{
    private $isqueryrun, $query;

    public function setter()
    {
        $this->isqueryrun = mysqli_query($this->connect, $this->query);
    }
    private function redirectToLogin() {
        session_destroy();
        header("Location: ../home/login.php");
        exit();
    }
    function isloggedinuser() {
        if (!isset($_SESSION['admin_login_token'])) {
            $this->redirectToLogin();
        }
    
        $login_token = $_SESSION['admin_login_token'];
        $u_email = $_SESSION['admin_email'];
    
        $this->query = "SELECT logintoken FROM admin_table WHERE adminemail='{$u_email}' LIMIT 1";
        $this->setter();
    
        if ($this->isqueryrun && mysqli_num_rows($this->isqueryrun) > 0) {
            $info = mysqli_fetch_assoc($this->isqueryrun);
            if ($info['logintoken'] !== $login_token) {
                $this->redirectToLogin();
            }
            // Token matches - allow access
        } else {
            $this->redirectToLogin();
        }
    }
    
    function login_handle() {
        $u_email = $_POST['mail'];
        $u_pass = md5($_POST['pass']); // MD5 the submitted password
    
        $this->query = "SELECT * FROM admin_table WHERE adminemail='{$u_email}'";
        $this->setter();
    
        $user_count = mysqli_num_rows($this->isqueryrun);
    
        if ($user_count > 0) {
            $row = mysqli_fetch_assoc($this->isqueryrun);
            
            // Compare MD5 hashes directly
            if ($row['adminpass'] === $u_pass) {
                // Generate new token and update database
                $token = "MANDAROMECOMMERESE" . time();
                $login_token = md5($token);
                
                $this->query = "UPDATE admin_table SET logintoken='{$login_token}' WHERE adminemail='{$u_email}'";
                $this->setter();
    
                if ($this->isqueryrun) {
                    $_SESSION['admin_login_token'] = $login_token;
                    $_SESSION['admin_email'] = $u_email;
                    header("Location: ../home");
                    exit();
                } else {
                    $_SESSION['login_error'] = "Database update failed";
                    header("Location: login.php");
                    exit();
                }
            } else {
                $_SESSION['login_error'] = "Password is incorrect";
                header("Location: login.php");
                exit();
            }
        } else {
            $_SESSION['login_error'] = "User not found";
            header("Location: login.php");
            exit();
        }
    }


    function add_product(){
        $name = $_POST['pname'];
        $rating = $_POST['prating'];
        $price = $_POST['pprice'];
        $number = $_POST['pdno'];
    
        $imageName = $_FILES['pimage']['name'];
        $imageTmpName = $_FILES['pimage']['tmp_name'];
    
        $destinationFolder = realpath(__DIR__ . "/../assets/products/") . "/";
        $imagePath = $destinationFolder . basename($imageName);
    
        if ($_FILES['pimage']['error'] !== UPLOAD_ERR_OK) {
            header("Location: add-product.php?status=upload_error");
            exit;
        }
    
        if (!is_uploaded_file($imageTmpName)) {
            header("Location: add-product.php?status=tmp_fail");
            exit;
        }
    
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            $this->query = "INSERT INTO product(product_name, product_rating, product_price, product_number, product_image) 
                            VALUES ('$name', '$rating', '$price', '$number', '$imageName')";
            $this->setter();
    
            if ($this->isqueryrun) {
                // Redirect to view-products if successful
                header("Location: view-product.php?status=success");
                exit;
            } else {
                // Redirect to add-product if DB insert fails
                header("Location: add-product.php?status=db_error");
                exit;
            }
        } else {
            // Redirect if file move fails
            header("Location: add-product.php?status=move_fail");
            exit;
        }
    }

    function get_all_products(){
        $this->query = "SELECT * FROM product";
        $this->setter();

        $data = [];

        if (mysqli_num_rows($this->isqueryrun) > 0) {
            while ($row = mysqli_fetch_assoc($this->isqueryrun)) {
                $data[] = $row;
            }
        }

        return $data;
    }
    
    
    

    
}

$productobj = new ProductFront();