<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>

#header {
	margin: 0px;
	padding: 10px;
	background-color: #EDEDED;
	width: 100%;
	position:fixed;
	z-index: 100;

} /* 홈페이지 상단 아이디, 이름, 등급 */
#line {

	background-color: #072A60;
	margin: 0px;
	padding: 5px;
	width: 100%;
	position:fixed;
	top:40px;
	z-index: 100;
} /* 홈페이지 상단 남색 줄 */

#line1 {

	background-color: #072A60;
	margin: 0px;
	padding: 5px;
	width: 99%;
	z-index: 100;
} /* 홈페이지 상단 남색 줄 */

#nav1 {
	width: 20%;
	height: 50%;
	color:black;
	background-color: #A4D07B;
	text-align: center;
	float: left;
	position:fixed;
	top:50px;
	z-index: 100;
	transition: background-color 1s;
} /* 네비게이션1 */

#nav1:hover{
	background-color: #DAECCA;
}

#nav2 {
	width: 20%;
	height: 50%;
	color:black;
	background-color: #7CBC42;
	text-align: center;
	float: left;
	position:fixed;
	top:50%;
	z-index: 100;
	transition: background-color 1s;
} /* 네비게이션2 */

#nav2:hover{
	background-color: #DAECCA;
}

#main {
	position: absolute;
	top:50px;
	left:20%;
	width: 80%;
	height: 80%;
	background:white;
} /* 내용부분 */

body {
	margin: 0px;
}

#table-wrap{
            width: 100%;
        }
        #table {
	text-align: center;
            display: table;
            width: 100%;
        }
        .row{
            display: table-row;
        }
        .cell{
            display: table-cell;
            padding: 3px;
            border-bottom: 1px solid #DDD;
        }
        .col1{ width: 18%;}
        .col2{ width: 18%;}
        .col3{ width: 18%;}
        .col4{ width: 18%;}
        .col5{ width: 28%;}


</style>
</head>
<body>

	<div id = "header"><?php 
        		$con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
        		mysqli_query($con,'SET NAMES utf8');
        		$user_id=$_SESSION["user_id"];
        		$query = "SELECT * FROM WEB_USER WHERE user_id = '$user_id'";
       		$result=mysqli_query($con,$query);
        		while($row = mysqli_fetch_array($result)){
        		echo"관리자 <strong>$user_id</strong>님 환영합니다. 현재접속 IP는 $row[login_ip]입니다 ";
        		}

	?> 	
	<FORM method="post" style="float: right;" action="http://khsung0.dothome.co.kr/WEB_project/Login.html">
                <input type="submit" value="Log out" name = "Logout">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            </FORM> 
</div>
	<div id="line"></div> /* 홈페이지 상단 */

	<a href="http://khsung0.dothome.co.kr/WEB_project/admin_page1.php"> <div id="nav1"><h1> 이용자 정보 </h1></div></a> /* 홈페이지 좌측 */

	<a href="http://khsung0.dothome.co.kr/WEB_project/admin_page2.php"> <div id="nav2"> <h1> 시험목록 </h1> </div> </a> /* 홈페이지 좌측 */

	<div id="main">
		<br>&nbsp;&nbsp;교수자<br><br>

		<iframe src="./list_p.php" scrolling=auto align="right" width="100%" height="50%"></iframe><br>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>	
		<br><br>&nbsp;&nbsp;학습자<br><br>

		<iframe src="./list_s.php" scrolling=auto align="right" width="100%" height="50%"></iframe>
	</div> 

</body>
</html>