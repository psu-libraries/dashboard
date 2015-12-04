<html>
<head>
	<?php include 'header.inc' ?>
	<title>Harrell HSL Gate Count</title>
	<script type="text/javascript">
	var data;
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1qZBHNg9HHWTAQzVC2COEXbDykQXj37Kw2KSd6JoqClY&pub=1');
	var thisyear = (new Date().getFullYear() - 3).toString();
	query.setQuery("select B, sum(C) where A > " + thisyear + " group by B pivot A label sum(C) 'Gate Count'");
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
				text: 'at Harrell HSL'
			},
			xAxis: {
				categories: []
			},
			yAxis: {
				min: 0,
				title: {
					text: '# of Visits'
				}
			},
			tooltip: '',
			plotOptions: '',
			series: []
		}

		rowno = data.getNumberOfRows();
		colno = data.getNumberOfColumns();
		var selection = document.getElementById('pivot').selectedIndex;
		if (selection == 0) {
			monthlychart(data, options, 'Monthly Gate Count by Years', "# of Visits");
			insertTable('querytable', data, 'Monthly Gate Count by Years', 'This table lists the monthly visits to Harrell HSL by years.');
		} else if (selection == 1) {
			totalchart(data, options, 'Total Gate Count By Years', '# of Visits');
			insertTable('querytable', data, 'Total Gate Count by Years', 'This table lists the total visits to Harrell HSL.');
		}	
		var chart = new Highcharts.Chart(options);
		data = null;
	}
	google.setOnLoadCallback(sendAndDrawTable);
	</script>
</head>
<body>
	<h1><font color='#FFFFFF'>Harrell HSL Gate Count</font></h1>
	<br>
	<table>
		<tr><td>
		&nbsp;&nbsp;&nbsp;The gate count statistics are collected by a sensor at the library entrance.  The count is then saved and divided in half to negate that users walk in and out of the same entrance.
		</td></tr>
	</table>
	<form action="">
	<div class="querybox">
		<querytext>Select a report:</querytext>
		<pivotoptions>
			<select id='pivot' onchange="formQuery(this.value);">
			<option value="Gate Count Monthly">Monthly Gate Count by Years</option>
			<option value="Gate Count Total">Total Gate Count by Years</option>
			</select>
		</pivotoptions>
	</div>
	</form>
	<div id="container" class="chartcontainer" style="width: 80% !important; height: 400px;" role="image" aria-label="This chart used the data from below table."></div>
	<div id="querytable"></div>
<script>
function formQuery(opt) {
	var query = '';
	var thisyear = (new Date().getFullYear() - 3).toString();
	
	switch(opt) {
		case 'Gate Count Monthly':
			query = "select B, sum(C) where A > " + thisyear + " group by B pivot A label sum(C) 'Gate Count'";
			break;
		case 'Gate Count Total':
			query = "select A, sum(C) where A > " + thisyear + " group by A label sum(C) 'Total Gate Count'";
			break;
		default:
			query = "select B, sum(C) where A > " + thisyear + " group by B pivot A label sum(C) 'Gate Count'";
			break;
	}
	setQuery(query);
}
</script>
</body>
</html>
