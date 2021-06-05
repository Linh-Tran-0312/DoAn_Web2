<?php

require_once('./services/user.php');
require_once('./services/task.php');
require_once('./services/project.php');


# Lấy thông tin mã user và vai trò (quản lý hay nhân viên) từ session
$UserId = $_SESSION['userId'];
$Role = $_SESSION['nhanvien']['Role'];
$ProjectId = "";
$ProjectName = "";
$TaskList = [];

# Lấy danh sách công việc tùy thuộc vào có hay không project ID
if(isset($_REQUEST['projectId'])) {
  $ProjectId = $_REQUEST['projectId'];
  # Lấy lại thông tin tên project
  $ProjectName = getProjectNameById($ProjectId);
  # Form xử lý khi quản lý tạo task mới
  if(isset($_POST['submit'])) {
    $task = array(
      'title' => $_POST['title'],
      'description' => $_POST['description'],
      'createdAt' => date("Y-m-d"),
      'deadline' => $_POST['deadline'],
      'staff' => $_POST['staff'],
      'status' => $_POST['status'],
      'managerId' => $UserId,
      'projectId' => $ProjectId
    );

    createTask($task);

}


}
 # Nếu user là quản lý thì lấy danh sách tất cả công việc anh ấy quả lý 
 if($Role == 1) {
  $TaskList = getTaskListByManager($UserId,$ProjectId);

 }
# Nếu user là nhân viên thì lấy danh sách tất cả công việc trong project mà nhân viên đó tham gia
else {
  $TaskList = getTaskListByStaff($UserId, $ProjectId);
}

# Lấy thông tin danh sách mã nhân viên nếu user là quản lý
$StaffList = [];
$DepartmentId = $_SESSION['nhanvien']['MaPhongBan'];
if($Role == 1) {
  $StaffList = getStaffList($DepartmentId);
}
if(isset($_POST['search'])) {
  $term =  $_POST['term'];
  $TempList = [];
  foreach($TaskList as $task) {
    $isMatch = preg_match("/$term/i", $task['TenCongViec']);
    if($isMatch == 1) {
      array_push($TempList,$task);
    }
  }
  $TaskList = $TempList;
}


?>


<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="row card-header pb-0">
                <div class="col">
                    <h5><?php if(isset($ProjectName)) { echo $ProjectName;} else { echo 'Tất cả công việc';}?></h5>
                    <h6>Task List</h6>
                    <form role="form text-left" action="./index?page=task<?php if(isset($ProjectId)) {echo "&projectId=$ProjectId";}?>" method="post">
                    <div class="input-group">
                      <button class="input-group-text text-body" type="submit" name="search"><i class="fas fa-search" aria-hidden="true"></i></button>
                      <input type="text" class="form-control" name="term" placeholder="Tìm kiếm công việc..." value="">
                    </div>
                   </form>
                </div>
                <div class="col text-right" style="<?php if($Role == 0 || !isset($_REQUEST['projectId'])) {echo 'display: none';}?>">
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
               <select name="staff" class="select-staff" required>
                 <?php 
                     foreach($StaffList as $NV) {
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
                    foreach($TaskList as $task) {
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