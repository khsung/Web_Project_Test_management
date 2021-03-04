<html>
<?php session_start(); ?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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
	padding: 20px;
	top:50px;
	left:20%;
	width: 80%;
	height: 100%;
	background:white;
} /* 내용부분 */

body {
	margin: 0px;
}



</style>
</head>
<script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
<body>
	<div id = "header"><?php 
        		$con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
        		mysqli_query($con,'SET NAMES utf8');
        		$user_id=$_SESSION["user_id"];
        		$query = "SELECT * FROM WEB_USER WHERE user_id = '$user_id'";
       		$result=mysqli_query($con,$query);
        		while($row = mysqli_fetch_array($result)){
        		echo"교수자 <strong>$user_id</strong>님 환영합니다. 현재접속 IP는 $row[login_ip]입니다 ";
        		}

	?> 	
	<FORM method="post" style="float: right;" action="http://khsung0.dothome.co.kr/WEB_project/Login.html">
                <input type="submit" value="Log out" name = "Logout">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            </FORM> 
</div>
	<div id="line"></div> /* 홈페이지 상단 */

	<a href="http://khsung0.dothome.co.kr/WEB_project/professor1.php"> <div id="nav1"><h1> 시험 목록 </h1></div></a> /* 홈페이지 좌측 */
	<a href="http://khsung0.dothome.co.kr/WEB_project/professor2.php"> <div id="nav2"> <h1> 시험 생성 </h1> </div> </a> /* 홈페이지 좌측 */

	<div id="main">
             <br>
	<form id = "main"<FORM method="post" action="http://khsung0.dothome.co.kr/WEB_project/make_exam.html" onsubmit="return sub();">
					시험 과목 : <input type="text" id = "examName" name = "examName" autocomplete="off"></input><br><br>
            		응시 기간 : <input type="date" id = "examDate" name = "examDate" autocomplete="off"></input><br><br>
            		제한 시간 : <input id="time1" type="text" autocomplete="off"></input><br><br>
            		채점 : <input type="radio" name="isScored" value="auto">자동</input>  
					<input type="radio" name="isScored" value="man">수동</input><br><br>
            		<input TYPE="submit" value="문제 제출"></input>
           		<input type="reset" value="초기화"></input>
        	</form>
        	</div>
</body>

<script>

var timepicker = new TimePicker('time1', {
    lang: 'en',
    theme: 'dark'
});
timepicker.on('change', function (evt) {
    var value = (evt.hour || '00') + ':' + (evt.minute || '00');
    evt.element.value = value;
});

	function sub(){

		var arr = new Array();

		var isScored = document.getElementsByName('isScored');
		var examTime = document.getElementById("time1").value;
		var sum=0;
		var checked_value = "";
		for(i=0;i<isScored.length;i++){
   			if(isScored[i].checked){
				sum++;
				checked_value = isScored[i].value;
			} 
		}
		var d = new Date();
		let year = d.getFullYear(); // 년도
		let month = d.getMonth() + 1;  // 월
		let date = d.getDate();  // 날짜

		arr[0] = Math.floor(Math.random() * 10000) + 1;
		arr[1] = document.getElementById('examName').value;
		arr[2] = 1;
		arr[3] = document.getElementById('examDate').value;
		arr[4] = null;
		arr[5] = year + '-' + month + '-' + date;
		arr[6] = checked_value;
		arr[7] = examTime;

		sessionStorage.examID = arr[0]
		if(document.getElementById('examName').value.length==0){
			alert("시험과목을 입력하세요");
			return false;
		}else if(!examDate){
			alert("응시 기간를 입력하세요.");
			return false;
		}else if(!examTime){
  			alert("제한 시간을 입력하세요.");
  			return false;
		}else if(sum == 0) {
			alert("채점 방법을 선택하세요.");
		}
		var jsonEncode = JSON.stringify(arr); 
		//alert(jsonEncode); 
        $.ajax({
            url: 'http://khsung0.dothome.co.kr/WEB_project/professor2_submit.php',
            data: {
                param1: jsonEncode
            },
            type: 'POST',
            dataType: 'json',
            success: function(result) {
            if(result.success == false) {
                alert(result.msg);
                return;
                }
                console.log(result.data);
            }
        });
	return 0;
	} 
</script>
</html>