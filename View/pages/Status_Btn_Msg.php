<?php 

switch($task_status) {
    case "NEW ISSUE":
      $Status_View =  "<button class='btn btn-secondary mx-1' >NEW ISSUE</button>";
      $Status_Button =  "<button class='btn btn-secondary mx-1' onclick='document.getElementById(\"id01\").style.display=\"block\"'>NEW ISSUE</button>";
      $Status_Message_QL = "Đang chờ nhân viên của bạn phản hồi.";
      $Status_Message_NV = "Quản lý của bạn vừa giao cho bạn nhiệm vụ mới, hãy phản hồi để quản lý biết nhé.";
      break;
    case "IN PROGRESS":
      $Status_View = "<div class='btn btn-warning mx-1'>IN PROGRESS</div>";
      $Status_Button = "<div class='btn btn-warning mx-1' onclick='document.getElementById(\"id01\").style.display=\"block\"'>IN PROGRESS</div>";
      $Status_Message_QL = "Nhân viên của bạn đang thực hiện nhiệm vụ.";
      $Status_Message_NV = "Hãy cố gắng hoàn thành nhiệm vụ trước deadline nhé.";
      break;
    case "COMPLETED":
      $Status_View =  "<div class='btn btn-success mx-1'>COMPLETED</div>";
      $Status_Button =  "<div class='btn btn-success mx-1' onclick='document.getElementById(\"id01\").style.display=\"block\"'>COMPLETED</div>";
      $Status_Message_QL = "Nhân viên của bạn đã hoàn thành nhiệm vụ này";
      $Status_Message_NV = "Bạn đã hoàn thành nhiệm vụ này";
      break;
    case "IN REVIEW":
      $Status_View =  "<div class='btn btn-info mx-1'>IN REVIEW</div>";
      $Status_Button =  "<div class='btn btn-info mx-1' onclick='document.getElementById(\"id01\").style.display=\"block\"'>IN REVIEW</div>";
      $Status_Message_QL = "Nhân viên bạn đã hoàn thành và đang chờ bạn duyệt hoàn thành nhiệm vụ này.";
      $Status_Message_NV = "Hãy chờ quản lý của bạn duyệt hoàn thành nhiệm vụ nhé.";
      break;
    case "CLOSED":
      $Status_View =  "<div class='btn btn-primary mx-1'>CLOSED</div>";
      $Status_Button =  "<div class='btn btn-primary mx-1' onclick='document.getElementById(\"id01\").style.display=\"block\"'>CLOSED</div>";
      $Status_Message_QL = "Nhiệm vụ đã hoàn thành và đóng lại";
      $Status_Message_NV = "Nhiệm vụ đã hoàn thành và đóng lại";
      break;
    case "CANCELED":
      $Status_View =  "<div class='btn btn-dark mx-1'>CANCELED</div>";
      $Status_Button =  "<div class='btn btn-dark mx-1' onclick='document.getElementById(\"id01\").style.display=\"block\"'>CANCELED</div>";
      $Status_Message_QL = "Nhiệm vụ đã được hủy";
      $Status_Message_NV = "Nhiệm vụ đã được hủy";
      break;
    default:
    $Status_Button = "";
    }
  

?>