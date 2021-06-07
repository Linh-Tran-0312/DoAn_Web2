<?php 
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] == false) {
  header('Location: ../DAW2/index');
}

require_once('./services/task.php');

# Lấy thông tin nhân viên, phòng ban và vai trò từ session
 $UserId = $_SESSION['nhanvien']['MaNhanVien'];
 $Department = $_SESSION['nhanvien']['TenPhongBan'];
 $Role = $_SESSION['nhanvien']['Role'];
 $taskId = "";
 $ProjectName = "";
 $TaskTitle = "";
 $Status = "";
 $Description = "";
 $ManagerName = "";
 $StaffName = "";

#Lấy mã công việc từ url
if(isset($_REQUEST['taskId'])) {
  $taskId = $_REQUEST['taskId'];
}

#  Form xử lý người dùng update trạng thái công việc
if(isset($_POST['update_status'])) {

  $newStatus = $_POST['status'];  
   updateTaskStatus($taskId, $newStatus);

}
# Form xử lý người dùng chỉnh sửa công việc
if(isset($_POST['update_task'])) {

  $task = array(
    'id' => $taskId,
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'deadline' => $_POST['deadline']
  );

  updateTask($task);

}


# Lấy thông tin chi tiết công việc từ mã công việc
$Task = getTaskDetails($taskId);
$ProjectId = $Task['MaProject'];
$ProjectName = $Task['TenProject'];
$TaskTitle =$Task['TenCongViec'];
$task_status = $Task['Status'];
$Description =$Task['NoiDung'];
$ManagerName = $Task['TenQL'];
$StaffName = $Task['TenNV'];
$Deadline = $Task['Deadline'];

# Form xử lý khi người dùng xóa công việc
if(isset($_POST['delete_task'])) {
    
  deleteTask($taskId);
  header("Location: ../DAW2/index?page=task&projectId=$ProjectId");
}

# Dựa vào tình trạng công việc và vị trí hiển thị thanh trạng thái công việc và lời nhắn khác nhau
$Status_Button = "";
$Status_Message_QL = "";
$Status_Message_NV = "";

include('./View/includes/Status_Btn_Msg.php');

?>

      <div class="row mt-4 align-items-center">
        <div class="col-lg-12 mb-lg-0 mb-12">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">             
                <div class="col-lg-4 ms-auto text-center mt-5 mt-lg-0">
                  <div class="bg-gradient-primary border-radius-lg h-100">
                    <img src="./assets/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0  d-none" alt="waves">
                    <div class="position-relative d-flex align-items-center justify-content-center h-100">
                      <img class="w-100 position-relative z-index-2 pt-4" src="./assets/img/illustrations/rocket-white.png">
                    </div>
                  </div>
                </div>
                <div class="col-lg-7">
                  <div class="d-flex flex-column h-100">
                    <?php

                    echo "
                        <p class='mb-1 pt-2 text-bold'>Phòng $Department</p>
                        <h6 class='font-weight-bolder' style='color: blueviolet'>Dự Án: $ProjectName</h6>
                        <h2 class='font-weight-bolder'>$TaskTitle</h2>
                        "; ?>
                     
                        <div style="<?php if($Role == 0 ) {echo 'display: none';}?>" >
                          <button class='btn btn-outline-info' style='width: 130px' onclick="document.getElementById('id02').style.display='block'">Edit</button>
                          <button class='btn btn-outline-danger mx-3' style='width: 130px' onclick="document.getElementById('id03').style.display='block'">Delete</button>
                        </div>
                        <?php echo "
                        <br/>
                        <p class='mb-5 text-secondary'>$Description</p>
                        <h6 class=''>Deadline: <strong>$Deadline</strong></h6>
                        <h6 class=''>Phụ trách thực hiện: <strong>$StaffName</strong></h6>                       
                        <h6 class=''>Phụ trách kiểm soát: <strong>$ManagerName</strong></h6>
                        
                        <br/>  ";   
                  
                        ?>
           
                <h6 class="font-weight-bolder">Tình trạng công việc: &nbsp;</h6> 
                <div class="status-details">                       
                      <?php echo $Status_Button; ?>
                     <h6 class="mx-3 my-1 text-primary"><?php if($Role == 0) { echo $Status_Message_NV;} else { echo $Status_Message_QL; }?></h6> 
                 </div>
<!--   Modal for delete task details -->
           <div class="w3-container-details">           
                  <div id="id03" class="w3-modal-details">
                    <div class="w3-modal-content-details">
                      <div class="w3-container-details">
                        <span onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-display-topright-details">&times;</span>
                      <form action="./index?page=task-details&taskId=<?php echo $taskId ?>" method="post"class="form-modal-details">
                       <h3 class='text-secondary'>Xác nhận xóa công việc</h3> 
                       <br/>
                         <p class="text-danger">Bạn có chắc chắc muốn xóa công việc này</p>
                          <div style="width: 100%; text-align: center">
                          <button class="btn btn-danger btn-sm my-3" type="submit" name="delete_task" onclick="document.getElementById('id01').style.display='none'">Xác Nhận</button>
                          </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
<!--   //Modal for delete task details -->  

<!--   Modal for updating task details -->
           <div class="w3-container-details">           
                  <div id="id02" class="w3-modal-details">
                    <div class="w3-modal-content-details">
                      <div class="w3-container-details">
                        <span onclick="document.getElementById('id02').style.display='none'" class="w3-button w3-display-topright-details">&times;</span>
                      <form action="./index?page=task-details&taskId=<?php echo $taskId ?>" method="post"class="form-modal-details">
                       <h3 class='text-info'>Chỉnh sửa Công việc</h3> 
                          <label for="title">Tên Công Việc</label>
                          <input type='text' id="title"name="title" class="form-control" value='<?php echo $TaskTitle?>'/>
                          <label for="title">Nội Dung</label>
                          <textarea type='text' id="title"name="description" style="height: 150px"class="form-control"><?php echo $Description?></textarea>
                          <label >Deadline</label>
                          <input type='text' id="title"name="deadline"  value='<?php echo $Deadline?>'  class="form-control"/>
                          <div style="width: 100%; text-align: center">
                          <button class="btn btn-info btn-sm my-3" type="submit" name="update_task" onclick="document.getElementById('id01').style.display='none'">Thực Hiện</button>
                          </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
    <!--   //Modal for updating task details -->   
    
    <!--   Modal for updating task state -->
                <div class="w3-container-details">           
                  <div id="id01" class="w3-modal-details">
                    <div class="w3-modal-content-details">
                      <div class="w3-container-details">
                        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright-details">&times;</span>
                      <form action="./index?page=task-details&taskId=<?php echo $taskId ?>" method="post"class="form-modal-details">
                       <h3 class='text-primary'>Cập nhật tiến độ</h3> 
                        <select name="status" class="my-2 form-control">
                           <?php include('./View/includes/UpdateTaskSelect.php') ?>
                        </select>
                        <div style="width: 100%; text-align: center">
                        <button class="btn btn-outline-primary btn-sm my-3" type="submit" name="update_status" onclick="document.getElementById('id01').style.display='none'">Cập Nhật</button>
                        </div>
                      </form>
                      </div>
                    </div>
                  </div>
                </div>
    <!--   //Modal for updating task state -->   
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>