<?php
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] == false) {
  header('Location: ../DAW2/index');
}

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
 

  # Form xử lý khi quản lý tạo task mới
  if(isset($_POST['add_task'])) {
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
 # Form xử lý xóa project
  if(isset($_POST['delete_project'])) {

    deleteProject($ProjectId);
    header("Location: ../DAW2/index.php?page=project");
  }
# Form xử lý update project
if(isset($_POST['update_project'])) {

   $project = array(
     'id' => $ProjectId,
     'name' => $_POST['name'],
     'summary' => $_POST['summary'],
     'status' => $_POST['status']
   );
   updateProject($project);

}
 # Lấy lại thông tin tên project
 $ProjectInfo = getProjectDetails($ProjectId);
 if($ProjectInfo['Status'] === "OPENING") {
  $Status_Change = 'CLOSED';
   $Status_Button_Project = "<button class='btn btn-success py-2 mt-3' type='submit' name='submitStatus'>OPENING</button>";
} else {
 $Status_Change = 'OPENING';
 $Status_Button_Project = "<button class='btn btn-primary py-2 mt-3'type='submit' name='submitStatus'>CLOSED</button>";
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
# Form xử lý khi người dùng tìm kiếm thông tin về công việc bao gồm : tên công việc, tên dự án, người thực hiện hoặc quản lý, tình trạng
if(isset($_POST['term'])) {
  $term =  $_POST['term'];
  $stt = $_POST['status'];
  $TempList = [];
  if($stt != ""){
    foreach($TaskList as $task) {  
      $isMatch = preg_match("/$stt/i", $task['Status']);
      if($isMatch > 0) {
        array_push($TempList,$task);
      }
    }
  }
  else {
    foreach($TaskList as $task) { 
      $isMatch = preg_match("/$term/i", $task['TenCongViec']);
      $isMatch += preg_match("/$term/i", $task['TenProject']);
      $isMatch += preg_match("/$term/i", $task['TenNhanVien']);
      $isMatch += preg_match("/$term/i", $task['NgayTao']);
      $isMatch += preg_match("/$term/i", $task['Deadline']);      
      if($isMatch > 0) {
        array_push($TempList,$task);
      }
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
                    <h4><?php if(isset($ProjectInfo)) { echo $ProjectInfo['TenProject'];} else { echo 'Tất cả công việc';}?></h4>
                    <p><?php if(isset($ProjectInfo)) { echo $ProjectInfo['Summary'];} else { echo '';}?> </p>
                     <?php if(isset($ProjectInfo)) echo $Status_Button_Project ?>
                    <h6>Danh sách công việc</h6>
                    <form   style='display: flex; flex-direction: row; width: 500px' action="./index?page=task<?php if(isset($ProjectId) && $ProjectId != "") {echo "&projectId=$ProjectId";}?>" method="post">
                    <div class="input-group" style="width: 500px !important;">
                      <button class="input-group-text text-body" type="submit" name="search"><i class="fas fa-search" aria-hidden="true"></i></button>
                      <input type="text" class="form-control"  name="term" placeholder="Tìm kiếm công việc..." value="">                     
                    </div>
                
                    <select class='form-control' name="status" style='width: 200px; margin-left: 20px' onchange="javascipt:this.form.submit();" >
                       <option value="">ALL STATUS</option>
                       <option value="NEW ISSUE">NEW ISSUE</option>
                       <option value="IN PROGRESS">IN PROGRESS</option>
                       <option value="IN REVIEW">IN REVIEW</option>
                       <option value="COMPLETED">COMPLETED</option>
                       <option value="CLOSED">CLOSED</option>
                       <option value="CANCELED">CANCELED</option>
                    </select>
                   </form>
                </div>
                <div class="col" style="<?php if($Role == 0 || !isset($_REQUEST['projectId'])) {echo 'display: none';}?>">
                    <button type="button" class='btn btn-secondary mx-3' onclick="document.getElementById('id02').style.display='block'">Update</button>                   
                    <button type="button" class="btn btn-primary mx-3" onclick="document.getElementById('id01').style.display='block'">Add task</button>            
                    <button type="button" class='btn btn-danger mx-3' onclick="document.getElementById('id03').style.display='block'">Delete</button>
                </div> 
                <div class="card-body px-0 pt-2 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tên Công Việc</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><?php if($Role == 0) {echo 'Quản Lý';} else { echo 'Phụ Trách'; }?></th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"><?php if(isset($ProjectId) && $ProjectId != "") {echo 'Ngày Tạo';} else { echo 'Dự Án'; }?></th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deadline</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Trạng Thái</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Nội Dung</th>
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
                      $task_status = $task['Status'];
                      $phutrachORproject = "";
                      if(isset($ProjectId) && $ProjectId != "" ) {
                        $ngaytaoORproject = $task['NgayTao'];
                      } else {
                        $ngaytaoORproject = $task['TenProject'];
                        
                      }
                      $Status_View = "";
                      include('./View/includes/Status_Btn_Msg.php');
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
                        <p class='text-sm font-weight-bold mb-0'>$ngaytaoORproject</p>
                      </td>
                      <td>
                        <p class='text-sm font-weight-bold mb-0'>$deadline</p>
                      </td>
                      <td>
                        <span class='text-xs font-weight-bold'>$Status_View</span>
                      </td>
                      <td class='align-middle text-center'>
                        <div class='d-flex align-items-center justify-content-center'>
                        <a href='./index?page=task-details&taskId=$taskId' >
                        <div class='btn btn-outline-info'>Chi tiết</div>
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

<!-- Update Project Modal -->
<div id="id02" class="w3-modal-task">
  <div class="w3-modal-content-task">
    <div class="w3-container-task">
      <span onclick="document.getElementById('id02').style.display='none'" class="w3-button-task w3-display-topright-task">&times;</span>    
      <form action="./index?page=task&projectId=<?php echo $ProjectId?>" method="post" class="form-modal-task" >
        <h3 class="text-secondary" >Cập nhật thông tin Dự Án</h3>       
          <div class="form-modal-group-task">
            <div class="form-modal-control-task">
              <p>Tên Dự Án</p>
              <input type="text" name="name" value='<?php if(isset($ProjectInfo)) echo $ProjectInfo['TenProject'];?>'/>
            </div>
            <div class="form-modal-control-task">
              <p>Mô tả Dự Án</p>
              <textarea cols="20" row="20" name="summary"><?php if(isset($ProjectInfo)) echo $ProjectInfo['Summary'];?></textarea>
            </div>
            <div class="form-modal-control-task">
              <p>Trạng Thái</p>
               <select name="status" value=<?php if(isset($ProjectInfo)) echo $ProjectInfo['Status'];?>>
                 <option value="OPENING" >OPENING</option>
                 <option value="CLOSED" >CLOSED</option>
               </select>
            </div>         
        </div>        
        <button class="btn btn-secondary btn-sm mb-0" type="submit" name="update_project" onclick="document.getElementById('id01').style.display='none'">CẬP NHẬT</button>   
      </form>
    </div>
  </div>
</div>
<!-- //Update Project Modal -->
<!-- Add Task Modal -->
<div id="id01" class="w3-modal-task">
  <div class="w3-modal-content-task">
    <div class="w3-container-task">
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-button-task w3-display-topright-task">&times;</span>
      
      <form action="./index?page=task&projectId=<?php echo $ProjectId?>" method="post" class="form-modal-task" >
        <h3 class="text-primary" >Thêm Công Việc Mới</h3>
        <div class="form-modal-group-container-task">
          <div class="form-modal-group-task">
            <div class="form-modal-control-task">
              <p>Tiêu Đề </p>
              <input type="text" name="title" />
            </div>
            <div class="form-modal-control-task">
              <p>Mô Tả</p>
              <textarea cols="20" row="20" style="height: 115px"name="description"></textarea>
            </div>  
           </div>
           <div class="form-modal-group-task">     
           <div class="form-modal-control-task">
              <p>Tình Trạng</p>
               <select name="status">
                 <option value="NEW ISSUE" selected>NEW ISSUE</option>
               </select>
            </div>
            <div class="form-modal-control-task">
              <p>Phụ Trách</p>
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
        <button class="btn btn-primary btn-sm mb-0" type="submit" name="add_task" onclick="document.getElementById('id01').style.display='none'">THÊM</button>   
      </form>
    </div>
  </div>
</div>
<!-- //Add Task Modal -->
<!-- Delete Project Modal -->
<div id="id03" class="w3-modal-task">
  <div class="w3-modal-content-task">
    <div class="w3-container-task">
      <span onclick="document.getElementById('id03').style.display='none'" class="w3-button-task w3-display-topright-task">&times;</span>    
      <form action="./index?page=task&projectId=<?php echo $ProjectId?>" method="post" class="form-modal-task" >
        <h3 class="text-danger" >Xác nhận xóa dự án</h3>       
          <div class="form-modal-group-task">
            <h6 class="text-primary">Bạn có chắc chắn muốn xóa dự án này, các công việc liên quan của dự án cũng sẽ bị xóa !</h6>         
        </div>        
        <button class="btn btn-danger btn-sm mb-0" type="submit" name="delete_project" onclick="document.getElementById('id01').style.display='none'">XÁC NHẬN</button>   
      </form>
    </div>
  </div>
</div>
<!-- //Delete Project Modal -->


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