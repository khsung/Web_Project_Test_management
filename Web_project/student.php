<!DOCTYPE html>
<?php
session_start();
?>
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

        #main {
            position: absolute;
            top:60px;
            left:20px;
            width: 100%;
            height: 100%;
            background:white;
        } /* 내용부분 */

        body {
            margin: 0px;
        }
        #input-wrap{
            height: 40px;
            width : 492px;
            border: 1px solid #1b5ac2;
            background: #ffffff;
        }
        #input {
            font-size: 16px;
            width: 200px;
            padding: 10px;
            border: 0px;
            outline: none;
            float : left;
        }
        #input::placeholder{
            color: #999999;
        }
        .button{
            width:60px;
            height: 100%;
	    text-align : center;
            border: 0px;
            background: #1b5ac2;
            outline: none;
            color: #ffffff;
        }
        #sort-button{
            float: right;
        }
        #select-box{
            width:100px;
            height: 35px;
            border: 1px solid white;
            font-family: inherit;
            background: white;
            border-radius: 0px;
            appearance: none;
        }
        #table-wrap{
            width: 100%;
        }
        #table {
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
        .col1{ width: 20%;}
        .col2{ width: 16%;}
        .col3{ width: 16%;}
        .col4{ width: 16%;}
        .col5{ width: 16%;}
        .col6{ width: 16%;}

        	th, td {
            	padding: 20px;
	width : 130px;
            	border-bottom: 1px solid #dadada;
       	}
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
        		echo"학습자 <strong>$user_id</strong>님 환영합니다. 현재접속 IP는 $row[login_ip]입니다 ";
        		}
	?> 
	<FORM method="post" style="float: right;" action="http://khsung0.dothome.co.kr/WEB_project/Login.html">
                <input type="submit" value="Log out" name = "Logout">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            </FORM>
	</div>

<div id="line"></div> /* 홈페이지 상단 */

<div id="main">
    <p1>시험 목록<br><br></p1>
    <div>
		<FORM method="post" action="http://khsung0.dothome.co.kr/WEB_project/student_search.php" onsubmit="return checkNull()">
		<select id="select-box1" name="search" style="width:80px; height:30px">
			<option value="">검색종류</option>
			<option value="e">시험명</option>
			<option value="p">교수자</option>
		</select>
		<select id="select-box2" name="sort" style="width:80px; height:30px">
			<option value="">정렬종류</option>
			<option value="take">응시</option>
			<option value="nontake">미응시</option>
			<option value="e1">시험명</option>
			<option value="p1">교수자명</option>
		</select>	
		<input type="text" autocomplete=off id="search_box" name = "search_name" style="width:400px; height:30px">
		<input type="submit" value="검색" name = "Search" style="width:50px; height:30px">
		</FORM>

    </div>
<br>
    <div id="table-wrap">
<?php
	$temp = array();
	$i=-1;
	$con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
        	mysqli_query($con,'SET NAMES utf8');
	$query = "SELECT * FROM WEB_EXAM_INFO";
	$result=mysqli_query($con,$query);
	echo "<table><tr><th>시험명</th><th>생성자명</th><th>응시기간</th><th>응시시간</th><th>평균</th><th>배점</th><th>응시여부</th><th>시험보기</th></tr>";
	while($row = mysqli_fetch_array($result)){
	$temp[]=$row[examName];
	$i=$i+1;
        echo "<tr><th>$row[examName]</th><th>$row[proffesorID]</th><th>$row[examDate]</th><th>$row[timer]</th><th>$row[average]</th>
<th>$row[totalScore]</th>";
$sql="SELECT COUNT(*) FROM WEB_USER_TAKE_EXAM WHERE examName='$row[examName]' user_id='$user_id'";
$result1=mysqli_query($con,$query);
if($result>0){
echo"<th>$result1</th>";
}else{
echo"<th>미응시</th>";
}

echo"<th><FORM method='post' action='http://khsung0.dothome.co.kr/WEB_project/detail.php'>
                <input type='hidden' value='$temp[$i]' name = 'temp'>
		<input type='submit' value='시험' name = ''>
            </FORM></th></tr>";
	}
echo "<table>";

?>
    </div>
</div>
</body>
<script>
    function checkNull(){
        if(document.getElementById('search_box').value.length==0){
            alert("검색어를 입력하세요");
            return false;
        }else if(document.getElementById('select-box1').value.length==0){
            alert("검색종류를 선택하세요");
            return false;
        }else if(document.getElementById('select-box2').value.length==0){
            alert("정렬종류를 선택하세요");
            return false;
        }else{
        return true;
        }
    } 
</script>
</html>
