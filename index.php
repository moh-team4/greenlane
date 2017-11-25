
<!DOCTYPE html>
<html>
	<head>
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
		
	<body>

		<div id="my_div"></div>
		

		<script type="text/javascript">

			function loadDoc() {
			  var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			     document.getElementById("my_div").innerHTML = this.responseText;
			    }
			  };
			  xhttp.open("GET", "./passengers.php", true);
			  xhttp.send();
			}

			setInterval(function(){
				loadDoc();				
			},1000);
			// jQuery code to call website (using ajax). */
			//	setInterval(function(){
			//	   $('#my_div').load('./passengers.php');
			//	   alert();
			//	}, 1000) /* time in milliseconds (ie 2 seconds)
//
		</script>
	</body>
</html> 