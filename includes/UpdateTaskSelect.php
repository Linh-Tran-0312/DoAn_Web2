<?php 
if($Role == 1) {

 switch($Status) {
     case 'NEW ISSUE':
        echo " <option value='NEW ISSUE' disabled>NEW ISSUE</option>
               <option value='CANCELED'>CANCELED</option>";
        break;
    case "IN PROGRESS":
        echo " <option value='IN PROGRESS' disabled>IN PROGRESS</option>
               <option value='CANCELED'>CANCELED</option>";
        break;
    case "IN REVIEW":
        echo " <option value='IN REVIEW' disabled>IN REVIEW</option>
               <option value='IN PROGRESS'>DO AGAIN</option>
               <option value='COMPLETED'>COMPLETED</option>
               <option value='CANCELED'>CANCELED</option>";
        break;
    case "COMPLETED":
        echo "  <option value='COMPLETED' disabled>COMPLETED</option>
                <option value='CANCELED'>CANCELED</option>";
        break;
    default :
        echo " <option value='CANCELED' selected>CANCELED</option>";  
 }
} else {
    switch($Status) {
        case 'NEW ISSUE':
           echo " <option value='NEW ISSUE' disabled>NEW ISSUE</option>
                  <option value='IN PROGRESS'>ACCEPT</option>";
           break;
       case "IN PROGRESS":
           echo " <option value='IN PROGRESS' disabled>IN PROGRESS</option>
                  <option value='IN REVIEW'>IN REVIEW</option>";
           break;
       case "IN REVIEW":
           echo " <option value='IN REVIEW' disabled>IN REVIEW</option>
                  <option value='IN PROGRESS'>DO AGAIN</option>
                ";
           break;
       case "COMPLETED":
           echo "  <option value='COMPLETED' selected>COMPLETED</option>
                   ";
           break;
       default :
           echo " <option value='CANCELED' selected>CANCELED</option>";  
    }
}







?>