<html>
<head>
	<?php include 'header.inc' ?>
	<title>Liaison Program at Harrell HSL</title>
	<script type="text/javascript">
	var data;
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1joe4AzK7fI0hBh9XRnszAZmsVhsylKnI7PmXIbeITeA&pub=1');
	var thisyear = (new Date().getFullYear() - 3).toString();
	query.setQuery("select B, sum(H) where A > " + thisyear + " group by B pivot A");
	query.send(handleQueryResponse);
	function handleQueryResponse(response) {
		if (response.isError()) {
			alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
		return;
		}
		data = response.getDataTable();
		//alert(data.toSource());
		var options = {
			credits: {
				enabled: false
			},
			chart: {
				renderTo : 'container',
				type: 'column',
				zoomType: 'x',
				events: {
					load: Highcharts.drawTable
				},
				borderWidth: 2
			},
			title: {
				text: ''
			},
			subtitle: {
				text: 'provided by Harrell HSL'
			},
			xAxis: {
				categories: []
			},
			yAxis: {
				min: 0,
				title: {
					text: ''
				}
			},
			tooltip: '',
			plotOptions: '',
			series: []
		}

		rowno = data.getNumberOfRows();
		colno = data.getNumberOfColumns();
		monthlychart(data, options, 'Monthly Liaison-related Reference Transactions by Years', "# of Transactions");
		insertTable('querytable', data, 'Monthly Liaison-related Reference Transactions by Years', 'This table lists the monthly liaison-related reference transactions by years.');
		var chart = new Highcharts.Chart(options);
		data = null;
	}
	</script>
	<script type="text/javascript">
	var data;
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1Nnbl7lNgpjrujwzb2WNuDPoRUhkF3EAfBx5sc3uEpEg&pub=1');
	var thisyear = (new Date().getFullYear() - 3).toString();
	query.setQuery("select B, sum(J) where A > " + thisyear + " group by B pivot A");
	query.send(handleQueryResponse);
	function handleQueryResponse(response) {
		if (response.isError()) {
			alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
		return;
		}
		data = response.getDataTable();
		//alert(data.toSource());
		var options = {
			credits: {
				enabled: false
			},
			chart: {
				renderTo : 'container1',
				type: 'column',
				zoomType: 'x',
				events: {
					load: Highcharts.drawTable
				},
				borderWidth: 2
			},
			title: {
				text: ''
			},
			subtitle: {
				text: 'provided by Harrell HSL'
			},
			xAxis: {
				categories: []
			},
			yAxis: {
				min: 0,
				title: {
					text: ''
				}
			},
			tooltip: '',
			plotOptions: '',
			series: []
		}

		rowno = data.getNumberOfRows();
		colno = data.getNumberOfColumns();
		monthlychart(data, options, 'Monthly Liaison-related Instruction/Presentations by Years', "# of Transactions");
		insertTable('querytable1', data, 'Monthly Liaison-related Instruction/Presentations Transactions by Years', 'This table lists the monthly liaison-related instruction/presentations provided by Harrell HSL by years.');
		var chart = new Highcharts.Chart(options);		
		data = null;
	}
	</script>
	<script type="text/javascript">
	$(document).ready(function() {
		//Liaison Reference
		var last_year = (new Date().getFullYear() - 1).toString();		
		query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1joe4AzK7fI0hBh9XRnszAZmsVhsylKnI7PmXIbeITeA&pub=1');
		sql = "select sum(H) where A=" + last_year;
		query.setQuery(sql);
		query.send(handleQueryResponse);
		function handleQueryResponse(response) {
			data = response.getDataTable();
			if (data.getNumberOfRows == 0) {
				$("#reference").append(0);
			} else {
				$("#reference").append(addCommas(data.getValue(0,0)));
			}
		}
	});
	</script>
	<script type="text/javascript">
	$(document).ready(function() {
		var last_year = (new Date().getFullYear() - 1).toString();
		$("#last_year").append(last_year);
		
		//Liaison instructions
		var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1Nnbl7lNgpjrujwzb2WNuDPoRUhkF3EAfBx5sc3uEpEg&pub=1');
		var sql = "select sum(J), sum(K)+sum(L)+sum(M) where A=" + last_year;
		query.setQuery(sql);
		query.send(handleQueryResponse);
		function handleQueryResponse(response) {
			data = response.getDataTable();
			if (data.getNumberOfRows == 0) {
				$("#instruction_transactions").append(0);
				$("#instruction_attendance").append(0);
			} else {
				$("#instruction_transactions").append(addCommas(data.getValue(0,0)));
				$("#instruction_attendance").append(addCommas(data.getValue(0,1)));
			}
		}
	});
	</script>
</head>
<body>
<center>
	<h1><font color='#FFFFFF'>Liaison Program at Harrell HSL</font></h1>
	<br>
	<table>
		<tr><td>
			&nbsp;&nbsp;&nbsp;In addition to the academic departments at the College of Medicine, liaisons also reach out to a number of clinical departments. 
			Click <a href="https://www.libraries.psu.edu/psul/hershey/services/liaisons.html" style="color: red">here</a> to know more about our liaison program.
		</td></tr>
		<tr><td>
			&nbsp;&nbsp;&nbsp;For <span id="last_year"></span>, 
			<span id="reference"></span> liaison-related reference transactions provided. Liaisons conducted&nbsp;
			<span id="instruction_transactions"></span>&nbsp;instructional sessions touching&nbsp;
			<span id="instruction_attendance"></span>&nbsp;people.
		</td></tr>
	</table>
	<br>
	<div id="container" class="chartcontainer" style="width: 80% !important; height: 400px;" role="image" aria-label="This chart used the data from below table."></div>
	<div id="querytable"></div>
	<br>
	<div id="container1" class="chartcontainer" style="width: 80% !important; height: 400px;" role="image" aria-label="This chart used the data from below table."></div>
	<div id="querytable1"></div>
	<?php include 'footer.inc' ?>
</center>
</body>
</html>
