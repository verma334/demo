<?php
session_start();
if(isset($_SESSION['useremail']) and $_SESSION['useremail']){
	session_destroy();
	header('location:index.php');
	exit();
}else{
	echo 'some message';
	
}


?>