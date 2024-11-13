<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>
<body>
    <div class="form-container">
        <p class="title">Welcome back</p>
        <form class="form" method="post" action="../controller/account_user.php">
            <?php
                if (isset($_GET['message'])) {
                    echo '<span class="form_error">' . htmlspecialchars($_GET['message']) . '</span>';
                } else {
                    echo '';
                }
            ?>
            <input type="text" class="input" placeholder="User Name" name="username">
            <input type="password" class="input" placeholder="Password" name="password">
            <p class="page-link">
                <span class="page-link-label">Forgot Password?</span>
            </p>
            <button type="submit" class="form-btn">Log in</button>
        </form>
        <p class="sign-up-label">
            Don't have an account?<a class="sign-up-link" href="register.php">Sign up</a>
        </p>
</body>
</html>