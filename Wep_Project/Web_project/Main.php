<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>

#header {
	margin: 0px;
	padding: 10px;
	background-color: #CEEECC;
	width: 100%;
	position:relative;
	z-index: 100;
} 

#nav1 {
 line-height: 80px;
	width: 18%;
	height: 8%;
	color:black;
	background-color: #A4D07B;
	text-align: center;
	float: left;
	position:relative;
	top:50px;
	font-size:25px;
	z-index: 100;
	transition: background-color 1s;
} 

#nav1:hover{
	background-color: #DAECCA;
}

#nav2 {
	line-height: 80px;
	width: 18%;
	height: 8%;
	color:black;
	background-color: #7CBC42;
	text-align: center;
	float: left;
	position:relative;
	top:50px;
	font-size:25px;
	z-index: 100;
	transition: background-color 1s;
} 

#nav2:hover{
	background-color: #DAECCA;
}

#nav3 {
	width: 5%;
	height: 8%;
	text-align: center;
	float: left;
	position:relative;
	top:50px;
	font-size:25px;
	z-index: 100;
	transition: background-color 1s;
} 
#main {
	position: absolute;
	top:170px;
	width: 100%;
	height: 80%;

}

body {
	margin: 0px;
}

</style>
<style type="text/css">
 	form{
		display : inline
	}
        	th, td {
            	padding: 20px;
            	border-bottom: 1px solid #dadada;
       	}
</style>
</head>
<body bgcolor="#CEEECC">
	<div id ="header">
<?php
        $con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
        mysqli_query($con,'SET NAMES utf8');
        $user_id=$_SESSION["user_id"];
        if($user_id=='admin'){
        echo "관리자님 환영합니다.";
        }else{
        $query = "SELECT * FROM DB_PROJECT_USER WHERE user_id = '$user_id'";
        $result=mysqli_query($con,$query);
        while($row = mysqli_fetch_array($result)){
        echo "이용자 $row[user_id] 님 환영합니다. 현재 접속 IP는 $row[login_ip] 입니다.";     
        }
        }
?>	
	<FORM method="post" style="float: right;" action="http://khsung0.dothome.co.kr/DB_project/Logout.php">
                <input type="submit" value="Log out" name = "Logout">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            </FORM> 
		</div>
<center>
	<div id ="nav3">&nbsp</div>
	<a href="http://khsung0.dothome.co.kr/DB_project/Main.php" > <div id="nav1"> 음악 목록</div></a>
	<div id ="nav3">&nbsp</div>
	<a href="http://khsung0.dothome.co.kr/DB_project/Main_1.php" > <div id="nav2"> 음악 검색</div></a>
             <div id ="nav3">&nbsp</div>
	<a href="http://khsung0.dothome.co.kr/DB_project/Main_2.php"> <div id="nav1"> 내 앨범 </div></a>
	<div id ="nav3">&nbsp</div>
	<a href="http://khsung0.dothome.co.kr/DB_project/Mypage.php" > <div id="nav2"> 내 정보</div></a> 
	<div id ="nav3">&nbsp</div>
	<div id="main"><br><br>
<?php
	$temp = array();
	$temp1 = array();
	$i=-1;
	$query1 = "SELECT * FROM DB_PROJECT_MUSIC";
	$result1=mysqli_query($con,$query1);
	echo "<table><tr><th>제목</th><th>가수</th><th>작곡</th><th>작사</th><th>상세 보기</th></tr>";
	while($row = mysqli_fetch_array($result1)){
	$temp[]=$row[title];
	$temp1[]=$row[artist];
	$i=$i+1;
        echo "<tr><th>$row[title]</th><th>$row[artist]</th><th>$row[composer]</th><th>$row[lyricist]</th>
<th><FORM method='post' action='http://khsung0.dothome.co.kr/DB_project/Main__1.php'>
                <input type='hidden' value='$temp[$i]' name = 'temp'>
		<input type='hidden' value='$temp1[$i]' name = 'temp1'>
		<input type='submit' value='상세' name = ''>
            </FORM>  </th></tr>";
        }
?>

	</div> 
<center>
</body>
</html>