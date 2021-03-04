<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<?php
    $con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
    mysqli_query($con,'SET NAMES utf8');
    $origin_user_id = $_POST["origin_user_id"];
    $user_id = $_POST["user_id"];
    $user_pw = $_POST["user_pw"];
    $user_name = $_POST["user_name"];
    $user_grade = $_POST["user_grade"];
    $sql="UPDATE WEB_USER SET user_id='$user_id',user_pw='$user_pw',user_name='$user_name',user_grade='$user_grade' WHERE user_id='$origin_user_id'";
    mysqli_query($con,$sql);
    Header("Location:./list_p.php");
?>
</html>