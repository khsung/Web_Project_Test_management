<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
            height: 100%;
            background:white;
        } /* 내용부분 */

        body {
            margin: 0px;
        }
        #input-wrap{
            height: 40px;
            width : 430px;
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
            width:50px;
            height: 100%;
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
    <p1>시험 목록</p1>
    <div id="input-wrap">
        <input id="input" type="text" placeholder="검색어 입력">
        <button style="cursor:pointer" class="button" onclick="search()">검색</button>
        <select id="select-box" name="standard">
            <option value="">정렬 항목</option>
            <option value="생성일">생성일</option>
            <option value="응시기간">응시기간</option>
            <option value="평균">평균</option>
        </select>
        <button style="cursor:pointer" id = "sort-button" class="button" onclick="sort()">정렬</button>
    </div>

    <div id="table-wrap">
        <div id="table">
            <div class="row">
                <span class = "cell col1">시험명</span>
                <span class = "cell col2">생성일</span>
                <span class = "cell col3">응시기간</span>
                <span class = "cell col4">응시시간</span>
                <span class = "cell col5">응시인원 / 전체대상인원</span>
                <span class = "cell col6">평균</span>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    function search(){
        var input = document.getElementById("input").value;
        $.ajax({
            url: 'http://khsung0.dothome.co.kr/WEB_project/professor1_search.php',
            data: {
                exam: input
            },
            type: 'POST',
            dataType: 'json',
            success: function(result) {
                if(result.success == false) {
                    alert(result.msg);
                        return;
                }
                for(var i=0; i<result.data.length; i++) {
                    var newDiv = document.createElement("div");
                    newDiv.setAttribute("class", "row");
                    newDiv.innerHTML = `
                    <span class = "cell col1">${result.data[i].examName}</span>
                    <span class = "cell col2">${result.data[i].createDate}</span>
                    <span class = "cell col3">${result.data[i].examDate}</span>
                    <span class = "cell col4">${result.data[i].examTerm}</span>
                    <span class = "cell col5">35/35</span>
                    <span class = "cell col6">${result.data[i].average}</span>`;
                    var table = document.getElementById("table");
                    table.appendChild(newDiv);
                }
            }
        });
        var cell = document.getElementById("table");
        while(cell.hasChildNodes())
        {
            cell.removeChild(cell.firstChild);
        }
        var newDiv = document.createElement("div");
        newDiv.setAttribute("class", "row");
        newDiv.innerHTML = `
                <span class = "cell col1">시험명</span>
                <span class = "cell col2">생성일</span>
                <span class = "cell col3">응시기간</span>
                <span class = "cell col4">응시시간</span>
                <span class = "cell col5">응시인원 / 전체대상인원</span>
                <span class = "cell col6">평균</span>`;
        cell.appendChild(newDiv);
    }
    function sort(){
        var sort = document.getElementById("select-box").value;
        console.log(sort);
    }
</script>
</html>
