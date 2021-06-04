<?php 

# Kết nối database
require_once('./services/connectionSQL.php');

# Lấy thông tin profile lưu từ session
$ID = $_SESSION['nhanvien']['MaNhanVien'];
$Role= $_SESSION['nhanvien']['Role'];
$TenNhanvien = $_SESSION['nhanvien']['TenNhanVien'];
$ChucDanh = $_SESSION['nhanvien']['ChucDanh'];
$CongViec = $_SESSION['nhanvien']['CongViec'];
$SoDienThoai = $_SESSION['nhanvien']['SoDienThoai'];
$PhongBan = $_SESSION['nhanvien']['TenPhongBan'];
$MaPhongBan = $_SESSION['nhanvien']['MaPhongBan'];
$DiaChi = $_SESSION['nhanvien']['DiaChi'];
$Email = $_SESSION['nhanvien']['Email'];
$DS_NhanVien = [];

# Kết nôi với database để lấy thông tin danh sách nhân viên nếu user là quản lý
if($_SESSION['nhanvien']['Role'] == 1) {
  $sql= "SELECT `nhanvien`.`TenNhanVien`, `nhanvien`.`ChucDanh` from `nhanvien` WHERE `nhanvien`.`Role`='0' AND `nhanvien`.`MaPhongBan`='$MaPhongBan'";
  $data = mysqli_query($connection, $sql);
  $num_rows = mysqli_num_rows($data);
  if($num_rows != 0) {
    while($nv=mysqli_fetch_assoc($data)) {
    array_push($DS_NhanVien, $nv);
    }
  }
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
              <img src="./assets/img/bruce-mars.jpg" alt=".." class="w-100 border-radius-lg shadow-sm">
              <a href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Image"></i>
              </a>
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
               <?php echo $TenNhanvien?>
              </h5>
              <p class="mb-0 font-weight-bold text-sm">
              <?php echo $ChucDanh?>
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
                  <h6 class="mb-0">Nhiệm vụ chính</h6>
                </div>
                <div class="col-md-4 text-right">
                  <a href="javascript:;">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <p class="text-sm">
                <?php echo $CongViec?>
              </p>
              <hr class="horizontal gray-light my-4">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Phòng:</strong> &nbsp;  <?php echo $PhongBan?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Số Điện Thoại:</strong> &nbsp;  <?php echo $SoDienThoai?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp;  <?php echo $Email?></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Địa Chỉ:</strong> &nbsp;  <?php echo $DiaChi?></li>
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
              foreach($DS_NhanVien as $nv) {
                $TenNV = $nv['TenNhanVien'];
                $CDanh = $nv['ChucDanh'];
                echo "
                <li class='list-group-item border-0 d-flex align-items-center px-0 mb-2'>
                  <div class='avatar me-3'>
                    <img src='./assets/img/kal-visuals-square.jpg' alt='kal' class='border-radius-lg shadow'>
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