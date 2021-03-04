<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<style>
    #title{
    font-family: "Times New Roman",Times,serif;
    font-size:200%;
    font-style:italic;
    }
    th, td {
        padding: 10px;
        border-bottom: 1px solid #dadada;
      }
</style>
<body bgcolor="#CEEECC">

<?php 
	$temp = array();
	$i=-1;
    $user_id=$_SESSION["user_id"];
    if($user_id=='admin'){
        echo "<div id = 'title'> 
    <center>
	<h1>회원 정보</h1>
    <center>
</div>";
        echo "<center><h1>관리자 계정입니다.</h1><center><br>";
        $con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
        mysqli_query($con,'SET NAMES utf8');
        $query = "SELECT * FROM DB_PROJECT_USER WHERE user_id not in ('admin')";
        $result=mysqli_query($con,$query);
        echo "<table><tr><th>아이디</th><th>비밀번호</th><th>이름</th><th>생성 일자</th><th>마지막 로그인</th><th>삭제 여부</th></tr>";
        while($row = mysqli_fetch_array($result)){
	$temp[]=$row[user_id];
	$i=$i+1;
        echo "<tr><th>$row[user_id]</th><th>$row[user_pw]</th><th>$row[user_name]</th><th>$row[create_at]</th><th>$row[last_login]</th>
<th><FORM method='post' action='http://khsung0.dothome.co.kr/DB_project/Delete_user.php'>
                <input type='hidden' value='$temp[$i]' name = 'temp'>
		<input type='submit' value='삭제하기' name = ''>
            </FORM> </th></tr>";
        
        }
        echo "</table>";
echo "<br><br><a href='http://khsung0.dothome.co.kr/DB_project/Main.php'><button>메인 화면으로</button></a>";
    }else{
        echo "<div id = 'title'> 
    <center>
	<h1>내 정보</h1><br><br>
    <center>
</div>";
        $con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
        mysqli_query($con,'SET NAMES utf8');
        $query = "SELECT * FROM DB_PROJECT_USER WHERE user_id = '$user_id'";
        $result=mysqli_query($con,$query);
        while($row = mysqli_fetch_array($result)){
             echo "<center>ID : $row[user_id]<center><br>";
             echo "<center>PW : $row[user_pw]<center><br>";
             echo "<center>NAME : $row[user_name]<center><br>";
	echo "<center>가입일자 : $row[create_at]<center><br>";
             echo "<center>접속 IP : $row[login_ip]<center><br><br><br>";
	echo "<a href='http://khsung0.dothome.co.kr/DB_project/Mypage_Modify.html'><button>수정하기</button></a>";	
	echo "&nbsp&nbsp&nbsp&nbsp";
	echo "<a href='http://khsung0.dothome.co.kr/DB_project/Main.php'><button>메인 화면으로</button></a>";
        }
    }
    
?><br><br><br><br>

</body>
</html>