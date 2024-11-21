<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"  integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">   

<nav class="navbar navbar-expand-lg navbar-light px-lg-3 py-lg2 shadow-sm sticky-top bg" id="nav-bar">
  <div class="container-fluid">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">TRAVELS</a>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link me-2" href="index.php">Trang Chủ</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="introduce.php">Giới Thiệu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="contact.php">Liên Hệ</a>
        </li>
      </ul>
      <div class="d-flex">
        
      <?php
        require_once './vendor/autoload.php';
        require("./inc/sendgrid/sendgrid-php.php");

        // create Client Request to access Google API
        $client = new Google_Client();
        $client->setClientId(CLIENTID);
        $client->setClientSecret(CLIENTSECRET);
        $client->setRedirectUri(REDIRECTURI);
        $client->addScope("email");
        $client->addScope("profile");


        
        if (isset($_GET['code'])) 
        {

            function send_email($recipient_email, $token, $type)
            {
              if($type == "email_confirmation"){
                  $page = 'email_confirm.php';
                  $subject = "Account Verification Link";
                  $content = "confirm your email";
              }else{
                  $page = 'index.php';
                  $subject = "Account Reset Link";
                  $content = "reset your account";
                  
              }
              $email = new \SendGrid\Mail\Mail(); 
              $email->setFrom(SENDGRID_EMAIL, SENDGRID_NAME);
              $email->setSubject($subject);
      
              $email->addTo($recipient_email);
            
              $email->addContent(
                  "text/html", "Click the link to $content: <br>
                      <a href='".SITE_URL."$page?$type&email=$recipient_email&token=$token"."'>CLICK</a>
                  "
              );
              $sendgrid = new \SendGrid(SENDGRID_API_KEY);
      
              try{
                  $sendgrid->send($email);
                  return 1;
              }catch (Exception $e){
                  return 0;
              }
          }

          $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
          $client->setAccessToken($token['access_token']);
      
          // get profile info
          $google_oauth = new Google_Service_Oauth2($client);
          $google_account_info = $google_oauth->userinfo->get();
          $email = $google_account_info->email;
          $name = $google_account_info->name;
          $picture = $google_account_info->picture;


          $sql = "SELECT * FROM account_user WHERE email = ?";
          $result = select($sql, [$email], 's'); 

      
          if (mysqli_num_rows($result) > 0) {
            // Email tồn tại - đăng nhập người dùng bằng thông tin từ database
            $row = mysqli_fetch_assoc($result);
            $_SESSION['login'] = true;
            $_SESSION['uName'] = $row['username'];
            $_SESSION['uPic'] = $row['profile'];
            $_SESSION['uEmail'] = $row['email'];

             // Chuyển hướng về trang chính hoặc bất kỳ trang nào
            header('Location: index.php');
            exit();
    
          } else {
            // Email không tồn tại - Tạo tài khoản mới
            

            //upload user image to server
            $img = uploadUserImage($picture);
            if($img == 'inv_img'){
                echo 'inv_img';
                exit;
            }else if($img == 'upd_failed'){
                echo 'upd_failed';
                exit;
            }

            //Send Email
            $token_pass = bin2hex(random_bytes(16));
            if(!send_email($email, $token_pass, "email_confirmation")){
                echo 'mail_failed';
                exit;
            }else{

              $enc_pass = password_hash(1, PASSWORD_BCRYPT);
              $sql = "INSERT INTO account_user(firstName, lastName, username ,email, address, phone, dob, profile, password, token)
                VALUES(?,?,?,?,?,?,?,?,?,?)";
              $values = ["12","13",$name,$email,"123","12345","2003-03-03",$img,$enc_pass, $token_pass];
              insert($sql, $values,'ssssssssss');
            }
          
    
            // Lưu thông tin vào session
            $_SESSION['login'] = true;
            $_SESSION['uName'] = $name;
            $_SESSION['uPic'] = $img;
            $_SESSION['uEmail'] = $email;
        }
        
      }

          if(isset($_SESSION['login']) && $_SESSION['login'] == true){
            $path = USERS_IMG_PATH;
            
            echo<<<data
              
              <div class="btn-group">
                <button type="button" class="btn btn-outline-dark shadow-none dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                  <img src="$path$_SESSION[uPic]" style="width: 25px; height: 25px;" class="me-1 rounded-circle">
                  Xin Chào, $_SESSION[uName]
                </button>
                
                <ul class="dropdown-menu dropdown-menu-lg-end">
                  <li><a class="dropdown-item" href="edit_profile.php"><i class="bi bi-person"></i> Chỉnh sửa hồ sơ</a></li>
                  <li><a class="dropdown-item" href="transaction_list.php"><i class="bi bi-card-list"></i> Danh sách giao dịch</a></li>                  
                  <li><a class="dropdown-item" href="my_bookings.php"><i class="bi bi-box-arrow-in-left"></i> Đặt chỗ của tôi</a></li>                  
                  <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-in-right"></i> Đăng xuất</a></li>
                </ul>
              </div>

            data;
          }else{
            echo<<<data
              <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3" data-bs-toggle="modal" data-bs-target="#loginModal">
                Login
              </button>
              <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
                Register
              </button>
            data;
          }
        ?>
        
        
        
      </div>
    </div>
  </div>
</nav>

<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="login-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-circle fs-3 me-2"></i> User Login</h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control shadow-none" required>           
          </div>
          <div class="mb-4">
            <label class="form-label">Password</label>
            <input type="password" name="pass" class="form-control shadow-none" required>           
          </div>
          <div class="mb-5 text-center">
            <button class="btn btn-outline-dark shadow-none">
              <i class="fab fa-google me-2"></i><a href="<?php echo $client->createAuthUrl() ?>"> Sign in with Google</a>
            </button>           
          </div>
          <div class="d-flex align-items-center justify-content-between mb-2">
            <button type="submit" class="btn btn-dark shadow-none">LOGIN</button>
            <button type="button" class="btn text-secondary text-decoration-none shadow-none p-0" data-bs-toggle="modal" data-bs-target="#forgotModal" data-bs-dismiss="modal">
              Forgot Password?
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="register-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-add"></i> User Registration</h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        

          <div class="container-fluid">
            <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label">First Name</label>
              <input name="fname" type="text" class="form-control shadow-none" required> 
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Last Name</label>
              <input name="lname" type="text" class="form-control shadow-none" required> 
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Username</label>
              <input name="username" type="text" class="form-control shadow-none" required> 
            </div>
            
            <div class="col-md-6 mb-3">
              <label class="form-label">Email</label>
              <input name="email" type="email" class="form-control shadow-none" required> 
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Phone Number</label>
              <input name="phonenum" type="number" class="form-control shadow-none" required> 
            </div>
            
            <div class="col-md-6 mb-3">
              <label class="form-label">Date of birth</label>
              <input name="dob" type="date" class="form-control shadow-none" required> 
            </div>

            <div class="col-md-12 p-0">
              <label class="form-label">Address</label>
              <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
            </div>
            
            <div class="col-md-12 mb-3">
              <label class="form-label">Profile</label>
              <input name="profile" type="file" class="form-control shadow-none" required> 
            </div>
            
            <div class="col-md-6 mb-3">
              <label class="form-label">Password</label>
              <input name="pass" type="password" class="form-control shadow-none" required> 
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label">Confirm password</label>
              <input name="cpass" type="password" class="form-control shadow-none" required> 
            </div>  
            </div>
            <div class="text-center my-1">
              <button type="submit" class="btn btn-dark shadow-none">REGISTER</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="forgotModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="forgot-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-circle fs-3 me-2"></i> Forgot Password</h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control shadow-none" required>           
          </div>
        
          <div class="mb-2 text-end">
            <button type="button" class="btn shadow-none p-0 me-2" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">
                Cancel
            </button>
            <button type="submit" class="btn btn-dark shadow-none">Send</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
