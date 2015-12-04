<html>
<head>
	<?php include 'header.inc' ?>
	<title>Reference Transactions at Harrell HSL</title>
	<script type="text/javascript">
	var data;
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1joe4AzK7fI0hBh9XRnszAZmsVhsylKnI7PmXIbeITeA&pub=1');
	var thisyear = (new Date().getFullYear()-3).toString();
	query.setQuery("select B, sum(C) where A > " + thisyear + " group by B pivot A");
	query.send(handleQueryResponse);
	function handleQueryResponse(response) {
		if (response.isError()) {
			alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
		return;
		}
		data = response.getDataTable();

		var options = {
			credits: {
				enabled: false
			},
			chart: {
				renderTo : 'container',
				type: 'column',
				zoomType: 'x',
				height: 400,
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
		var selection = document.getElementById('pivot').selectedIndex;
		if (selection == 0) {
			monthlychart(data, options, 'Monthly Reference Transactions by Years', "# of Transactions");
			insertTable('querytable', data, 'Monthly Reference Transactions by Years', 'This table lists the monthly reference transactions by years.');
		} else if (selection == 1) {
			totalchart(data, options, 'Total Reference Transactions by Years', "# of Transactions");
			insertTable('querytable', data, 'Total Reference Transactions by Years', 'This table lists the total number of reference transactions by years.');
		} else if (selection == 2) {
			typechart(data, options, 'Reference Transactions By Type', 'Type of Presentation');
			insertTable('querytable', data, 'Reference Transactions By Type', 'This table lists the number of transactions for each reference type.');
		}
		var chart = new Highcharts.Chart(options);
		data = null;
	}
	google.setOnLoadCallback(sendAndDrawTable);
	</script>
</head>
<body>
<center>
	<h1><font color='#FFFFFF'>Reference Transactions at Harrell HSL</font></h1>
	<br>
	<table>
		<tr><td>
		&nbsp;&nbsp;&nbsp;Reference Transactions is the total number of questions of all types answered by staff and faculty of the George T. Harrell Health Sciences Library.
		</td></tr>
	</table>	
	<form action="">
	<div class="querybox">
		<querytext>Select a report:</querytext>
		<pivotoptions>
			<select id='pivot' onchange="formQuery(this.value);">
			<option value="Reference Monthly">Monthly Transactions by Years</option>
			<option value="Reference Total">Total Transactions by Years</option>
			<option value="Reference Type">Transactions By Type</option>
			</select>
		</pivotoptions>
	</div>
	</form>	
	<div id="container" class="chartcontainer" style="width: 80% !important; height: 400px;" role="image" aria-label="This chart used the data from below table."></div>
	<div id="querytable"></div>
</center>
<script>
function formQuery(opt) {
	var query = '';
	var thisyear = (new Date().getFullYear()-3).toString();
	
	switch(opt) {
		case 'Reference Monthly':
			query = "select B, sum(C) where A > " + thisyear + " group by B pivot A";
			break;
		case 'Reference Total':
			query = "select A, sum(C) where A > " + thisyear + " group by A label sum(C) 'Total Transactions'";
			break;
		case 'Reference Type':
			query  = "select sum(D), sum(E), sum(F), sum(G), sum(H) where A > " + thisyear + " label sum(D) 'Technical Problems', sum(E) 'Policy', sum(F) 'Where is', sum(G) 'Reference', sum(H) 'Liaison Related'";
			break;
		default:
			query = "select B, sum(C) where A > " + thisyear + " group by B pivot A";
	}
	setQuery(query);
}
</script>
</body>
</html>
