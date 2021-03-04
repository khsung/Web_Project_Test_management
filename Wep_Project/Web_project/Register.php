<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<?php 
    $con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");

    mysqli_query($con,'SET NAMES utf8');
    $user_id = $_POST["user_id"];
    $user_pw = $_POST["user_pw"];
    $user_name = $_POST["user_name"];
    $user_grade = $_POST["user_grade"];
    $current_time = date("Y-m-d H:i:s");
    $login_ip=0;
    $last_login = date("0000-00-00 00:00:00");
    $approval = 0;
    $approval_date = date("0000-00-00 00:00:00");
    $check_id=mysqli_query($con,"SELECT * FROM WEB_USER WHERE user_id=$user_id");
    if(mysqli_num_rows($check_id)>=1){
    echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
	<script>
		alert('ID가 중복됩니다');
		history.go(-1)
	</script>
	");
    }else{
    $statement = mysqli_prepare($con, "INSERT INTO WEB_USER VALUES (?,?,?,?,?,?,?,?,?)");
    mysqli_stmt_bind_param($statement, "sssssssis", $user_id, $user_pw, $user_name, $user_grade,$current_time,$login_ip,$last_login,$approval,$approval_date);
    mysqli_stmt_execute($statement);

    $response = array();
    $response["success"] = true;
    
    echo json_encode($response);
    Header("Location:http://khsung1.dothome.co.kr/WEB_project/Login.html");
    }
?>
</html>