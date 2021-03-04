<?php
session_start();
header('Access-Control-Allow-Origin: http://khsung0.dothome.co.kr');
	try {
		$con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
		mysqli_query($con,'SET NAMES utf8');
		## param1
		$param1 = $_POST['param1'];
		if(!$param1) {
			throw new exception('param1 값이 없습니다.');
		}
		## 마무리
		$json = json_decode($param1);
		$result['success']	= true;
		$result['data']		= "param1은 {$param1}";
		$user_id=$_SESSION["user_id"];
		$examID = $json[0];
    		$examName = $json[1];
 	   	$proffesorID = $user_id;
 	   	$examDate = $json[3];
   		$examTerm = date("0000-00-00 00:00:00");
    		$createDate = $json[5];
    		$isScored = $json[6];
    		$average = null;
    		$totalScore = null;
    		$timer = $json[7];
		$result['data']		= "param1은 {$timer}";

		mysqli_query($con,"INSERT INTO WEB_EXAM_INFO (examID, examName, proffesorID, examDate, examTerm, createDate, isScored, average, totalScore, timer) VALUES ('$examID', '$examName', '$proffesorID', '$examDate', '$examTerm', '$createDate', '$isScored', '$average', '$totalScore', '$timer')");



	} catch(exception $e) {

		$result['success']	= false;
		$result['msg']		= $e->getMessage();
		$result['code']		= $e->getCode();

	} finally {
		echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	}
?>