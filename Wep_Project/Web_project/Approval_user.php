<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<?php
        $con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
        mysqli_query($con,'SET NAMES utf8');
        $user_id=$_POST["temp"];
        $current_time = date("Y-m-d H:i:s");
        $sql="UPDATE WEB_USER SET approval='1',approval_date='$current_time' WHERE user_id='$user_id'";
        mysqli_query($con,$sql);
        Header("Location:./list_p.php");
?>
</body>
</html>