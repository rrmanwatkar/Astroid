
	<?php
		error_reporting(0);
		if(isset($_GET['startDateValue']) && isset($_GET['endDateValue'])){
			$start_date = $_GET['startDateValue'];
			$end_date = $_GET['endDateValue'];

			$apiKey = 'QUkE9Py9oPYpvfBw6OCbk6cox33CkIxCsvPWEZBd';
			$url = 'https://api.nasa.gov/neo/rest/v1/feed?start_date='.$_GET['startDateValue'].'&end_date='.$_GET['endDateValue'].'&api_key='.$apiKey;
			$e_json = file_get_contents($url);
			$array = json_decode($e_json, true);
			/*echo "<pre>";
			print_r($array);*/
			
			
			$near_earth_objects = $array;
			$earth = $near_earth_objects['near_earth_objects'];
			
			$s_date = substr($start_date,8);
			//echo ($s_date);
			$l_date = substr($end_date,8);
			//echo ($l_date);
			$diff = ($l_date - $s_date)+1;

			
				/*foreach ($earth as $keye => $valuee) {
					echo "<pre>";
					print_r($keye);
				}*/



			/*foreach ($earth as $key => $valuee ) {
				//echo "<pre>";
					echo ($key)."<br>";
				
				foreach ($valuee as $key1 => $value1) {
					echo $key1."-";

					echo $value1['neo_reference_id']."<br>";
					
					
					//print_r($value1['estimated_diameter']['kilometers']['estimated_diameter_max']);
					//$im = implode(',',$value1['estimated_diameter']['kilometers']['estimated_diameter_max']);
					//echo $value1['estimated_diameter']['kilometers']['estimated_diameter_max']."<br>";
					
					
					

				
			}*/
				


			
			
			/*foreach($near_earth_objects[$_GET['startDateValue']] as $key){
				echo $key['neo_reference_id']."<br>";
			}*/

			




			/*echo "<pre>";
			print_r($array);
			$startDateArray = explode("-",$_GET['startDateValue']);
			$startDay = $startDateArray[2];
			//print_r($startDay);
			
			$endDateArray = explode("-",$_GET['endDateValue']);
			$endDay = $endDateArray[2];
			//print_r($endDay);
			$numDays = ($endDay - $startDay) + 1;
			//echo $numDays;
			foreach ($array['near_earth_objects'] as $key) {
				for($i = 0; $i<$numDays; $i++){
					echo "<pre>";
				print_r($key[$i]);
				$NEOarray = $key[$i];
				$NEOclose = $NEOarray[0];
				echo "<pre>";
				print_r($NEOarray);


				var NEOclose = NEOarray[Object.keys(NEOarray)[0]];
	            var NEOCAD = NEOclose.close_approach_data;
	            var NEOCADdate = NEOCAD[Object.keys(NEOCAD)[0]];
	            var capString = NEOCADdate.close_approach_date;*/

		
					
			
			


			

		}
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<title></title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style type="text/css">
		td{
			text-align: center;
		}
	</style>
	</head>
	<body>
		<div class="container" align="center">
			<form action="" class="form-inline">		     
			        <legend>Date Input (YYYY-MM-DD)</legend>
			        <div class="form-group">
						<label for="email">Start Date:</label>
				        <input type="date" name="startDateValue" id="startDateValue">
			    	</div>
			       <div class="form-group">
			        <label for="endDateValue"> End Date</label>
			        <input type="date" name="endDateValue" id="endDateValue">
			       </div>
			        <input type="submit" name="submit" id="dateInput">

			    

			</form>
			    
			    	<?php
						foreach ($earth as $key => $valuee ) {
						//echo "<pre>";
							
							?>
							<table border="2">
					<tr>
			    		<th>Asteroid Name</th>
			    		<th>Fastest Asteroid (km/h)</th>
			    		<th>Closest Asteroid (in distance)</th>
			    		<th>Average Size</th>
			    	</tr>
			    	
			    		<?php
						
						foreach ($valuee as $key1 => $value1) {
							foreach ($value1['close_approach_data'] as $keyclose) {
								//echo $keyclose['relative_velocity']['kilometers_per_hour'];
							
							
							echo "<tr>";
							echo "<td>".$value1['name']."</td>";
							echo "<td>".$keyclose['relative_velocity']['kilometers_per_hour']."</td>";
							echo "<td>".$keyclose['miss_distance']['miles']."</td>";
							echo "<td>".$value1['estimated_diameter']['kilometers']['estimated_diameter_min']."</td>";
							echo "</tr>";
							}
							
						}
							echo "<br>";
							echo "<b>Date: ".$key."</b><br>";
							echo "</table>";
						}
			    		?>
			    
			
		</div>

	</body>
	</html>

