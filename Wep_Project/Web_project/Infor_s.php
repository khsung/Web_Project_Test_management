<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<?php
        $con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
        mysqli_query($con,'SET NAMES utf8');
        $user_id=$_POST["temp"];
        $query = "SELECT * FROM WEB_USER WHERE user_id='$user_id'";
        $result=mysqli_query($con,$query);
        while($row = mysqli_fetch_array($result)){
        	echo"<center>ID : $row[user_id]<br><br>이름 : $row[user_name]<br><br>
등급 : 학습자<br><br>가입 일시 : $row[create_at]<br><br>마지막 로그인 : $row[last_login]<br><br><a href ='./list_s.php'><button>돌아가기</button></a><center>";
        }
        
?>
</body>
</html>