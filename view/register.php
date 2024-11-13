<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/register.css">
</head>
<body>
    <div class="form-container">
        <p class="title">Create account</p>
        <form class="form" method="post" action="../controller/account_user.php">
            <div class="full_name" style="display: flex;">
                <input type="text" class="input" placeholder="First Name" name="first_name">
                <input type="text" class="input" placeholder="Last Name" name="last_name">
            </div>
            <label class="username-error"></label>
            <input type="text" class="input username" placeholder="Username" name="username">
            <input type="email" class="input" placeholder="Email" name="email" id="email">
            <label id="error_code"></label>
            <div class="authentication_code">
                <button type="button" id="get_codeBtn">Lấy mã</button>
                <input type="text" class="input" placeholder="Code" name="code" id="code">
            </div>
            <input type="password" class="input" placeholder="Password" name="password" id="password">
            <label id="error_password"></label>
            <input type="password" class="input" placeholder="Confirm Password" name="confirm_password" id="confirm_password">
            <button class="form-btn">Create account</button>
        </form>
        <p class="sign-up-label">
            Already have an account?<a class="sign-up-link" href="login.php">Log in</a>
        </p>
        <div class="buttons-container">
            <div class="google-login-button">
                <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1" x="0px" y="0px" class="google-icon" viewBox="0 0 48 48" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg">
                <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12
        c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24
        c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"></path>
                <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657
        C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"></path>
                <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36
        c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"></path>
                <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571
        c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"></path>
                </svg>
                <span>Sign up with Google</span>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function generateRandomCode(length = 6) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let randomCode = '';

            for (let i = 0; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * characters.length);
                randomCode += characters[randomIndex];
            }

            return randomCode;
        }
        
        var sendCode = ''
        document.getElementById('get_codeBtn').addEventListener('click', function () {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../controller/account_user.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            var email = document.getElementById('email').value;

            xhr.send('email=' + email);

            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('error_code').textContent = "Mã xác thực đã được gửi qua email!";
                    document.getElementById('error_code').style.color = 'green';

                    sendCode = xhr.responseText;
                }
            }
        })

        document.getElementById('code').addEventListener('change', function () {
            if (this.value == sendCode) {
                document.getElementById('error_code').textContent = "Mã xác thực hợp lệ!";
                document.getElementById('error_code').style.color = 'green';
            } else {
                document.getElementById('error_code').textContent = "Mã xác thực sai!";
                document.getElementById('error_code').style.color = 'red';
            }
        })

        document.getElementById('confirm_password').addEventListener('change', function () {
            if (this.value != document.getElementById('password').value) {
                document.getElementById('error_password').textContent = "Không trùng mật khẩu!";
                document.getElementById('error_password').style.color = 'red';
            } else {
                document.getElementById('error_password').textContent = "Mật khẩu hợp lệ!";
                document.getElementById('error_password').style.color = 'green';
            }
        })

        $(document).ready(function () {
            $('.username').on('input', function () {
                var username = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: '../model/check_error_flight.php',
                    data: {username: username},
                    success: function (response) {
                        $('.username-error').text(response);
                        $('.username-error').css('color', 'red');
                    },
                    error: function () {
                        $('.username-error').text('Error');
                        $('.username-error').css('color', 'red');
                        $('.username-error').css('font-size', '5px');
                    }
                })
            })
        })
    </script>
</body>
</html>