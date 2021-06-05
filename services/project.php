<?php 
 require_once('./services/connectionSQL.php');  

 function createProject($project) {
     global $connection;

    $MaNhanVien = $project['quanly'];
    $Project_Name = $project['name'];
    $Project_Summary = $project['summary'];
    $Project_Status = $project['status'];

    $sql = "INSERT INTO `project`( `MaQuanLy`, `TenProject`, `Summary`, `Status`) VALUES ('$MaNhanVien','$Project_Name','$Project_Summary','$Project_Status')";
    
    mysqli_query($connection, $sql);
 }

function getProjectListByManager($userId) {
    global $connection;
    $list = [];
    $sql="SELECT `project`.`TenProject`,`project`.`MaProject`, `project`.`Summary`, `project`.`Status` FROM `project` WHERE `MaQuanLy`='$userId'";
    $data = mysqli_query($connection, $sql);
    $num_rows = mysqli_num_rows($data);
    if($num_rows != 0) {
    while($project=mysqli_fetch_assoc($data)) {
        array_push($list, $project);
        }
    }
    return $list;
}

function getProjectListByStaff($userId) {
    global $connection;
    $list = [];
    $sql = "SELECT `project`.`TenProject`,`project`.`MaProject`, `project`.`Summary`, `project`.`Status` FROM `project` JOIN `congviec` ON `project`.`MaProject`=`congviec`.`MaProject` WHERE `congviec`.`PhuTrach`='$userId' GROUP BY `project`.`TenProject`";
    $data = mysqli_query($connection, $sql);
    $num_rows = mysqli_num_rows($data);
    if($num_rows != 0) {
    while($project=mysqli_fetch_assoc($data)) {
        array_push($list, $project);
        }
    }
    return $list;
}

function getProjectNameById($projectId) {
    global $connection;
    $Name = "";
    $sql = "SELECT `project`.`TenProject` FROM `project`  WHERE `project`.`MaProject`='$projectId'";
    $data = mysqli_query($connection, $sql);
    $num_rows = mysqli_num_rows($data);
    if($num_rows != 0) {
        while($task=mysqli_fetch_assoc($data)) {
            $Name = $task['TenProject'];
        }
    }
  return $Name;
}

function updateProjectStatus($projectId, $status) {
    global $connection;
    $sql = "UPDATE `project` SET `Status`='$status' WHERE `MaProject`='$projectId'"; 
    mysqli_query($connection, $sql);
}

?>