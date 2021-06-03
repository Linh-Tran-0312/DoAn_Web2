<?php 

require_once('./services/connectionSQL.php');

$Role = $_SESSION['nhanvien']['Role'];
$MaNhanVien = $_SESSION['nhanvien']['MaNhanVien'];
$DS_Project = [];

if($Role == 1) {
$sql="SELECT `project`.`TenProject`,`project`.`MaProject`, `project`.`Summary`, `project`.`Status` FROM `project` WHERE `MaQuanLy`='$MaNhanVien'";
$data = mysqli_query($connection, $sql);
$num_rows = mysqli_num_rows($data);
if($num_rows != 0) {
    while($project=mysqli_fetch_assoc($data)) {
        array_push($DS_Project, $project);
    }
}

} else {

    $sql = "SELECT `project`.`TenProject`,`project`.`MaProject`, `project`.`Summary`, `project`.`Status` FROM `project` JOIN `congviec` ON `project`.`MaProject`=`congviec`.`MaProject` JOIN `phancong` ON `phancong`.`MaCongViec`=`congviec`.`MaCongViec` WHERE `phancong` .`MaNhanVien`='$MaNhanVien' GROUP BY `project`.`TenProject`";
    $data = mysqli_query($connection, $sql);
$num_rows = mysqli_num_rows($data);
if($num_rows != 0) {
    while($project=mysqli_fetch_assoc($data)) {
        array_push($DS_Project, $project);
    }
}
}

 


?>




<div class="container-fluid py-4">
        <div class="col-12 mt-4">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-1">Projects</h6>
                    <p class="text-sm">Danh sách dự mà bạn đang tham gia hoặc quản lý</p>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                     <?php 
                      $num = 1;
                      foreach($DS_Project as $project) {
                          $ProjectId = $project['MaProject'];
                          $Ten = $project['TenProject'];
                          $Summary = $project['Summary'];
                          if($project['Status'] === "OPENING") {
                              $Status = "<div class='btn btn-success py-2 mt-3'>OPENING</div>";
                          } else {
                            $Status = "<div class='btn btn-primary py-2 mt-3'>CLOSED</div>";
                          }
                          echo "
                        <div class='col-xl-3 col-md-4 mb-xl-0 mb-4'>
                        <div class='card card-blog card-plain'>
                            <div class='position-relative'>
                                <a class='d-block shadow-xl border-radius-xl'>
                                    <img src='./assets/img/home-decor-3.jpg' alt='img-blur-shadow'
                                        class='img-fluid shadow border-radius-xl'>
                                </a>
                            </div>
                            <div class='card-body px-1 pb-0'>
                                <div>
                                    <p class='text-gradient text-dark mb-2 text-sm'>Project #$num</p>
                                    <a href='javascript:;'>
                                        <h5>
                                        $Ten
                                        </h5>
                                    </a>
                                    <p class='mb-4 text-sm'>
                                        $Summary
                                    </p>
                                </div>                            
                                <div class='d-flex align-items-center justify-content-between'>
                                    <a href='./index?page=task&projectId=$ProjectId' >
                                        <button type='submit' class='btn btn-outline-primary btn-sm mb-0'>View Project</button>
                                    </a> 
                                      $Status                                                                            
                                </div>
                            </div>
                        </div>
                    </div>";
                    $num= $num + 1;  
                      }  
                                  
                    ?>
                        <div class="col-xl-3 col-md-4 mb-xl-0 mb-4" style="<?php if($Role == 0) echo 'display: none'?>" >
                            <div class="card h-100 card-plain border">
                                <div class="card-body d-flex flex-column justify-content-center text-center">
                                    <a href="javascript:;" onclick="document.getElementById('id01').style.display='block'">
                                        <i class="fa fa-plus text-secondary mb-3"></i>
                                        <h5 class=" text-secondary"> New project </h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
 <!-- Project Modal -->
            <div id="id01" class="w3-modal">
              <div class="w3-modal-content">
                <div class="w3-container">
                  <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                 
                  <form action="" method="post" class="form-modal">
                    <h3>Create New Project</h3>
                    <div class="form-modal-control">
                      <p>Project Title </p>
                      <input type="text" name="project_name" />
                    </div>
                    <div class="form-modal-control">
                      <p>Summary </p>
                      <textarea cols="20" row="20" name="project_summary"></textarea>
                    </div>
                    <div class="form-modal-control">
                      <p>Status</p>
                       <select name="status">
                         <option value="OPENING" selected>OPENING</option>
                        
                       </select>
                    </div>
                    <div class="form-modal-control text-align-center  " >
                      <button class="btn btn-outline-primary btn-sm mb-0" type="submit" onclick="document.getElementById('id01').style.display='none'">Create</button>
                    </div>
                                       
                  </form>
                </div>
              </div>
            </div>
<!-- //Project Modal -->
        </div>
        <footer class="footer pt-3">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-left">
                            ©
                            <script>
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
                                <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative
                                    Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                    target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="http://blog.creative-tim.com" class="nav-link text-muted" target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                    target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>