<?php
session_start();
header('Access-Control-Allow-Origin: http://khsung0.dothome.co.kr');
	try {
		$con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
		mysqli_query($con,'SET NAMES utf8');
		## param1
		$sum = $_POST['param1'];
		if(!$sum) {
			throw new exception('param1 값이 없습니다.');
		}
		## 마무리
		$studentID=$_SESSION["user_id"];
		$result['data']		= "param1은 {$sum}";
	} catch(exception $e) {

		$result['success']	= false;
		$result['msg']		= $e->getMessage();
		$result['code']		= $e->getCode();

	} finally {
		echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	}
