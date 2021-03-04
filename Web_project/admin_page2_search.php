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
        	th, td {
            	padding: 20px;
	width : 150px;
            	border-bottom: 1px solid #dadada;
       	}
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
	<div id = "search_box">
		<FORM method="post" action="http://khsung0.dothome.co.kr/WEB_project/admin_page2_search.php" onsubmit="return checkNull()">
		<select id="select-box1" name="search" style="width:80px; height:30px">
			<option value="p"selected>교수자</option>
			<option value="e">시험명</option>
		</select>
		<select id="select-box2" name="sort" style="width:80px; height:30px">
			<option value="end_date"selected>응시기간</option>
			<option value="create">생성일시</option>
		</select>	
		<input type="text" autocomplete=off id = "search_name" name = "search_name" style="width:400px; height:30px">
		<input type="submit" value="검색" name = "Search" style="width:50px; height:30px">
		</FORM>
	</div>
	<div id ="exam_box">
<?php
	$search=$_POST["search"];
	$sort=$_POST["sort"];
	$search_name=$_POST["search_name"];	
	$temp = array();
	$i=-1;
	echo "<table><tr><th>시험명</th><th>생성자명</th><th>응시시간</th><th>응시기간</th><th>생성일</th><th>평균</th><th>배점</th><th>상세보기</th></tr>";
	if($search=="p"){
		if($sort=="end_date"){		
			$query = "SELECT * FROM WEB_EXAM_INFO WHERE proffesorID LIKE '%$search_name%' ORDER BY examTerm ASC";
		}else{
			$query = "SELECT * FROM WEB_EXAM_INFO WHERE proffesorID LIKE '%$search_name%' ORDER BY createDate ASC";
		}
	}else if($search=="e"){
		if($sort=="end_date"){		
			$query = "SELECT * FROM WEB_EXAM_INFO WHERE examName LIKE '%$search_name%' ORDER BY examTerm ASC";
		}else{
			$query = "SELECT * FROM WEB_EXAM_INFO WHERE examName LIKE '%$search_name%' ORDER BY createDate ASC";
		}
	}
	$result=mysqli_query($con,$query);
	while($row = mysqli_fetch_array($result)){
	$temp[]=$row[examName];
	$i=$i+1;
        echo "<tr><th>$row[examName]</th><th>$row[proffesorID]</th><th>$row[examTerm]</th><th>$row[examDate]</th><th>$row[createDate]</th><th>$row[average]</th>
<th>$row[totalScore]</th><th><FORM method='post' action='http://khsung0.dothome.co.kr/WEB_project/Exam_info.php'>
                <input type='hidden' value='$temp[$i]' name = 'temp'>
		<input type='submit' value='상세' name = ''>
            </FORM></th></tr>";
	}
echo "<table>";
?>
	</div>

	</div> 
<script>
    function checkNull(){
        if(document.getElementById('search_name').value.length==0){
            alert("검색어를 입력하세요");
            return false;
        }else{
        return true;
        }
    } 

</script>
</body>
</html>