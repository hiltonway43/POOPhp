<?php 
	require_once('Config/Conection.php');

	if (isset($_GET['controller'])&&isset($_GET['action'])) {
		
		$controller=$_GET['controller'];
		$action=$_GET['action'];
	}else{
		$controller='user';
		$action='Index';
	}
    //require_once('Views/Layouts/index.php');	
    require_once('Router/route.php'); 
 ?>