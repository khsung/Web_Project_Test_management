<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>

        #main {
            position: absolute;
            width: 100%;
            height: 100%;
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
        .head{
            display: table-row;
	font-weight:bold;
        }
        .row{
            display: table-row;
        }
        .cell{
            display: table-cell;
            padding: 3px;
            border-bottom: 1px solid #DDD;
        }
        .col1{ width: 12%;}
        .col2{ width: 12%;}
        .col3{ width: 15%;}
        .col4{ width: 15%;
	font-size : 120%; 
	}
        .col5{ width: 30%;}
    </style>
<style type="text/css">
 form{display:inline}
</style>
</head>
<body>
<?php
        $con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
        mysqli_query($con,'SET NAMES utf8');
?>

<div id="main">
    <div id="table-wrap">
        <div id="table">

<?php
	$temp = array();
	$i=-1;
	$query = "SELECT * FROM WEB_USER WHERE user_grade='p'";
	$result=mysqli_query($con,$query);
	echo"    <div class='head'>
                		<span class = 'cell col1'>아이디</span>
                		<span class = 'cell col2'>이름</span>
                		<span class = 'cell col3'>가입일시</span>
                		<span class = 'cell col2'>등급</span>
			<span class = 'cell col2'>승인여부</span>
                		<span class = 'cell col5'></span>
            		</div> ";
	while($row = mysqli_fetch_array($result)){
	$temp[]=$row[user_id];
	$i=$i+1;
	if($row[approval]=="0"){
		$sign=X;
	}else{
		$sign=O;
	}
	echo" <div class='row'>
                <span class = 'cell col1'>$row[user_id]</a></span>
                <span class = 'cell col2'>$row[user_name]</span>
                <span class = 'cell col3'>$row[create_at]</span>
                <span class = 'cell col2'>$row[user_grade]</span>
	   <span class = 'cell col2'>$sign</span>
                <span class = 'cell col5'>
		<FORM method='post' action='http://khsung0.dothome.co.kr/WEB_project/Delete_p.php'>
                		<input type='hidden' value='$temp[$i]' name = 'temp'>
			<input type='submit' value='삭제' name = ''>
            		</FORM>&nbsp;&nbsp;&nbsp;
		<FORM method='post' action='http://khsung0.dothome.co.kr/WEB_project/Infor_p.php'>
                		<input type='hidden' value='$temp[$i]' name = 'temp'>
			<input type='submit' value='상세' name = ''>
            		</FORM>&nbsp;&nbsp;&nbsp;
		<FORM method='post' action='http://khsung0.dothome.co.kr/WEB_project/Modify_p.php'>
                		<input type='hidden' value='$temp[$i]' name = 'temp'>
			<input type='submit' value='수정' name = ''>
            		</FORM>&nbsp;&nbsp;&nbsp;
		<FORM method='post' action='http://khsung0.dothome.co.kr/WEB_project/Approval_user.php'>
                		<input type='hidden' value='$temp[$i]' name = 'temp'>
			<input type='submit' value='승인' name = ''>
            		</FORM>
	    </span>
            </div>";
	}
?>

        </div>
    </div>
</div>
</body>
</html>
