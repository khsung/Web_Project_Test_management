<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
<body>
<?php
        $con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
        mysqli_query($con,'SET NAMES utf8');
        $user_id=$_POST["temp"];
        $origin_user_id=$_POST["temp"];
?>
<center><br>
<FORM method="post" action="http://khsung0.dothome.co.kr/WEB_project/Modify__s.php" onsubmit="return checkNull('user_grade');">
            ID : <input type="text" id = "user_id" name = "user_id" ><br><br>
	<input type="hidden" value = "<?php echo"$origin_user_id"; ?>" name = "origin_user_id" >
            PW : <input type="password" id = "user_pw" name = "user_pw"><br><br>
            Re-PW : <input type="password" id = "check_user_pw"><br><br>
            이름 : <input type="text" id = "user_name" name = "user_name"><br><br>
            등급 : <input type="radio" name="user_grade" value="p">교수자   
                  <input type="radio" name="user_grade" value="s">학습자<br><br>
           <input type="submit" value="수정 완료" id = "Modify">
 </FORM>
</center>
    <script>
    function checkNull(user_grade){
        var check_grade = document.getElementsByName(user_grade);
        var sum=0;
        for(i=0;i<check_grade.length;i++){
            if(check_grade[i].checked == true){
                sum++;
            } 
        }        
        if(document.getElementById('user_id').value.length==0){
            alert("ID를 입력하세요");
            return false;
        }else if(document.getElementById('user_pw').value.length==0){
            alert("PW를 입력하세요");
            return false;
        }else if(document.getElementById('check_user_pw').value.length==0){
            alert("Re-PW를 입력하세요");
            return false;
        }else if(document.getElementById('user_pw').value!=document.getElementById('check_user_pw').value){
            alert("PW입력이 다릅니다");
            return false;
        }else if(document.getElementById('user_name').value.length==0){
            alert("이름을 입력하세요");
            return false;
        }else if(sum == 0) {
            alert("등급을 선택하세요");
            return false;
        }else{
        return true;
        }
    } 
    </script>
</body>
</html>