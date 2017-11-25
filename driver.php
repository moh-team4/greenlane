
<?php

 // Access db file
	$dbfile = "passengers.db"; // path to data file
	$expire = 10; // average time in seconds to consider someone online before removing from the list
	 
	if(!file_exists($dbfile)) {
		die("Error: Data file " . $dbfile . " NOT FOUND!");
	}
	 
	if(!is_writable($dbfile)) {
		die("Error: Data file " . $dbfile . " is NOT writable! Please CHMOD it to 666!");
	}

function CountVisitors() {
	global $dbfile, $expire;
	$cur_ip = getIP();
	$cur_time = time();
	$dbary_new = array();
	 
	$dbary = unserialize(file_get_contents($dbfile));
	if(is_array($dbary)) {
		while(list($user_ip, $user_time) = each($dbary)) {
			if(($user_ip != $cur_ip) && (($user_time + $expire) > $cur_time)) {
				$dbary_new[$user_ip] = $user_time;
			}
		}
	}

	$dbary_new[$cur_ip] = $cur_time; // add record for current user
	 
	$fp = fopen($dbfile, "w");
	fputs($fp, serialize($dbary_new));
	fclose($fp);
	 
	$out = sprintf("%03d", count($dbary_new)); // format the result to display 3 digits with leading 0's
	return $out;
}
 
function getIP() {
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	elseif(isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];
	else $ip = "0";
	return $ip;
}
 
	$passengers_loggedin = CountVisitors();
	$threshold = 4;
?>
		
	<body style="background-color:#eeeded;">

		<div id="header" style="background-color:#000;height:50px; text-align:center">
			<img src="./graphics/logo.png" style="height:40px;padding:10px;margin:0 auto"/>
		</div>

			<?php if($passengers_loggedin > $threshold){ ?>
				<div style="margin:0px auto;background-color:#49841d; width: 240px;">
					<div style="float:left; color:#fff;padding:4px;">
						<b>Using Priority Lane </b>
					</div>
					<img src="./graphics/ic.cancel.png" style="height:20px;width:20px;padding:1px;margin:2px"/>	
					<div style="clear:left"></div>
				</div>
			<?php } ?>

		<div id="" style="text-align: center;padding:15px">
				<h1> Driver </h1>
				<img src="./graphics/licenceplate.png" style="height:40px;padding:10px;margin:auto"/>
				<br />

				Checked in Passengers:

				<div style="width:96px; margin: 4px auto;">
					<div class="circle <?php if($passengers_loggedin > 1){ echo 'full';} ?>"></div>
					<div class="circle <?php if($passengers_loggedin > 2){ echo 'full';} ?>"></div>
					<div class="circle <?php if($passengers_loggedin > 3){ echo 'full';} ?>"></div>
					<div class="circle <?php if($passengers_loggedin > 4){ echo 'full';} ?>"></div>
					<div style="clear:left"></div>
				</div>

				<?php if($passengers_loggedin < $threshold + 1){ ?>
					<br />
					You can enter the priority lane <br /> 
					with <b><?php echo $threshold; ?> passengers</b>.
				<?php } ?>

				<br />
				<img src="./graphics/img.map.lane.png" style="width:250px;padding:10px;margin: 20px auto"/>
				
		</div>

		
	</body>
