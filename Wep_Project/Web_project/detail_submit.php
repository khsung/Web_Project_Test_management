<?php
header('Access-Control-Allow-Origin: http://khsung0.dothome.co.kr');
header('Content-Type: text/html; charset=utf-8');
$con = mysqli_connect("localhost", "khsung0", "gmltjd1!", "khsung0");
$sql = 'set names utf8';
$con->query($sql);
$result = array();
	try {

		## param1
		$examID = $_POST['param1'];
		if(!$examID) {
			throw new exception('param1 값이 없습니다.');
		}
		## 마무리
		$examID = 6935;
            		$sql = "SELECT * FROM WEB_EXAM_PINFO WHERE examID like '%".$examID."%'" ;
            		$raw = $con->query($sql);
            		if ($raw->num_rows > 0) {
                		$result['data'] = array();
                		while ($row = $raw->fetch_assoc()) {
                    		array_push($result['data'],$row);
                		}
            		} 




	} catch(exception $e) {

		$result['success']	= false;
		$result['msg']		= $e->getMessage();
		$result['code']		= $e->getCode();

	} finally {
		echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	}
