<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head><meta http-equiv="Content-Type" content="text/php; charset=utf-8"/></head>
<body>
<?php
    header('Content-Type: text/html; charset=utf-8');
    $con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
    $con->query("SET NAMES 'UTF8'");
    $user_id = $_POST["user_id"];
    $user_pw = $_POST["user_pw"];
    $current_time = date("Y-m-d H:i:s");
    $ip_address = $_SERVER["REMOTE_ADDR"];

    $grade_check=mysqli_query($con,"SELECT * FROM WEB_USER WHERE user_id = '$user_id'");
    $row = mysqli_fetch_array($grade_check);

    $statement = mysqli_prepare($con, "SELECT * FROM WEB_USER WHERE user_id = ? AND user_pw = ?");
    mysqli_stmt_bind_param($statement, "ss", $user_id, $user_pw);
    mysqli_stmt_execute($statement);

 
    mysqli_stmt_store_result($statement);

    
    $response = array();
    $response["success"] = false;
 
    while(mysqli_stmt_fetch($statement)) {
        $response["success"] = true;
        $response["user_id"] = $user_id;
        $response["user_pw"] = $user_pw;
    }

 
    if($response["success"] == true){

	$sql="UPDATE WEB_USER SET login_ip='$ip_address',last_login='$current_time' WHERE user_id='$user_id'";

	$_SESSION["user_id"] = "$user_id";
	if($response["user_id"]=="admin"){
		mysqli_query($con,$sql);
		Header("Location:./admin_page1.php");
	}else if($row["user_grade"]=="p"){
		if($row["approval"]=="0"){
			Header("Location:./Login.html");
		}else{
			mysqli_query($con,$sql);
			Header("Location:./professor1.php");
		}
	}else if($row["user_grade"]=="s"){
		mysqli_query($con,$sql);
		Header("Location:./student.php");
	}
    }
    else{
	echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
	<script>
		alert('회원정보가 없습니다');
		history.go(-1)
	</script>
	");
    }
?>
</body>
</html>

