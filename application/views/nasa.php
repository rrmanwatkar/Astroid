<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container" align="center">
		<form class="form-inline">		     
		        <legend>Date Input (YYYY-MM-DD)</legend>
		        <div class="form-group">
					<label for="email">Start Date:</label>
			        <input type="date" name="startDateValue" id="startDateValue">
		    	</div>
		       <div class="form-group">
		        <label for="endDateValue"> End Date</label>
		        <input type="date" name="endDateValue" id="endDateValue">
		       </div>
		        <input type="submit" id="dateInput">

		    

		</form>
		    <div id="tableHeader" style="border:1px solid black;"></div>
	</div>
	<script type="text/javascript">
		var apiKey = 'QUkE9Py9oPYpvfBw6OCbk6cox33CkIxCsvPWEZBd'; // this is the key i genrated 
		var dd = 'https://api.nasa.gov/neo/rest/v1/feed?start_date=2020-05-13&end_date=2020-05-14&api_key=QUkE9Py9oPYpvfBw6OCbk6cox33CkIxCsvPWEZBd';
		//alert(dd);

				      document.addEventListener('DOMContentLoaded', submitButtonsReady);

				      function submitButtonsReady(){
				        document.getElementById('dateInput').addEventListener('click', function(event){
				          var request = new XMLHttpRequest();
				          var startDate = document.getElementById('startDateValue').value;
				          var endDate = document.getElementById('endDateValue').value;

				          var startDateArray = startDate.split("-");
				          var startDay = startDateArray[2];
				          var endDateArray = endDate.split("-");
				          var endDay = endDateArray[2];
				          startNum = Number(startDay);
				          endNum = Number(endDay);
				          var numDays = (endNum - startNum) + 1;

				          var tableHeader = document.getElementById("tableHeader");
				            var myNode = document.getElementById("tableHeader");
				            while (myNode.firstChild) 
				            {
				              myNode.removeChild(myNode.firstChild);
				            }

				          request.open('GET', 'https://api.nasa.gov/neo/rest/v1/feed?start_date=' + startDate +'&end_date='+ endDate +'&api_key=' + apiKey, true);
				          request.addEventListener('load',function(){
				           if(request.status >= 200 && request.status < 400){
				              var response = JSON.parse(request.responseText);
				              var neoObj = response.near_earth_objects;
				              
				              for(var count = 0; count < numDays; count++)
				              {
				                var NEOarray = neoObj[Object.keys(neoObj)[count]];
				                var NEOclose = NEOarray[Object.keys(NEOarray)[0]];
				                var NEOCAD = NEOclose.close_approach_data;
				                var NEOCADdate = NEOCAD[Object.keys(NEOCAD)[0]];
				                var capString = NEOCADdate.close_approach_date;

				                var newTable = document.createElement("table");
				                newTable.setAttribute('border', '1');
				                newTable.setAttribute('align', 'center');

				                var tableCap = document.createElement("caption");
				                tableCap.textContent = "Date: " + capString;
				                var row1 = document.createElement("tr");
				                var header1 = document.createElement("th");
				                header1.textContent = "Asteroid Name";
				                var header2 = document.createElement("th");
				                header2.textContent = "Fastest Asteroid  (km/h)";
				                var header3 = document.createElement("th");
				                header3.textContent = "Closest Asteroid  (in distance)";
				                var header4 = document.createElement("th");
				                header4.textContent = "Average Size";
				                //var header4 = document.createElement("th");
				                //header4.textContent = "Link";
				                row1.appendChild(header1);
				                row1.appendChild(header2);
				                row1.appendChild(header3);
				                row1.appendChild(header4);
				                newTable.appendChild(tableCap);
				                newTable.appendChild(row1);

				                for(var index = 0; index < NEOarray.length; index++)
				                {
				                  var row2 = document.createElement("tr");
				                  var data1 = document.createElement("td");
				                  data1.setAttribute("id", "cell1");
				                  data1.textContent = NEOarray[index].name;
				                  var data2 = document.createElement("td");
				                  data2.textContent = NEOarray[index].close_approach_data[0].relative_velocity.kilometers_per_hour;
				                  var data3 = document.createElement("td");
				                  data3.textContent = NEOarray[index].close_approach_data[0].miss_distance.miles;
				                  var data4 = document.createElement("td");
				                  data4.textContent = NEOarray[index].estimated_diameter.kilometers.estimated_diameter_min;
				                 // var data4 = document.createElement("td");

				                  /*var NEOlink = document.createElement("a");
				                  var linkText = document.createTextNode("Additional Info");
				                  NEOlink.appendChild(linkText);
				                  NEOlink.title = "Additional Info";
				                  NEOlink.href = NEOarray[index].nasa_jpl_url;
				                  NEOlink.target = "_blank";
				                  data4.appendChild(NEOlink);*/

				                  row2.appendChild(data1);
				                  row2.appendChild(data2);
				                  row2.appendChild(data3);
				                  row2.appendChild(data4);
				                  newTable.appendChild(row2);
				                }
				              tableHeader.appendChild(newTable);
				              }
				            } 
				            else 
				            { 
				                  console.log("Error in network request: " + request.statusText);
				             }});
				          request.send(null);
				          event.preventDefault();
				        })
				      }
	</script>
</body>
</html>

