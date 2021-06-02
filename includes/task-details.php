
      <div class="row mt-4 align-items-center">
        <div class="col-lg-12 mb-lg-0 mb-12">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">             
                <div class="col-lg-4 ms-auto text-center mt-5 mt-lg-0">
                  <div class="bg-gradient-primary border-radius-lg h-100">
                    <img src="./assets/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                    <div class="position-relative d-flex align-items-center justify-content-center h-100">
                      <img class="w-100 position-relative z-index-2 pt-4" src="./assets/img/illustrations/rocket-white.png">
                    </div>
                  </div>
                </div>
                <div class="col-lg-7">
                  <div class="d-flex flex-column h-100">
                    <p class="mb-1 pt-2 text-bold">Phòng Ban</p>
                    <h2 class="font-weight-bolder">Dự Án: Tên dự án</h2>
                    <h4 class="font-weight-bolder">Công Việc: Tên công việc</h4>
                    <p class="mb-5">Nội dung công việc.Nội dung công việc. Nội dung công việc. Nội dung công việc. Nội dung công việc. Nội dung công việc. Nội dung công việc. Nội dung công việc</p>
                    <h5 class="font-weight-bolder">Thành viên tham gia: </h5>
                    <div class="staff-table">
                       <div class="name-staff">Trần Văn Hùng</div>
                       <div class="name-staff">Lê Hương Thảo</div>
                       <div class="name-staff">Nguyễn  Quỳnh Phúc Anh</div>
                       <div class="name-staff">Thái Tấn Toàn</div>
                       <div class="name-staff">Lý Phúc Hưng</div>
                       <div class="name-staff">Hồ Văn Trác</div>        
                    </div>   
                    <br/>   
                    <div class="status">
                      <h5 class="font-weight-bolder">Tình trạng công việc: &nbsp;</h5>    
                      <div class="btn btn-secondary mx-1" onclick="document.getElementById('id01').style.display='block'">NEW ISSUE</div>
                      <div class="btn btn-warning mx-1" onclick="document.getElementById('id01').style.display='block'">IN PROGRESS</div>
                      <div class="btn btn-success mx-1" onclick="document.getElementById('id01').style.display='block'">COMPLETED</div>
                      <div class="btn btn-info mx-1" onclick="document.getElementById('id01').style.display='block'">WAITING ACCEPT</div>
                      <div class="btn btn-primary mx-1" onclick="document.getElementById('id01').style.display='block'">CLOSED</div>
                      <div class="btn btn-dark mx-1" onclick="document.getElementById('id01').style.display='block'">CANCELD</div>
                    </div>
                <!--   Modal for updating task state -->


                <div class="w3-container">
                 
                  <div id="id01" class="w3-modal">
                    <div class="w3-modal-content">
                      <div class="w3-container">
                        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                      <form class="form-modal">
                       <h3>Update your task status</h3> 
                        <select name="status" class="my-2">
                          <option value="OPEN">NEW ISSUE</option>
                          <option value="INPROGRESS">IN PROGRESS</option>
                          <option value="COMPLETED">COMPLETED</option>
                          <option value="SUBMIT">SUBMIT COMPLETION</option>
                          <option value="CLOSED">CLOSED</option>
                          <option value="CANCELED">CANCELED</option>
                        </select>
                        <button class="btn btn-outline-primary btn-sm my-3" type="submit" onclick="document.getElementById('id01').style.display='none'">Apply</button>

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