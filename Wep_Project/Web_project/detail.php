
<html>
<?php session_start(); ?>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">


</head>
<body>

	<div id="main">

	<form id = "main">
	<input TYPE="button" value="시험 시작" onclick="addBox(this.form)"></input>

	</FORM>
	</br>

	</div>


<SCRIPT>
	var answer = new Array();
	var exam_id = 45;
	var count = 1; 


	function reply_click(num, clicked_id){
		var ans = document.getElementById(clicked_id);
		answer[num] = ans.value;
		if (ans.value.match("①")) {
			answer[num] = 1;
		}
		else if (ans.value.match("②")) {
			answer[num] = 2;
		}
		else if (ans.value.match("③")) {
			answer[num] = 3;
		}
		else if (ans.value.match("④")) {
			answer[num] = 4;
		}
		else if (ans.value.match("⑤")) {
			answer[num] = 5;
		}
		else {
			answer[num] = ans.value;
		}
    	//console.log(answer[num]+ans.value);
  	}


	function addBox (x) {

	<?php
			$title=$_POST["temp"];
			$_SESSION["title"] = $title;
		?>
		var title = '<?php echo $title ;?>';
		console.log(title);
		$.ajax({
            url: 'http://khsung0.dothome.co.kr/WEB_project/detail_submit.php',
            data: {
                param1: title
            },
            type: 'POST',
            dataType: 'json',
            success: function(result) {
            if(result.success == false) {
                alert(result.msg);
                return;
                }
                console.log(result.data);


		

				//객관식일 경우
		for(i = 0; i < result.data.length; i++) {
			if(result.data[i].type == "c") {  

		
  				var newArea_c = document.createElement('textarea');
  				var seq_c = document.createElement('p');
				var point_text_c = document.createTextNode("(배점: "+result.data[i].score+")");
  				var point_c = document.createElement('p');
  				var seqtext_c = document.createTextNode("문제 "+count);


     
  				seq_c.appendChild(seqtext_c); 
			point_c.appendChild(point_text_c);
    			newArea_c.rows = 5;
    			newArea_c.cols = 50;
    			newArea_c.value = result.data[i].problem;
    			newArea_c.readOnly = true ;
                
				      
				seq_c.style.fontSize = "20px";
    			x.appendChild(seq_c);
    			x.appendChild(document.createElement('p'));
    			x.appendChild(point_c);
    			x.appendChild(document.createElement('p'));
    			x.appendChild(newArea_c);    			
    			x.appendChild(document.createElement('p'));
    
    			

    			for(var j=1;j<6;j++){
    				if (eval("result.data[i].ex"+j) == "") {
    					break;
    				} 
    				var bogy = document.createElement("input");
					bogy.setAttribute("type", "radio");
					bogy.setAttribute("id", "bogy"+i+j);
					bogy.setAttribute("name", "bogy"+i);
					var lblYes = document.createElement("span");
					var textYes = document.createTextNode(eval("result.data[i].ex"+j));
					lblYes.style.fontSize = "14px";
					lblYes.appendChild(textYes);
					x.appendChild(bogy);
					x.appendChild(lblYes);
					bogy.value = eval("result.data[i].ex"+j);
					bogy.setAttribute("onClick", "reply_click("+i+", this.id)")
					x.appendChild(document.createElement('br')); 
					x.appendChild(document.createElement('br')); 
  					}
  				count++;	

  				}
  				
			


  		//주관식일 경우
  			if(result.data[i].type == "e") {  
  				var newArea_e = document.createElement('textarea');
  				var answer_e = document.createElement('p');
  				var seq_e = document.createElement('p');
  				var seqtext_e = document.createTextNode("문제 "+count);
  				var answer_num_e = document.createElement("input");
  				var answer_text_e = document.createTextNode("정답: ");
				var point_text_e = document.createTextNode("(배점: "+result.data[i].score+")")
  				var point_e = document.createElement('p');
				seq_e.style.fontSize = "20px";
  				seq_e.appendChild(seqtext_e); 
			point_e.appendChild(point_text_e);
    			answer_e.appendChild(answer_text_e);
    			answer_e.appendChild(answer_num_e);
				answer_e.autocomplete="off";
    			newArea_e.rows = 10;
    			newArea_e.cols = 50;
    			answer_num_e.type = "text";
    			newArea_e.readOnly = true ;
    			newArea_e.value = result.data[i].problem;
    			answer_num_e.setAttribute("id", answer_num_e+i);
    			answer_num_e.setAttribute("onkeyup", "reply_click("+i+", this.id)")


    			x.appendChild(seq_e);
    			x.appendChild(document.createElement('p'));
    			x.appendChild(point_e);
    			x.appendChild(document.createElement('p'));
    			x.appendChild(newArea_e);
    			x.appendChild(document.createElement('p'));
    			x.appendChild(answer_e);
		

    			count++;

  			}
  	
  			x.appendChild(document.createElement('br'));
  			x.appendChild(document.createElement('br'));

		}
		var btn = document.createElement("BUTTON");
		btn.innerHTML = "시험 제출";
		x.appendChild(btn); 
		x.appendChild(document.createElement('p'));


		btn.onclick = function(){
			var sum = 0;
			
    			for(var k=0;k<result.data.length;k++){
				
    				if (result.data[k].answer == answer[k]) {
    						sum = sum + parseInt(result.data[k].score);

    				}
    			}
			
			title = 6935;

        $.ajax({
            url: 'http://khsung0.dothome.co.kr/WEB_project/detail_submit2.php',
            data: {
                param1: sum
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

			return false;
    	
		}
}
        });

	}


</SCRIPT>

</body>
</html>

