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




<div class="row">
          <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
            <div class="card card-plain mt-8">
              <div class="card-header pb-0 text-left bg-transparent">
                <h3 class="font-weight-bolder text-info text-gradient">Welcome back</h3>
                
              </div>
              <div class="card-body">
            
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
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
              <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('./assets/img/curved-images/curved6.jpg')"></div>
            </div>
          </div>
        </div>
