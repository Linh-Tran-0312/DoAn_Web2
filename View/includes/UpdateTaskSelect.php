<?php 
if($Role == 1) {
 # Đối với quản lý
 switch($task_status) {
     # Nếu tình trạng công việc là NEW ISSUE thì chỉ có thể giữ nguyên chờ nhân viên phản hồi hoặc hủy công việc
     case 'NEW ISSUE':
        echo " <option value='NEW ISSUE' selected>NEW ISSUE</option>
               <option value='CANCELED'>CANCELED</option>";
        break;
     # Nếu tình trạng công việc đang In PROGRESS thì chỉ có thể giữ nguyên chờ nhân viên hoàn thành hoặc hủy công việc
    case "IN PROGRESS":
        echo " <option value='IN PROGRESS' selected>IN PROGRESS</option>
               <option value='CANCELED'>CANCELED</option>";
        break;
     # Nếu tình trạng công việc đang IN REVIEW có nghĩa là nhân viên đã hoàn thành và chờ bạn duyệt, bạn có thể dồng ý COMPLETED
     # hoặc nếu công việc chưa đạt yêu cầu thì bắt nhân viên làm lại DO AGAIN, hoặc hủy công việc
     case "IN REVIEW":
        echo " <option value='IN REVIEW' disabled>IN REVIEW</option>
               <option value='IN PROGRESS'>DO AGAIN</option>
               <option value='COMPLETED'>COMPLETED</option>
               <option value='CANCELED'>CANCELED</option>";
        break;
     # Nếu tình trạng công việc là COMPLETED thì bạn có thể đóng công việc này lại hoặc hủy
    case "COMPLETED":
        echo "  <option value='COMPLETED' selected>COMPLETED</option>
                <option value='CLOSED'>CLOSED</option>";
        break;
    # Nếu tình trạng là CLOSED thì bạn có thể giữ nguyên hoặc hủy công việc
    case "CLOSED":
        echo "  <option value='CLOSED' selected>CLOSED</option>
                <option value='CANCELED'>CANCELED</option>";
        break;
    default :
        echo " <option value='CANCELED' selected>CANCELED</option>";  
 }
} else {
    # Đối với Nhân viên
    switch($task_status) {
        # Nếu tình trạng là NEW ISSUE nghĩa là sếp bạn vừa giao việc và có thể để đó hoặc phản hồi đồng ý thực hiện để quản lý bạn biết và theo dõi
        case 'NEW ISSUE':
           echo " <option value='NEW ISSUE' selected>NEW ISSUE</option>
                  <option value='IN PROGRESS'>ACCEPT</option>";
           break;
        # Nếu tình trang đang là IN PROGRESS và bạn đã hoàn thành xong bạn có thể đề xuất hoàn thành để quản lý REVIEW
       case "IN PROGRESS":
           echo " <option value='IN PROGRESS' selected>IN PROGRESS</option>
                  <option value='IN REVIEW'>IN REVIEW</option>";
           break;
        # Nếu tình trang là đang REVIEW thì bạn có thể giữ nguyên để chờ hoặc DO AGAIN nếu muốn bổ sung thêm
       case "IN REVIEW":
           echo " <option value='IN REVIEW' selected>IN REVIEW</option>
                  <option value='IN PROGRESS'>DO AGAIN</option>
                ";
           break;
        # Nếu tình trạng là COMPLETED và CANCELED bạn chỉ có thể giữ nguyên và không có quyền để chuyển tình trạng
       case "COMPLETED":
           echo "  <option value='COMPLETED' selected>COMPLETED</option>
                   ";
           break;
       default :
           echo " <option value='CANCELED' selected>CANCELED</option>";  
    }
}







?>