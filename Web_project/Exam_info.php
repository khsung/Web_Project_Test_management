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
	height: 94%;
	background:white;
	overflow : auto;
} /* 내용부분 */

#search_box{
	position: relative;
	top:50px;
	left:70px;
}
#exam_box{

	width: 100%;
	top:80px;
	height:80%;
	position : relative;
	overflow:auto;
}
body {
	margin: 0px;
}
</style>
<style type="text/css">
 form{display:inline}
</style>
</head>
<body>
    	<div id = "header">
	<?php 
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


<?php
	$examName=$_POST["temp"];
	$sql = "SELECT * FROM WEB_EXAM_INFO WHERE examName='$examName'";
	$result=mysqli_query($con,$sql);
	while($row = mysqli_fetch_array($result)){
		echo"시험 명 : $row[examName]<br><br>생성자 ID : $row[proffesorID]<br><br>
응시기간 : $row[examTerm]<br><br>응시 시간 : $row[timer]<br><br>";
	$innersql = "SELECT * FROM WEB_EXAM_PINFO WHERE examID='$row[examID]'";
	$innerresult=mysqli_query($con,$innersql);
	while($innerrow = mysqli_fetch_array($innerresult)){
		if($innerrow[type]=="e"){
			echo"$innerrow[PID]. 문제 : $innerrow[problem]&nbsp&nbsp&nbsp&nbsp&nbsp배점 : $innerrow[score]<br><br>
			정답 : $innerrow[answer]<br><br><br><br>";
		}else{
			echo"$innerrow[PID]. 문제 : $innerrow[problem]&nbsp&nbsp&nbsp&nbsp&nbsp배점 : $innerrow[score]<br><br>";
			if($innerrow[ex1]!=NULL){
			echo"$innerrow[ex1]&nbsp&nbsp";
			}if($innerrow[ex2]!=NULL){
			echo"$innerrow[ex2]&nbsp&nbsp";
			}if($innerrow[ex3]!=NULL){
			echo"$innerrow[ex3]&nbsp&nbsp";
			}if($innerrow[ex4]!=NULL){
			echo"$innerrow[ex4]&nbsp&nbsp";
			}if($innerrow[ex5]!=NULL){
			echo"$innerrow[ex5]";
			}
		echo"<br><br>정답 : $innerrow[answer]<br><br><br><br>";
		}
	}
	echo"평균 : $row[average]<br><br><br><br>";
	}
?>
<FORM method="post" action="http://khsung0.dothome.co.kr/WEB_project/Delete_exam.php">
                	<input type="hidden" value="<?echo "$examName"; ?>" name = "temp">
		<input type="submit" value="삭제" name = "">
</FORM>
<a href="./admin_page2.php"><button>돌아가기</button></a>

	</div> 
<script>
    function checkNull(){
        if(document.getElementById('search').value.length==0){
            alert("검색어를 입력하세요");
            return false;
        }else{
        return true;
        }
    } 

</script>
</body>
</html>