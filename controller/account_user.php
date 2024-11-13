<?php
    require('../model/database.php');
    require('../model/acccount.php');

    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])) {
        $firstName = trim($_POST['first_name']);
        $lastName = trim($_POST['last_name']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $email = trim($_POST['email']);
        $account = add_account($db, $firstName, $lastName, $username, $password, $email);
        if ($account) {
            header("Location: ../view/login.php");
            exit();
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
        
            $account = get_account($db, $username, $password);
        
            if ($account) {
                session_start();

                $_SESSION['username'] = $username;
                $_SESSION['id'] = $account['id'];
                $_SESSION['userName'] = $account['userName'];
                $_SESSION['firstName'] = $account['firstName'];
                $_SESSION['lastName'] = $account['lastName'];
                
                if ($username == 'dinhvuong') {
                    header("Location: ../admin");
                } else {
                    header("Location: ../index.php");
                }
                exit();
            } else {
                $message = "Email hoặc mật khẩu không đúng!";
                header("Location: ../view/login.php?message=" . urlencode($message));
                exit();
            }
        }
    }
?>