<?php 

require_once('./services/user.php');


# Lấy thông tin mã nhân viên  lưu từ session
$ID = $_SESSION['userId'];

# Form xử lý khi nhan viên update hình của họ
if(isset($_FILES['image'])) {



  $image_base64 = base64_encode(file_get_contents($_FILES['image']['tmp_name']) );
  $image = 'data:image/jpg;base64,'.$image_base64;

  uploadAvatar($ID, $image);
}


# Form xử lý khi nhân viên update profile của họ 
if(isset($_POST['submit'])) {

    $profile = array(
      'id'=> $ID,
      'name' => $_POST['name'],
      'position' => $_POST['position'],
      'job_description' => $_POST['job_description'],
      'department' => $_POST['department'],
      'phone' => $_POST['phone'],
      'email' => $_POST['email'],
      'address' => $_POST['address']
    );

    updateProfile($profile);

}
# Gọi hàm lấy thông tin profile từ mã nhân viên
$profile = getProfile($ID);
$_SESSION['nhanvien'] = $profile;

# Gán thông tin nhân viên nhân viên vào các biến
$Role= $profile['Role'];
$Name = $profile['TenNhanVien'];
$Avatar = $profile['Hinh'];
$Position = $profile['ChucDanh'];
$JobDescription = $profile['CongViec'];
$Phone = $profile['SoDienThoai'];
$Department = $profile['TenPhongBan'];
$DepartmentId = $profile['MaPhongBan'];
$Address = $profile['DiaChi'];
$Email = $profile['Email'];

# Lấy thông tin danh sách nhân viên nếu user là quản lý để hiển thị trong bản tạo công việc
$StaffList = "";
if($profile['Role'] == 1) {
  $StaffList = getStaffList($DepartmentId);
}

?>

<div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('./assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="<?php if($Avatar) { echo $Avatar;} else { echo 'assets/img/default-avatar.png';} ?>" alt=".." class="w-100 border-radius-lg shadow-sm" style="width: 90px; height: 80px; object-fit: cover">
              <form action='./index?page=profile' method='post' enctype="multipart/form-data">
                <label for='img'>
                  <input name='image' id='img' type='file' style='display: none' onchange='javascript:this.form.submit();'/>
                <a  class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                  <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Image"></i>
                </a>
                </label>
                <input type='submit' name='upload' style='display: none'/>
              </form>
            
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
               <?php echo $Name?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
              <?php echo $Position?>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row"> 
        <div class="col-12 col-xl-8">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Mô tả công việc</h6>
                </div>
                <div class="col-md-4 text-right">
                  <a onclick="document.getElementById('id01').style.display='block'">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <p class="text-sm">
                <?php echo $JobDescription?>
              </p>
              <hr class="horizontal gray-light my-4">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Phòng:</strong> &nbsp;  <?php echo $Department?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Số Điện Thoại:</strong> &nbsp;  <?php echo $Phone?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp;  <?php echo $Email?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Địa Chỉ:</strong> &nbsp;  <?php echo $Address?></li>
                <li class="list-group-item border-0 ps-0 pb-0">
                  <strong class="text-dark text-sm">Social:</strong> &nbsp;
                  <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-facebook fa-lg"></i>
                  </a>
                  <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-twitter fa-lg"></i>
                  </a>
                  <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-instagram fa-lg"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-4" style="<?php if($Role == 0) echo 'display: none'?>">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Nhân viên của bạn</h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
              <?php
              foreach($StaffList as $nv) {
                $TenNV = $nv['TenNhanVien'];
                $CDanh = $nv['ChucDanh'];
                $Ava = $nv['Hinh'];
                if(!$Ava) {
                  $Ava = 'assets/img/default-avatar.png';
                }
                echo "
                <li class='list-group-item border-0 d-flex align-items-center px-0 mb-2'>
                  <div class='avatar me-3'>
                    <img src='$Ava' alt='kal' class='border-radius-lg shadow'>
                  </div>
                  <div class='d-flex align-items-start flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm'>$TenNV</h6>
                    <p class='mb-0 text-xs'>$CDanh</p>
                  </div>
            
                </li> ";}
                 ?>
              </ul>
            </div>
          </div>
        </div>
        <!-- Add Task Modal -->
<div id="id01" class="w3-modal-task">
  <div class="w3-modal-content-task">
    <div class="w3-container-task">
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-button-task w3-display-topright-task">&times;</span>
      
      <form action="./index?page=profile" method="post" class="form-modal-task" >
        <h3>Cập nhật thông tin</h3>
        <div class="form-modal-group-container-task">
          <div class="form-modal-group-task">
            <div class="form-modal-control-task">
              <p>Họ và Tên </p>
              <input type="text" name="name" value='<?php echo $Name?>' />
            </div>
            <div class="form-modal-control-task">
              <p>Vị trí</p>
              <input type="text" name="position" value='<?php echo $Position?>' />
            </div>
            <div class="form-modal-control-task">
              <p>Mô tả công việc</p>
              <textarea cols="20" row="20" style="height: 120px" name="job_description"><?php echo $JobDescription?></textarea>
            </div>        
           </div>
           <div class="form-modal-group-task"> 
           <div class="form-modal-control-task" >
            <p>Phòng Ban</p>
                  <select type="text" name="department"    placeholder="Department"    required>
                      <option value="1" <?php if($DepartmentId == '1'){echo("selected");}?>>Nhân Sự</option>
                      <option value="2" <?php if($DepartmentId == '2'){echo("selected");}?>>Marketing</option>
                      <option value="5" <?php if($DepartmentId == '5'){echo("selected");}?>>Kinh Doanh</option>
                      <option value="8" <?php if($DepartmentId == '8'){echo("selected");}?>>Kế Toán</option>
                  </select>
            </div> 
           <div class="form-modal-control-task">
              <p>Số Điện Thoại</p>
              <input type="text" name="phone" value='<?php echo $Phone?>' />
            </div>
            <div class="form-modal-control-task">
              <p>Email</p>
              <input type="text" name="email" value='<?php echo $Email?>' />
            </div>  
            <div class="form-modal-control-task">
              <p>Địa Chỉ</p>
              <input type="text" name="address" value='<?php echo $Address?>'/>
            </div>                      
           </div>
        </div>       
        <br/> 
        <button class="btn btn-outline-primary btn-sm mb-0" type="submit" name="submit" onclick="document.getElementById('id01').style.display='none'">Cập Nhật</button>   
      </form>
      <br />
    </div>
  </div>
</div>
<!-- //Add Task Modal -->
      </div>
      <footer class="footer pt-3">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-left">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="http://blog.creative-tim.com" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>