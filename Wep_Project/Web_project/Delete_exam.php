<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<?php
        $con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
        mysqli_query($con,'SET NAMES utf8');
        $examName=$_POST["temp"];

        $query = "SELECT * FROM WEB_EXAM_INFO WHERE examName='$examName'";
        $examIDresult=mysqli_query($con,$query);
	while($row = mysqli_fetch_array($examIDresult)){
		$examID=$row[examID];
	}

        $sql1="DELETE FROM WEB_EXAM_INFO WHERE examName='$examName'";
        mysqli_query($con,$sql1);
        $sql2="DELETE FROM WEB_EXAM_PINFO WHERE examID='$examID'";
        mysqli_query($con,$sql2);
        Header("Location:./admin_page2.php");
?>
</body>
</html>