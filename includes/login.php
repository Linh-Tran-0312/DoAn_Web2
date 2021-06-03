<?php 

 
require_once('./services/connectionSQL.php');  

$email = "";
$password = "";
$message = "";
if(isset($_POST['email'])) {
	$email = $_POST['email'];
}
if(isset($_POST['password'])) {
	$password = $_POST['password'];
}

 if (isset($_POST['submit'])) {  
$sql = "SELECT * from nhanvien where Email = '$email' and Password= '$password'";
$data = mysqli_query($connection, $sql);
$n = mysqli_num_rows($data);

if($n == 0) {
  $message = "Email hoặc mật khẩu không chính xác vui lòng thử lại";
} else {  
    while($nhanvien = mysqli_fetch_assoc($data)) {
      $sql = "SELECT * FROM `nhanvien` JOIN `phongban` ON `nhanvien`.`MaPhongBan` = `phongban`.`MaPhongBan` WHERE `nhanvien`.`MaNhanVien` = '".$nhanvien['MaNhanVien']."'";
      $data = mysqli_query($connection, $sql);
      while($nhanvien = mysqli_fetch_assoc($data)) {
        $_SESSION['isLogin'] = true;
        $_SESSION['nhanvien'] = $nhanvien;  
        header('Location: ../DAW2/index.php?page=profile');
      }         
    }   
}
}  




?>






<form role="form text-left" action="./index?page=login" method="post">
                  <label>Email</label>
                  <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                  </div>
                  <label>Password</label>
                  <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                  </div>
                  <div class="form-check form-switch">
                   <!--  <input class="form-check-input" type="checkbox" id="rememberMe" checked=""> -->
                    <!-- <label class="form-check-label" for="rememberMe">Remember me</label> -->
                    <p style="color: red"><?php  echo $message?></p>
                  </div>
                  <div class="text-center">
                    <button type="submit" name="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                  </div>
                 
</form>