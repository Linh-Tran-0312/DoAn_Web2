<?php
# Kết nối với database
require_once('./services/connectionSQL.php');


# Lấy thông tin mã user và vai trò (quản lý hay nhân viên) từ session
$MaNhanVien = $_SESSION['userId'];
$Role = $_SESSION['nhanvien']['Role'];
$ProjectId = "";
$TenProject = "";
$DS_Tasks = [];

# Lấy mã project từ url
if(isset($_REQUEST['projectId'])) {
  $ProjectId = $_REQUEST['projectId'];
}

# Lấy thông tin danh sách mã nhân viên nếu user là quản lý
$DS_MaNhanVien = [];
$MaPhongBan = $_SESSION['nhanvien']['MaPhongBan'];
if($Role == 1) {
  $sql= "SELECT `nhanvien`.`MaNhanVien`,`nhanvien`.`TenNhanVien`  from `nhanvien` WHERE `nhanvien`.`Role`='0' AND `nhanvien`.`MaPhongBan`='$MaPhongBan'";
  $data = mysqli_query($connection, $sql);
  $num_rows = mysqli_num_rows($data);
  if($num_rows != 0) {
    while($nv=mysqli_fetch_assoc($data)) {
    array_push($DS_MaNhanVien, $nv);
    }
  }
}


# Form xử lý khi quản lý tạo task mới
if(isset($_POST['submit'])) {
  $TenCongViec = $_POST['title'];
  $NoiDung = $_POST['description'];
  $NgayTao = date("Y-m-d");
  $Deadline = $_POST['deadline'];
  $PhuTrach = $_POST['staff'];
  $Status = $_POST['status'];

  $sql = "INSERT INTO `congviec`(`TenCongViec`, `NoiDung`, `NgayTao`, `Deadline` ,`PhuTrach`,`Status`,`MaProject`,`MaQuanLy`) VALUES ('$TenCongViec','$NoiDung','$NgayTao','$Deadline','$PhuTrach','$Status', '$ProjectId','$MaNhanVien')";

}


# Nếu user là quản lý thì lấy danh sách tất cả công việc trong project
if($Role == 1) {
  $sql = "SELECT `project`.`TenProject`,`congviec`.`MaCongViec`, `congviec`.`TenCongViec`, `congviec`.`NgayTao`,`congviec`.`Deadline`, `congviec`.`Status`, `nhanvien`.`TenNhanVien`  FROM `congviec` JOIN `nhanvien` ON `congviec`.`PhuTrach`=`nhanvien`.`MaNhanVien` JOIN `project` ON `congviec`.`MaProject`=`project`.`MaProject` WHERE `congviec`.`MaProject`='$ProjectId'";  
  $data = mysqli_query($connection, $sql);
  $num_rows = mysqli_num_rows($data);
  if($num_rows != 0) {
      while($task=mysqli_fetch_assoc($data)) {
          array_push($DS_Tasks, $task);
      }
  }

# Lấy lại thông tin tên project
$sql = "SELECT `project`.`TenProject` FROM `project`  WHERE `project`.`MaProject`='$ProjectId'";
  $data = mysqli_query($connection, $sql);
  $num_rows = mysqli_num_rows($data);
  if($num_rows != 0) {
      while($task=mysqli_fetch_assoc($data)) {
        $TenProject = $task['TenProject'];
      }
  }

# Nếu user là nhân viên thì lấy danh sách tất cả công việc trong project mà nhân viên đó tham gia
} else {
  $sql = "SELECT `project`.`TenProject`,`congviec`.`MaCongViec`, `congviec`.`TenCongViec`, `congviec`.`NgayTao`,`congviec`.`Deadline`, `congviec`.`Status`, `nhanvien`.`TenNhanVien`  FROM `congviec` JOIN `nhanvien` ON `congviec`.`MaQuanLy`=`nhanvien`.`MaNhanVien` JOIN `project` ON `congviec`.`MaProject`=`project`.`MaProject` WHERE `congviec`.`MaProject`='$ProjectId' AND `congviec`.`PhuTrach`='$MaNhanVien'";
  $data = mysqli_query($connection, $sql);
  $num_rows = mysqli_num_rows($data);
  if($num_rows != 0) {
      while($task=mysqli_fetch_assoc($data)) {
        $TenProject = $task['TenProject'];
          array_push($DS_Tasks, $task);
      }
  }

}


?>


<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="row card-header pb-0">
                <div class="col">
                    <h5><?php echo $TenProject?></h5>
                    <h6>Task List</h6>
                </div>
                <div class="col text-right" style="<?php if($Role == 0) echo 'display: none'?>">
                    <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('id01').style.display='block'">Add new task</button>
               

                </div>
<!-- Add Task Modal -->
<div id="id01" class="w3-modal-task">
  <div class="w3-modal-content-task">
    <div class="w3-container-task">
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright-task">&times;</span>
      
      <form action="./index?page=task&projectId=<?php echo $ProjectId?>" method="post" class="form-modal-task" >
        <h3>Add  New Task</h3>
        <div class="form-modal-group-container-task">
          <div class="form-modal-group-task">
            <div class="form-modal-control-task">
              <p>Task Title </p>
              <input type="text" name="title" />
            </div>
            <div class="form-modal-control-task">
              <p>Description</p>
              <textarea cols="20" row="20" name="description"></textarea>
            </div>
            <div class="form-modal-control-task">
              <p>Status</p>
               <select name="status">
                 <option value="NEW ISSUE" selected>NEW ISSUE</option>
               </select>
            </div>
           </div>
           <div class="form-modal-group-task">
     
            <div class="form-modal-control-task">
              <p>Responsible</p>
               <select name="staff" class="select-staff">
                 <?php 
                     foreach($DS_MaNhanVien as $NV) {
                       $TenNV = $NV['TenNhanVien'];
                       $MaNV = $NV['MaNhanVien'];
                       echo "<option value='$MaNV'>$TenNV</option>";
                     }               
                 ?>
               </select>
            </div>
            <div class="form-modal-control-task">
              <p>Deadline</p>
              <input type="text" name="deadline" />
            </div>                        
           </div>
        </div>        
        <button class="btn btn-outline-primary btn-sm mb-0" type="submit" name="submit" onclick="document.getElementById('id01').style.display='none'">ADD</button>   
      </form>
    </div>
  </div>
</div>
<!-- //Add Task Modal -->
            <div class="card-body px-0 pt-2 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên Công Việc</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><?php if($Role == 0) {echo 'Quản Lý';} else { echo 'Phụ Trách'; }?></th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ngày tạo</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deadline</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Trạng Thái</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Tiến Độ</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach($DS_Tasks as $task) {
                      $taskId = $task['MaCongViec'];
                      $name = $task['TenCongViec'];
                      $phutrach = $task['TenNhanVien'];
                      $ngaytao = $task['NgayTao'];
                      $deadline = $task['Deadline'];
                      $status = $task['Status'];

                      echo "
                      
                      <tr>
                     
                      <td>
                        <div class='d-flex px-2'>
                          <div>
                            <img src='./assets/img/small-logos/logo-slack.svg' class='avatar avatar-sm rounded-circle me-2'>
                          </div>
                          <div class='my-auto'>
                            <h6 class='mb-0 text-sm'>$name</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class='text-sm font-weight-bold mb-0'>$phutrach</p>
                      </td>
                      <td>
                        <p class='text-sm font-weight-bold mb-0'>$ngaytao</p>
                      </td>
                      <td>
                        <p class='text-sm font-weight-bold mb-0'>$deadline</p>
                      </td>
                      <td>
                        <span class='text-xs font-weight-bold'>$status</span>
                      </td>
                      <td class='align-middle text-center'>
                        <div class='d-flex align-items-center justify-content-center'>
                        <a href='./index?page=task-details&taskId=$taskId' >
                        <div class='btn btn-info'>Chi tiết</div>
                        </a>
                        </div>
                      </td>
                     
                    </tr>
                   
                    ";
                    }
            
                     ?>
                  </tbody>
                </table>
              </div>
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