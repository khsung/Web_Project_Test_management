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
        .col1{ width: 18%;}
        .col2{ width: 18%;}
        .col3{ width: 18%;}
        .col4{ width: 18%;
	font-size : 120%; 
	}
        .col5{ width: 28%;}
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
	$query = "SELECT * FROM WEB_USER WHERE user_grade='s'";
	$result=mysqli_query($con,$query);
	echo"    <div class='head'>
                		<span class = 'cell col1'>아이디</span>
                		<span class = 'cell col2'>이름</span>
                		<span class = 'cell col3'>가입일시</span>
                		<span class = 'cell col3'>등급</span>
                		<span class = 'cell col5'></span>
            		</div> ";
	while($row = mysqli_fetch_array($result)){
	$temp[]=$row[user_id];
	$i=$i+1;
	echo" <div class='row'>
                <span class = 'cell col1'>$row[user_id]</a></span>
                <span class = 'cell col2'>$row[user_name]</span>
                <span class = 'cell col3'>$row[create_at]</span>
                <span class = 'cell col4'>$row[user_grade]</span>
                <span class = 'cell col5'>
		<FORM method='post' action='http://khsung0.dothome.co.kr/WEB_project/Delete_s.php'>
                		<input type='hidden' value='$temp[$i]' name = 'temp'>
			<input type='submit' value='삭제' name = ''>
            		</FORM>&nbsp;&nbsp;&nbsp;&nbsp;
		<FORM method='post' action='http://khsung0.dothome.co.kr/WEB_project/Infor_s.php'>
                		<input type='hidden' value='$temp[$i]' name = 'temp'>
			<input type='submit' value='상세' name = ''>
            		</FORM>&nbsp;&nbsp;&nbsp;&nbsp;
		<FORM method='post' action='http://khsung0.dothome.co.kr/WEB_project/Modify_s.php'>
                		<input type='hidden' value='$temp[$i]' name = 'temp'>
			<input type='submit' value='수정' name = ''>
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
