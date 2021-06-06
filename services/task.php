<?php 
 require_once('./services/connectionSQL.php');  

 function getTaskListByManager($userId,$projectId) {
     global $connection;
     $TaskList = [];
     if($projectId == "" ) {
        $sql = "SELECT `project`.`TenProject`,`congviec`.`MaCongViec`, `congviec`.`TenCongViec`, `congviec`.`NgayTao`,`congviec`.`Deadline`, `congviec`.`Status`, `nhanvien`.`TenNhanVien`  FROM `congviec` JOIN `nhanvien` ON `congviec`.`PhuTrach`=`nhanvien`.`MaNhanVien` JOIN `project` ON `congviec`.`MaProject`=`project`.`MaProject` WHERE `congviec`.`MaQuanLy`='$userId'";  
     } else {
        $sql = "SELECT `project`.`TenProject`,`congviec`.`MaCongViec`, `congviec`.`TenCongViec`, `congviec`.`NgayTao`,`congviec`.`Deadline`, `congviec`.`Status`, `nhanvien`.`TenNhanVien`  FROM `congviec` JOIN `nhanvien` ON `congviec`.`PhuTrach`=`nhanvien`.`MaNhanVien` JOIN `project` ON `congviec`.`MaProject`=`project`.`MaProject` WHERE `congviec`.`MaProject`='$projectId'";  
     }
    $data = mysqli_query($connection, $sql);
    $num_rows = mysqli_num_rows($data);
    if($num_rows != 0) {
        while($task=mysqli_fetch_assoc($data)) {
            array_push($TaskList, $task);
        }
    }
    return $TaskList;
 }
function getTaskListByStaff($userId, $projectId) {
        global $connection;
        $TaskList = [];
        if($projectId == "" ) {
            $sql = "SELECT `project`.`TenProject`,`congviec`.`MaCongViec`, `congviec`.`TenCongViec`, `congviec`.`NgayTao`,`congviec`.`Deadline`, `congviec`.`Status`, `nhanvien`.`TenNhanVien`  FROM `congviec` JOIN `nhanvien` ON `congviec`.`MaQuanLy`=`nhanvien`.`MaNhanVien` JOIN `project` ON `congviec`.`MaProject`=`project`.`MaProject` WHERE  `congviec`.`PhuTrach`='$userId'";
         } else {
            $sql = "SELECT `project`.`TenProject`,`congviec`.`MaCongViec`, `congviec`.`TenCongViec`, `congviec`.`NgayTao`,`congviec`.`Deadline`, `congviec`.`Status`, `nhanvien`.`TenNhanVien`  FROM `congviec` JOIN `nhanvien` ON `congviec`.`MaQuanLy`=`nhanvien`.`MaNhanVien` JOIN `project` ON `congviec`.`MaProject`=`project`.`MaProject` WHERE `congviec`.`MaProject`='$projectId' AND `congviec`.`PhuTrach`='$userId'";
        }
        $data = mysqli_query($connection, $sql);
        $num_rows = mysqli_num_rows($data);
        if($num_rows != 0) {
            while($task=mysqli_fetch_assoc($data)) {           
            array_push($TaskList, $task);
          }
        }
        return $TaskList;
    }
function createTask($task) {
    global $connection;
    $Title = $task['title'];
    $Description = $task['description'];
    $CreatedAt = $task['createdAt'];
    $Deadline = $task['deadline'];
    $Staff = $task['staff'];
    $Status = $task['status'];
    $ProjectId = $task['projectId'];
    $ManagerId = $task['managerId'];

    $sql = "INSERT INTO `congviec`(`TenCongViec`, `NoiDung`, `NgayTao`, `Deadline` ,`PhuTrach`,`Status`,`MaProject`,`MaQuanLy`) VALUES ('$Title','$Description','$CreatedAt','$Deadline','$Staff','$Status', '$ProjectId','$ManagerId')";
    mysqli_query($connection, $sql);
}
function updateTask($task) {
    global $connection;
    $taskId = $task['id'];
    $taskTitle = $task['title'];
    $taskDesc = $task['description'];
    $taskDeadline = $task['deadline'];

    $sql = "UPDATE `congviec` SET `TenCongViec`='$taskTitle', `NoiDung`='$taskDesc',`Deadline`='$taskDeadline' WHERE `MaCongViec`='$taskId'";
    mysqli_query($connection,$sql);
}

function deleteTask($taskId) {
    global $connection;

    $sql = "DELETE FROM `congviec` WHERE `MaCongViec`='$taskId'";
    mysqli_query($connection,$sql);
}
function getTaskDetails($taskId) {
    global $connection;
    $Details = [];
    $sql = "SELECT `project`.`TenProject`,`project`.`MaProject`, `congviec`.`TenCongViec`, `congviec`.`Deadline`, `congviec`.`Status`, `congviec`.`NoiDung`, `QL`.`TenNhanVien` AS `TenQL`, `NV`.`TenNhanVien` AS `TenNV` FROM `congviec` JOIN `project` ON `congviec`.`MaProject`=`project`.`MaProject` JOIN `nhanvien` AS `QL` ON `QL`.`MaNhanVien`=`congviec`.`MaQuanLy` JOIN `nhanvien` AS `NV` ON `congviec`.`PhuTrach` = `NV`.`MaNhanVien` WHERE `congviec`.`MaCongViec`='$taskId'";
    $data = mysqli_query($connection, $sql);
    $num_rows = mysqli_num_rows($data);
    if($num_rows != 0) {
    while($task=mysqli_fetch_assoc($data)) {       
        $Details = $task;
     }
    } 
    return $Details;
}
function updateTaskStatus($taskId, $status) {
    global $connection;

    $sql = "UPDATE `congviec` SET `Status`='$status' WHERE `MaCongViec`='$taskId'"; 
    mysqli_query($connection, $sql);

}

?>