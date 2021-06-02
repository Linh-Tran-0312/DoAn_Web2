<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="row card-header pb-0">
                <div class="col">
                    <h6>List tasks</h6>
                </div>
                <div class="col text-right">
                    <button type="button" class="btn btn-outline-primary" onclick="document.getElementById('id01').style.display='block'">Add new task</button>
               

                </div>
<!-- Add Task Modal -->
<div id="id01" class="w3-modal">
  <div class="w3-modal-content">
    <div class="w3-container">
      <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
      
      <form action="" method="post" class="form-modal" >
        <h3>Add  New Task</h3>
        <div class="form-modal-group-container">
          <div class="form-modal-group">
            <div class="form-modal-control">
              <p>Task Title </p>
              <input type="text" name="title" />
            </div>
            <div class="form-modal-control">
              <p>Description</p>
              <textarea cols="20" row="20" name="description"></textarea>
            </div>
            <div class="form-modal-control">
              <p>Status</p>
               <select name="status">
                 <option value="OPEN">NEW ISSUE</option>
                 <option value="INPROGRESS">IN PROGRESS</option>
                 <option value="COMPLETED">COMPLETED</option>
                 <option value="CLOSED">CLOSED</option>
                 <option value="CANCELED">CANCELED</option>
               </select>
            </div>
           </div>
           <div class="form-modal-group">
     
            <div class="form-modal-control">
              <p>Responsible</p>
               <select name="staff[]" multiple class="select-staff">
                 <option value="staff_id">Lê Văn Tám</option>
                 <option value="staff_id">Trịnh Văn Cấn</option>
                 <option value="staff_id">Bùi Thị Xuân</option>
                 <option value="staff_id">Hà Huy Giáp</option>
                 <option value="staff_id">Lê Quang Định</option>
                 <option value="staff_id">Nguyễn Ảnh Thủ</option>
                 <option value="staff_id">Lê Văn Tám</option>
                 <option value="staff_id">Trịnh Văn Cấn</option>
                 <option value="staff_id">Bùi Thị Xuân</option>
                 <option value="staff_id">Hà Huy Giáp</option>
                 <option value="staff_id">Lê Quang Định</option>
                 <option value="staff_id">Nguyễn Ảnh Thủ</option>
               </select>
            </div>
            <div class="form-modal-control">
              <p>Deadline</p>
              <input type="text" name="deadline" />
            </div>                        
           </div>
        </div>     
    
        <button class="btn btn-outline-primary btn-sm mb-0" type="submit" onclick="document.getElementById('id01').style.display='none'">ADD</button>
     
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Task Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Assignee</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Create Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Deadline</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Completion</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="./assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm rounded-circle me-2">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Spotify</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">Nam</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">22-05-2021</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">28-05-2021</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">working</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">60%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="./assets/img/small-logos/logo-invision.svg" class="avatar avatar-sm rounded-circle me-2">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Invision</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">Nam</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">22-05-2021</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">28-05-2021</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">done</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">100%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="./assets/img/small-logos/logo-jira.svg" class="avatar avatar-sm rounded-circle me-2">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Jira</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">Nam</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">22-05-2021</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">28-05-2021</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">canceled</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">30%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="30" style="width: 30%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="./assets/img/small-logos/logo-slack.svg" class="avatar avatar-sm rounded-circle me-2">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Slack</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">Nam</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">22-05-2021</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">28-05-2021</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">canceled</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">0%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width: 0%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="./assets/img/small-logos/logo-webdev.svg" class="avatar avatar-sm rounded-circle me-2">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Webdev</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">Nam</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">22-05-2021</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">28-05-2021</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">working</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">80%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="80" style="width: 80%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="./assets/img/small-logos/logo-xd.svg" class="avatar avatar-sm rounded-circle me-2">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Adobe XD</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">Nam</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">22-05-2021</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">28-05-2021</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">done</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">100%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
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