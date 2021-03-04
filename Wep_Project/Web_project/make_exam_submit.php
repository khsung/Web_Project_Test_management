<?php
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


		$sql = array(); 
		foreach( $json as $arr ) {
	    		$examID = $arr[0];
    			$PID = $arr[1];
 	   		$type = $arr[2];
 	   		$score = $arr[3];
   			$problem = $arr[4];
    			$ex1=$arr[5][0];
    			$ex2=$arr[5][1];
    			$ex3=$arr[5][2];
    			$ex4=$arr[5][3];
    			$ex5=$arr[5][4];
    			$answer= $arr[6];


			mysqli_query($con,"INSERT INTO WEB_EXAM_PINFO (examID, PID, type, score, problem, ex1, ex2, ex3, ex4, ex5, answer) VALUES ('$examID', '$PID', '$type', '$score', '$problem', '$ex1', '$ex2', '$ex3', '$ex4', '$ex5', '$answer')");
			

		}
		

    		$result['data']		= "{$json}";




	} catch(exception $e) {

		$result['success']	= false;
		$result['msg']		= $e->getMessage();
		$result['code']		= $e->getCode();

	} finally {
		echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	}
?>