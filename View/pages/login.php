<?php 


require_once('./services/user.php');

# Khai báo biến tin nhắn trong trương hợp login lỗi
$message = "";
 
# Form xử lý đăng nhâp
 if (isset($_POST['submit'])) {  
  $email = $_POST['email'];
  $password = $_POST['password'];

  $result = Login($email, $password);

  if($result['message'] == 'Successful') {
    $_SESSION['isLogin'] = true;
    $_SESSION['userId'] = $result['user']['MaNhanVien'];  
    header('Location: ../DAW2/index.php?page=profile');
  } else {
    $message = $result['message'];
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
                    <p style="color: red"><?php  echo $message?></p>
                  </div>
                  <div class="text-center">
                    <button type="submit" name="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                  </div>
                  <br/>
                  <a href="./index?page=register" class="my-3 text-primary">Nếu bạn là nhân viên mới, tạo tài khoản tại đây !</a>
                 
</form>