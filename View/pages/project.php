<?php 
if(!isset($_SESSION['isLogin']) || $_SESSION['isLogin'] == false) {
    header('Location: ../DAW2/index');
  }
require_once('./services/project.php');

$Role = $_SESSION['nhanvien']['Role'];
$MaNhanVien = $_SESSION['nhanvien']['MaNhanVien'];

 #Form xử lý khi quản lý tạo project mới
 if(isset($_POST['submit'])) {
    $project = array(
        'name' => $_POST['project_name'],
        'summary' => $_POST['project_summary'],
        'status' => $_POST['status'],
        'quanly' => $MaNhanVien
    ); 
    createProject($project);
};

$DS_Project = [];

# Nếu user là quản lý thì lấy danh sách tất cả project mà user quản lý
if($Role == 1) {
    $DS_Project = getProjectListByManager($MaNhanVien);

} 
# Nếu user là nhân viên thì lấy danh sách tất cả project mà nhân viên đó tham gia
else {
    $DS_Project = getProjectListByStaff($MaNhanVien);
}

?>




<div class="container-fluid py-4">
        <div class="col-12 mt-4">
            <div class="card mb-4">
                <div class="card-header pb-0 p-3">

                    <h6 class="mb-1">Danh sách các dự án</h6>                  
                </div>
                <div class="card-body p-3">
                    <div class="row">
                     <?php 
                      $num = 1;
                      foreach($DS_Project as $project) {
                          $ProjectId = $project['MaProject'];
                          $ProjectName = $project['TenProject'];
                          $Summary = $project['Summary'];
                          $Status = $project['Status'];
                          $Status_Change = '';
                          if($project['Status'] === "OPENING") {
                            $Status_Change = 'CLOSED';
                              $Status_Button = "<button class='btn btn-success py-2 mt-3' type='submit' name='submitStatus'>OPENING</button>";
                          } else {
                            $Status_Change = 'OPENING';
                            $Status_Button = "<button class='btn btn-primary py-2 mt-3'type='submit' name='submitStatus'>CLOSED</button>";
                          }
                          echo "
                        <div class='col-xl-3 col-md-4 mb-xl-0 mb-4'>
                        <div class='card card-blog card-plain'>
                            <div class='position-relative'>
                                <a class='d-block shadow-xl border-radius-xl'>
                                    <img src='./assets/img/project-img.jpg' alt='img-blur-shadow'
                                        class='img-fluid shadow border-radius-xl'>
                                </a>
                            </div>
                            <div class='card-body px-1 pb-0' style='height: 100%;display: flex; flex-direction: column-reverse; justify-content:space-between'>
                                <div>
                                    <p class='text-gradient text-dark mb-2 text-sm'>Project #$num</p>
                                    <a href='javascript:;'>
                                        <h5>
                                        $ProjectName
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
                                
                                    $Status_Button      
                                    
                                                                                                           
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
                 
                  <form action="./index?page=project" method="post" class="form-modal">
                    <h3>Create New Project</h3>
                    <div class="form-modal-control">
                      <p>Project Title </p>
                      <input type="text" name="project_name" required/>
                    </div>
                    <div class="form-modal-control">
                      <p>Summary </p>
                      <textarea cols="20" row="20" name="project_summary" required></textarea>
                    </div>
                    <div class="form-modal-control">
                      <p>Status</p>
                       <select name="status">
                         <option value="OPENING" selected>OPENING</option>                       
                       </select>
                    </div>
                    <div class="form-modal-control text-align-center  " >
                      <button class="btn btn-outline-primary btn-sm mb-0" name="submit" type="submit" onclick="document.getElementById('id01').style.display='none'">Create</button>
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