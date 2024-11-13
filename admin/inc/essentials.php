<?php
        
        define('SITE_URL', 'http://localhost/flight_booking/');
        define('USERS_IMG_PATH', SITE_URL.'image_customer/users/');

        define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'].'/flight_booking/image_customer/');
        define('USERS_FOLDER','users/');
        
        // Email
        define('SENDGRID_API_KEY',"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");
        define('SENDGRID_EMAIL',"lehuy2425@gmail.com");
        define('SENDGRID_NAME',"WEBSITE");

        // Google
        define('CLIENTID',"910282067487-tfn81757uhj5ghrpb96h5as72h6uvdta.apps.googleusercontent.com");
        define('CLIENTSECRET',"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");
        define('REDIRECTURI', "http://localhost/flight_booking/index.php");

    // function adminLogin(){
    //     session_start();
    //     if(!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)){
    //         echo "
    //             <script>window.location.href = 'login.php';
    //             </script>";
    //         exit;
    //     }
    // }

    function redirect($url){
        echo "
        <script>window.location.href = '$url';
        </script>";
        exit;
    }

    function alert($type, $msg){
        $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
        echo <<<alert
            <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
            <strong class="me-3">$msg</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        alert;
    }

    function uploadImage($image, $folder){
        $valid_mime = ['image/jpeg','image/png','image/webp'];
        $img_mime = $image['type'];

        if(!in_array($img_mime, $valid_mime)){
            return 'inv_img';
        } else if(($image['size'] / (1024 * 1024)) > 2){
            return 'inv_size';
        }else{
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111, 99999).".$ext";

            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname; 
            if(move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }else{
                return 'upd_failed';
            }
        }
        
    }

    function deleteImage($image, $folder){
        if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
            return true;
        }else{
            return false;
        }
    }

    function uploadSVGImage($image, $folder){
        $valid_mime = ['image/svg+xml'];
        $img_mime = $image['type'];

        if(!in_array($img_mime, $valid_mime)){
            return 'inv_img';
        } else if(($image['size'] / (1024 * 1024)) > 1){
            return 'inv_size'; //invalid size greater than 1MB
        }else{
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $rname = 'IMG_'.random_int(11111, 99999).".$ext";

            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname; 
            if(move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }else{
                return 'upd_failed';
            }
        }
        
    }

    function uploadUserImage($image) {
        // Check if the input is a URL (string)
        if (filter_var($image, FILTER_VALIDATE_URL)) {
            // Download the image from URL
            $imageData = file_get_contents($image);
            
            if ($imageData === false) {
                return 'inv_img'; // Failed to download image
            }
    
            // Generate a random name for the image
            $rname = 'IMG_' . random_int(11111, 99999) . ".jpeg";
            $img_path = UPLOAD_IMAGE_PATH . USERS_FOLDER . $rname;
    
            // Save the image as JPEG
            file_put_contents($img_path, $imageData);
    
            // Return the new image name if successful
            return $rname;
        }
    
        // If not a URL, assume the input is a file array
        $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
        $img_mime = $image['type'];
    
        if (!in_array($img_mime, $valid_mime)) {
            return 'inv_img';
        } else {
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $rname = 'IMG_' . random_int(11111, 99999) . ".jpeg";
            $img_path = UPLOAD_IMAGE_PATH . USERS_FOLDER . $rname;
    
            // Khởi tạo biến ảnh dựa vào định dạng file
            if ($ext == 'png' || $ext == 'PNG') {
                $img = @imagecreatefrompng($image['tmp_name']);
            } elseif ($ext == 'webp' || $ext == 'WEBP') {
                $img = @imagecreatefromwebp($image['tmp_name']);
            } else {
                $img = @imagecreatefromjpeg($image['tmp_name']);
            }
    
            // Kiểm tra nếu không tạo được ảnh
            if (!$img) {
                return 'inv_img'; // Trả về lỗi nếu file ảnh không hợp lệ
            }
    
            // Lưu ảnh dưới dạng JPEG
            if (imagejpeg($img, $img_path, 75)) {
                imagedestroy($img); // Giải phóng bộ nhớ sau khi xử lý ảnh
                return $rname;
            } else {
                return 'upd_failed';
            }
        }
    }
    
    



    ?>