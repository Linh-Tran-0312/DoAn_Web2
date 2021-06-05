<?php 
session_start();
$_SESSION['isLogin'] = false;
$content = "";
$page = "";
	if (!isset($_REQUEST["page"]) || $_REQUEST["page"] == 'login' || $_REQUEST["page"] == 'register') {
		# code...
        
    if(!isset($_REQUEST["page"]) || $_REQUEST["page"] == 'login') {
        ob_start();
        include_once('./View/pages/login.php');
        $content = ob_get_clean();         
    }
    else{
           ob_start();
            include_once('./View/pages/register.php');
            $content = ob_get_clean();
    }    
        $html = file_get_contents('./View/layouts/GD1.html');
        $html = str_replace('<<pos_page_content>>', $content, $html);
        echo $html;
	}
     else {
        $page = $_REQUEST["page"];

    switch($page) {

        case 'profile':
            ob_start();
            include_once('./View/pages/profile.php'); 
            $content =  ob_get_clean();
            break;
        case 'project':
            ob_start();
            include_once('./View/pages/project.php'); 
            $content =  ob_get_clean();
            break;
        case 'task':
            ob_start();
            include_once('./View/pages/task.php'); 
            $content =  ob_get_clean();
            break;
        case 'task-details':
            ob_start();
            include_once('./View/pages/task-details.php'); 
            $content =  ob_get_clean();
            break;
        case 'logout':
            ob_start();
            include_once('./View/pages/logout.php'); 
            $content =  ob_get_clean();
            break;
    }
   
    $html = file_get_contents('./View/layouts/GD2.html');
    $html = str_replace("<<$page>>", 'active', $html);
    $html = str_replace('<<pos_page_name>>', $page, $html);
    $html = str_replace('<<pos_page_content>>', $content, $html);
    $UserName = "";
    if(isset($_SESSION['nhanvien']['TenNhanVien'])) {
        $UserName = $_SESSION['nhanvien']['TenNhanVien'];
        $html = str_replace('<<pos_user_name>>', $UserName, $html);
    }
    print $html;
}
  
 

?>