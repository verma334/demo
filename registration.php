<?php
$ip ='127.198.0.1';
//$ip = $_SERVER['REMOTE_ADDR'];
$name = $_POST["username"];
if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
 echo "Only letters and white space allowed";
}
if (filter_var($ip, FILTER_VALIDATE_IP)) {
    echo("$ip is a valid IP address");
} else {
    echo("$ip is not a valid IP address");
}
if(isset($_POST['useremail']) && empty($_POST['useremail'])==false){
    if (!filter_var($_POST['useremail'],FILTER_VALIDATE_EMAIL)){
        echo 'This is not a valid email';
    }
  }

$err_msg = "";
//clean($_POST); // data cleaning  --> $_POST['sub']=""
if(isset($_POST['sub']) and $_POST['sub']){
	//print_r($_POST); // display values
	///////// validating at server side //////////////
	if(isset($_POST['username']) and $_POST['username']==""){
		$err_msg = $err_msg."Username not Provided<br />";
	}
	if(isset($_POST['pwd']) and $_POST['pwd']==""){
		$err_msg = $err_msg."Password not Provided<br />";
    }
    if(isset($_POST['useremail']) and $_POST['useremail']==""){
        
        $err_msg = $err_msg."useremail not Provided<br />";
    }
    if(isset($_POST['usercontact']) && !empty($_POST['usercontact'] )){
        if (!preg_match('/^[0-9]{10}+$/', $_POST['usercontact'])){
            $err_msg = $err_msg."10 digit contact no. is allowed";
             }
        }else{
        $err_msg = $err_msg."contact no. is not provided<br />";
    }
    
    
	//////// db connection ///////////////
	if(!$err_msg){
		$con = mysqli_connect("localhost","root","") or die("DB not connected");
		mysqli_select_db($con,"pimcore") or die("DB not found");
		$username = mysqli_real_escape_string($con,$_POST['username']);
        $pwd= mysqli_real_escape_string($con,$_POST['pwd']);
        $useremail = mysqli_real_escape_string($con,$_POST['useremail']);
        $usercontact = mysqli_real_escape_string($con,$_POST['usercontact']);
		$sql = "INSERT INTO `user` ( `username`, `userpwd`, `useremail`, `usercontact`) VALUES ('".$username."', '".$pwd."', '".$useremail."', '".$usercontact."')";
		//$sql = "select * from user where username='x' OR 'x'='x'";
		$res = mysqli_query($con,$sql);              /*to excute the sql query*/
		// if(mysqli_query($con,$sql)){
        //     echo "Record Inserted";
        // }else{
        //     echo "Record Not Inserted";
        // }
        if(mysqli_affected_rows($con)>0){
                echo"Record Inserted";
        }else{
            echo "Record not inserted";
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
<form action="registration.php" method="post">
<table>
<tr>
<td>Usename: </td>
<td><input type="text" name="username" placeholder="Enter your name" required /></td>
</tr>
<tr>
<td>Mobile: </td>
<td><input type="text" name="usercontact" placeholder="Enter your contact" required /></td>
</tr>
<td>Email: </td>
<td><input type="email" name="useremail" placeholder="Enter your email" required /></td>
</tr>
<td>Password: </td>
<td><input type="password" name="pwd" placeholder="Enter your password" required /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" name="sub" value="Register"/></td>
</tr>
</table>
</form>
</div>
</body>
</html>