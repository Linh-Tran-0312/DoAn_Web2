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

function getProjectDetails($projectId) {
    global $connection;
    $projectInfo = "";
    $sql = "SELECT `project`.`TenProject`, `project`.`Summary`, `project`.`Status` FROM `project`  WHERE `project`.`MaProject`='$projectId'";
    $data = mysqli_query($connection, $sql);
    $num_rows = mysqli_num_rows($data);
    if($num_rows != 0) {
        while($info=mysqli_fetch_assoc($data)) {
            $projectInfo =$info;
        }
    }
  return $projectInfo;
}

function updateProjectStatus($projectId, $status) {
    global $connection;
    $sql = "UPDATE `project` SET `Status`='$status' WHERE `MaProject`='$projectId'"; 
    mysqli_query($connection, $sql);
}

function deleteProject($projectId) {
       global $connection;
       
       $sql = "DELETE FROM `congviec` WHERE `congviec`.`MaProject` = '$projectId'";
       mysqli_query($connection, $sql);
       $sql = "DELETE FROM `project` WHERE `project`.`MaProject` = '$projectId'";
       mysqli_query($connection, $sql);
     
}

function updateProject($project) {
     global $connection;
     $ProjectId = $project['id'];
     $Project_Name = $project['name'];
     $Project_Summary = $project['summary'];
     $Project_Status = $project['status'];

     $sql = "UPDATE `project` SET `TenProject`= '$Project_Name',`Summary`= '$Project_Summary',`Status`= '$Project_Status' WHERE `MaProject`='$ProjectId'";
     mysqli_query($connection, $sql);
}
?>