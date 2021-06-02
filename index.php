<?php 
session_start();

if(isset($_SESSION['isLogin']) && $_SESSION['isLogin'] === true) {

 
    $html = file_get_contents('./layouts/GD1.html');
   
    echo $html;

} else {
  
    $page = "";
	if (isset($_REQUEST["page"])) {
		# code...
		$page = $_REQUEST["page"];
	}
    $content = "";
    switch($page) {
        case 'profile':
            ob_start();
            include_once('./includes/profile.php'); 
            $content =  ob_get_clean();
            break;
        case 'project':
            ob_start();
            include_once('./includes/project.php'); 
            $content =  ob_get_clean();
            break;
        case 'task':
            ob_start();
            include_once('./includes/task.php'); 
            $content =  ob_get_clean();
            break;
        case 'task-details':
            ob_start();
            include_once('./includes/task-details.php'); 
            $content =  ob_get_clean();
            break;
    }
 
 
    $html = file_get_contents('./layouts/GD2.html');
    $html = str_replace("<<$page>>", 'active', $html);
    $html = str_replace('<<pos_page_name>>', $page, $html);
    $html = str_replace('<<pos_page_content>>', $content, $html);
    print $html;
}

?>