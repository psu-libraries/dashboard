<html>
<head>
	<?php include 'header.inc' ?>
	<title>Instruction/Presentations at Harrell HSL</title>
	<script type="text/javascript">
	var data;
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1Nnbl7lNgpjrujwzb2WNuDPoRUhkF3EAfBx5sc3uEpEg&pub=1');
	var thisyear = (new Date().getFullYear()-3).toString();
	query.setQuery("select B, sum(C)+sum(D)+sum(E)+sum(F) where A > " + thisyear + " group by B pivot A label sum(C)+sum(D)+sum(E)+sum(F) 'Transactions'");
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
				text: 'provided to student, faculty, and staff by Harrell HSL'
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
			monthlychart(data, options, 'Monthly Instruction/Presentations Transactions by Years', "# of Transactions");
			insertTable('querytable', data, 'Monthly Instruction/Presentations Transactions by Years', 'This table lists the monthly instruction/presentations provided by Harrell HSL by years.');
		} else if (selection == 1) {
			stackedchart(data, options, 'Monthly Instruction/Presentations Attendance by Years', "# of Transactions");
			insertTable('querytable', data, 'Monthly Instruction/Presentations Attendance by Years', 'This table lists the monthly attendance of the instruction/presentations provided by Harrell HSL by years.');
		} else if (selection == 2) {
			totalchart(data, options, 'Total Instruction/Presentations Transactions by Years', "# of Transactions");
			insertTable('querytable', data, 'Total Transactions by Years', 'This table lists the total number of instruction/presentations provided by Harrell HSL by years.');
		} else if (selection == 3) {
			typechart(data, options, 'Instruction/Presentations By Type', 'Type of Instruction/Presentations');
			insertTable('querytable', data, 'Instruction/Presentations By Type', 'This table lists the number of instruction/presentations provided by Harrell HSL by types.');
		}
		var chart = new Highcharts.Chart(options);
		data = null;
	}
	google.setOnLoadCallback(sendAndDrawTable);
	</script>
</head>
<body>
<center>
	<h1><font color='#FFFFFF'>Instruction/Presentations at Harrell HSL</font></h1>
	<br>
	<table width=80%>
		<tr><td>
		Library faculty teach and lead presentations for many different groups, from instructional sessions incorporated into courses in the graduate, medical, and nursing curricula to custom-designed sessions on a number of topics for faculty and staff. We can provide instruction on topics such as:
		</td></tr>
		<tr><td>
		&nbsp;&nbsp;&nbsp;· Citation management software such as EndNote and Mendeley
		</td></tr>
		<tr><td>
		&nbsp;&nbsp;&nbsp;· Copyright
		</td></tr>
		<tr><td>
		&nbsp;&nbsp;&nbsp;· Use of evidence-based practice information resources
		</td></tr>
		<tr><td>
		&nbsp;&nbsp;&nbsp;· NIH public access mandates
		</td><tr>
		<tr><td>
		&nbsp;&nbsp;&nbsp;· The systematic review searching process
		</td></tr>
		<tr><td>&nbsp;&nbsp;&nbsp;· Effective literature searching techniques
		</td></tr>
		<tr><td>
		<a href="https://www.libraries.psu.edu/psul/hershey/services/training.html">Contact us</a> to schedule one-on-one or group instruction.
		</td></tr>
	</table>	
	<form action="">
	<div class="querybox">
		<querytext>Select a report:</querytext>
		<pivotoptions>
			<select id='pivot' onchange="formQuery(this.value);">
			<option value="Instruction Monthly">Monthly Transactions by Years</option>
			<option value="Instruction Attendance Monthly">Monthly Attendance by Years</option>
			<option value="Instruction Total">Total Transactions by Years</option>
			<option value="Instruction Type">Transactions By Type</option>
			</select>
		</pivotoptions>
	</div>
	</form>	
	<div id="container" class="chartcontainer" style="width: 80% !important; height: 400px;" role="image" aria-label="This chart used the data from below table."></div>
	<div id="querytable"></div>
	<?php include 'footer.inc' ?>
</center>
<script>
function formQuery(opt) {
	var query = '';
	var thisyear = (new Date().getFullYear()-3).toString();
	
	switch(opt) {
		case 'Instruction Monthly':
			query = "select B, sum(C)+sum(D)+sum(E)+sum(F) where A > " + thisyear + " group by B pivot A label sum(C)+sum(D)+sum(E)+sum(F) 'Transactions'";
			break;
		case 'Instruction Attendance Monthly':
			query = "select B, sum(G), sum(H), sum(I) where A > " + thisyear + " group by B pivot A label sum(G) 'In-Person', sum(H) 'Virtually Sync', sum(I) 'Virtually Async'";
			break;
		case 'Instruction Total':
			query = "select A, sum(C)+sum(D)+sum(E)+sum(F) where A > " + thisyear + " group by A label sum(C)+sum(D)+sum(E)+sum(F) 'Total Transactions'";
			break;
		case 'Instruction Type':
			query  = "select sum(C), sum(D), sum(E), sum(F) where A > " + thisyear + " label sum(C) 'Course Integrated', sum(D) 'Events', sum(E) 'Orientation', sum(F) 'Presentation'";
			break;
		default:
			query = "select B, sum(C)+sum(D)+sum(E)+sum(F) where A > " + thisyear + " group by B pivot A label sum(C)+sum(D)+sum(E)+sum(F) 'Transactions'";
	}
	setQuery(query);
}
</script>
</body>
</html>
