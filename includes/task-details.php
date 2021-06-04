<?php 
# Kết nối database
require_once('./services/connectionSQL.php');
# Lấy thông tin nhân viên, phòng ban và vai trò từ session
 $MaNhanVien = $_SESSION['nhanvien']['MaNhanVien'];
 $PhongBan = $_SESSION['nhanvien']['TenPhongBan'];
 $Role = $_SESSION['nhanvien']['Role'];
 $taskId = "";
 $TenProject = "";
 $TenCongViec = "";
 $Status = "";
 $NoiDung = "";
 $QL = "";
 $NV = "";

#Lấy thông tin chi tiết công việc từ database dựa vào mã công việc
if(isset($_REQUEST['taskId'])) {
  $taskId = $_REQUEST['taskId'];
}

#  Form xử lý user update trạng thái công việc
if(isset($_POST['submit'])) {

  $newStatus = $_POST['status'];  
  $sql = "UPDATE `congviec` SET `Status`='$newStatus' WHERE `MaCongViec`='$taskId'";
  
  mysqli_query($connection, $sql);

}

$sql = "SELECT `project`.`TenProject`, `congviec`.`TenCongViec`, `congviec`.`Status`, `congviec`.`NoiDung`, `QL`.`TenNhanVien` AS `TenQL`, `NV`.`TenNhanVien` AS `TenNV` FROM `congviec` JOIN `project` ON `congviec`.`MaProject`=`project`.`MaProject` JOIN `nhanvien` AS `QL` ON `QL`.`MaNhanVien`=`congviec`.`MaQuanLy` JOIN `nhanvien` AS `NV` ON `congviec`.`PhuTrach` = `NV`.`MaNhanVien` WHERE `congviec`.`MaCongViec`='$taskId'";
$data = mysqli_query($connection, $sql);
$num_rows = mysqli_num_rows($data);
if($num_rows != 0) {
    while($task=mysqli_fetch_assoc($data)) {
      
        $TenProject = $task['TenProject'];
        $TenCongViec =$task['TenCongViec'];
        $Status = $task['Status'];
        $NoiDung =$task['NoiDung'];
        $QL = $task['TenQL'];
        $NV = $task['TenNV'];
    }
}  
# Dựa vào tình trạng công việc và vị trí hiển thị thanh trạng thái công việc và lời nhắn khác nhau
$Status_Button = "";
$Status_Message_QL = "";
$Status_Message_NV = "";
switch($Status) {
  case "NEW ISSUE":
    $Status_Button =  "<button class='btn btn-secondary mx-1' onclick='document.getElementById(\"id01\").style.display=\"block\"'>NEW ISSUE</button>";
    $Status_Message_QL = "Đang chờ nhân viên của bạn phản hồi.";
    $Status_Message_NV = "Quản lý của bạn vừa giao cho bạn nhiệm vụ mới, hãy phản hồi để quản lý biết nhé.";
    break;
  case "IN PROGRESS":
    $Status_Button = "<div class='btn btn-warning mx-1' onclick='document.getElementById(\"id01\").style.display=\"block\"'>IN PROGRESS</div>";
    $Status_Message_QL = "Nhân viên của bạn đang thực hiện nhiên vụ.";
    $Status_Message_NV = "Hãy cố gắng hoàn thành nhiệm vụ trước deadline nhé.";
    break;
  case "COMPLETED":
    $Status_Button =  "<div class='btn btn-success mx-1' onclick='document.getElementById(\"id01\").style.display=\"block\"'>COMPLETED</div>";
    $Status_Message_QL = "Nhân viên của bạn đã hoàn thành nhiệm vụ này";
    $Status_Message_NV = "Bạn đã hoàn thành nhiệm vụ này";
    break;
  case "IN REVIEW":
    $Status_Button =  "<div class='btn btn-info mx-1' onclick='document.getElementById(\"id01\").style.display=\"block\"'>IN REVIEW</div>";
    $Status_Message_QL = "Nhân viên bạn đã hoàn thành và đang chờ bạn duyệt hoàn thành.";
    $Status_Message_NV = "Hãy chờ quản lý của bạn duyệt hoàn thành nhiệm vụ nhé.";
    break;
  case "CLOSED":
    $Status_Button =  "<div class='btn btn-primary mx-1' onclick='document.getElementById(\"id01\").style.display=\"block\"'>CLOSED</div>";
    $Status_Message_QL = "Nhiệm vụ đã hoàn thành và đóng lại";
    $Status_Message_NV = "Nhiệm vụ đã hoàn thành và đóng lại";
    break;
  case "CANCELED":
    $Status_Button =  "<div class='btn btn-dark mx-1' onclick='document.getElementById(\"id01\").style.display=\"block\"'>CANCELED</div>";
    $Status_Message_QL = "Nhiệm vụ đã được hủy";
    $Status_Message_NV = "Nhiệm vụ đã được hủy";
    break;
  default:
  $Status_Button = "";
  }


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
                        <p class='mb-1 pt-2 text-bold'>Phòng $PhongBan</p>
                        <h2 class='font-weight-bolder' style='color: blueviolet'>Dự Án: $TenProject</h2>
                        <h5 class='font-weight-bolder'>Công Việc: $TenCongViec</h5>
                        <p class='mb-5'>$NoiDung</p>
                        <h6 class='font-weight-bolder'>Phụ trách thực hiện: $NV</h6>
                        
                        <h6 class='font-weight-bolder'>Phụ trách kiểm soát: $QL</h6>
                        
                        <br/>  ";   
                  
                        ?>
                <!--   Modal for updating task state -->
                <h5 class="font-weight-bolder">Tình trạng công việc: &nbsp;</h5> 
                <div class="status-details">
                        
                      <?php echo $Status_Button; ?>
                      <?php if($Role == 0) { echo $Status_Message_NV;} else { echo $Status_Message_QL; }?>
                 </div>
                <div class="w3-container-details">
                 
                  <div id="id01" class="w3-modal-details">
                    <div class="w3-modal-content-details">
                      <div class="w3-container-details">
                        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright-details">&times;</span>
                      <form action="./index?page=task-details&taskId=<?php echo $taskId ?>" method="post"class="form-modal-details">
                       <h3>Update your task status</h3> 
                        <select name="status" class="my-2">
                           <?php include('UpdateTaskSelect.php') ?>
                        </select>
                        <button class="btn btn-outline-primary btn-sm my-3" type="submit" name="submit" onclick="document.getElementById('id01').style.display='none'">Apply</button>

                      </form>
                      </div>
                    </div>
                  </div>
                </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>