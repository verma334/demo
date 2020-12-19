<?php
session_start();
if(isset($_SESSION['username']) and $_SESSION['username']!=""){
	header('location:dashboard.php');
	echo "hello";
	exit();
}


$err_msg = "";

//clean($_POST); // data cleaning  --> $_POST]sub']=""
if(isset($_POST['sub']) and $_POST['sub']){
	//print_r($_POST); // display values
	///////// validating at server side //////////////
	if(isset($_POST['useremail']) and $_POST['useremail']==""){
		$err_msg = $err_msg."Username not Provided<br />";
	}
	if(isset($_POST['pwd']) and $_POST['pwd']==""){
		$err_msg = $err_msg."Password not Provided<br />";
	}
	//////// db connection ///////////////
	if(!$err_msg){
		//require_once('config/db.php');
		//require('config/db.php');
		//include_once('config/db1.php');
		$con = mysqli_connect("localhost","root","") or die("DB not connected");
		mysqli_select_db($con,"pimcore") or die("DB not found");
		$user = mysqli_real_escape_string($con,$_POST['useremail']);
		$pwd = mysqli_real_escape_string($con,$_POST['pwd']);
		$sql = "select * from user where useremail='$user'";
		//$sql = "select * from user where username='x' OR 'x'='x'";
		$res = mysqli_query($con,$sql);
		if(mysqli_num_rows($res)>0){
			while($data = mysqli_fetch_assoc($res)){
				//print_r($data);
				if($data['userpwd']!=$pwd){
					$err_msg .= "Wrong Password<br />";
				}else{
					session_start();
					$_SESSION['useremail'] = $user;
					$_SESSION['id'] = $data['id'];
					$_SESSION['username'] = $user;
					
					$_SESSION['user'] = $data;
					header('location:dashboard.php');
					exit();
				}
				echo '<hr />';
				
			}
		}else{
			$err_msg .= "No such user exists<br />";
		}
	}
}	


?>
<!-- login form -->
<html>
<head>
<link rel="stylesheet" href="css/style.css" type="text/css" />
</head>
<body>
<div class="login">
<?php if($err_msg) echo '<div class="error">'.$err_msg.'</div>';?>
<form action="index.php" method="post">
<table>
<tr>
<td>Email: </td>
<td><input type="email" name="useremail" placeholder="Enter your Email" required /></td>
</tr>
<tr>
<td>Password: </td>
<td><input type="password" name="pwd" placeholder="Enter your password" required /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" name="sub" value="Login"/></td>
</tr>
</table>
</form>
</div>
</body>
</html>