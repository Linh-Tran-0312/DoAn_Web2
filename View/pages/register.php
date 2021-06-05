<?php 

require_once('./services/user.php');
$message ="";

if(isset($_POST['submit'])) {

 
$Password = $_POST['password'];
$ConfirmPassword = $_POST['confirm_password'];
 
$info = array(
  'name' => $_POST['name'],
  'email' => $_POST['email'],
  'password' => $_POST['password'],
  'confirm_password' => $_POST['confirm_password'],
  'department' => $_POST['department'],
  'role' => $_POST['role'],
  'position' =>  $_POST['position']
);

if($Password != $ConfirmPassword) {
    $message = "Mật khẩu không trùng khớp. Vui lòng thử lại !";
} else {

  $result = Register($info);
  if($result['message'] == 'Successful') {
    $_SESSION['isLogin'] = true;
    $_SESSION['nhanvien'] = $result['user'];  
    header('Location: ../DAW2/index.php?page=profile');
  } else {
    $message = $result['message'];
  } 
}
}


?>




                    <p style="color: red"><?php  echo $message?></p>
                
<br/>
<form role="form text-left" action="./index?page=register" method="post">
                  <label>Họ và tên</label>
                  <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Full Name" aria-label="Email" aria-describedby="email-addon" required>
                  </div>
                  <label>Email</label>
                  <div class="mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon"  required>
                  </div>
                  <label>Mật Khẩu</label>
                  <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" required>
                  </div>
                  <label>Xác Thực Mật Khẩu</label>
                  <div class="mb-3">
                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" aria-label="Password" aria-describedby="password-addon" required>
                  </div>
                  <label>Phòng Ban</label>
                  <div class="mb-3">
                    <select type="text" name="department" class="form-control" placeholder="Department"    required>
                        <option value="1">Nhân Sự</option>
                        <option value="2">Marketing</option>
                        <option value="5">Kinh Doanh</option>
                        <option value="8">Kế Toán</option>
                    </select>
                  </div>
                  <label>Cấp Bậc</label>
                  <div class="mb-3">
                    <select type="text" name="role" class="form-control" placeholder="Department"    required>
                        <option value="0">Nhân Viên</option>
                        <option value="1">Quản Lý</option>            
                    </select>
                  </div>
                  <label>Chức Danh</label>
                  <div class="mb-3">
                    <input type="text" name="position" class="form-control" placeholder="Position" aria-label="Email" aria-describedby="email-addon"  required>
                  </div>
                  <div class="text-center">
                    <button type="submit" name="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Đăng Ký</button>
                  </div>
                    <br/>
                  <a href="./index?page=login" class="my-3 text-primary">Nếu bạn đã có tài khoản, đăng nhập tại đây !</a>
                                 
</form>