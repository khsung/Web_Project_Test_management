<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>

<?php 
    $con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");

    mysqli_query($con,'SET NAMES utf8');
    $user_origin_id=$_SESSION["user_id"];
    $user_id = $_POST["user_id"];
    $user_pw = $_POST["user_pw"];
    $user_name = $_POST["user_name"];
	$sql="UPDATE DB_PROJECT_USER SET user_id='$user_id', user_pw='$user_pw', user_name='$user_name' WHERE user_id='$user_origin_id'";
	mysqli_query($con,$sql);
	$_SESSION["user_id"] = "$user_id";
    Header("Location:./Mypage.php");
?>
</html>