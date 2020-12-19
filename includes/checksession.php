<?php
session_start();
//print_r($_SERVER);
//foreach($_SERVER as $k=>$v){
	//echo $k.' = ' .$v. '<br/>';
//}

if(!(isset($_SESSION['useremail']) and $_SESSION['useremail'])){
	header('location:index.php');
	exit();
}
?>