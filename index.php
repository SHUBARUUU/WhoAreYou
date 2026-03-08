<!-- index.php - File dedicated to controlling the flow of the website
    - Requires the init.php file
    - 
-->
<?php 
    require_once(__DIR__ . '../Includes/init.php');

    if(isset($_SESSION['user'])){
        redirect('pages/dashboard.php');
    }else{
        redirect('pages/login.php');
    }
    
?>