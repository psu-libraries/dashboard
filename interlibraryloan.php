<html>
<head>
	<?php include 'header.inc' ?>
	<title>Interlibrary Loan and Intercampus Loan</title>
	<script type="text/javascript">
	var data;
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1mIKqXdFJRJ2_RjriFwLTqQEogcAqaRZFw7ApP4FDh_A&pub=1');
	var thisyear = (new Date().getFullYear() - 3).toString();
	query.setQuery("select B, sum(C), sum(D) where A > " + thisyear + " group by B pivot A label sum(C) 'Filled', sum(D) 'Not Filled'");
	query.send(handleQueryResponse);
	function handleQueryResponse(response) {
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
				text: 'through Interlibrary Loan Service'
			},
			xAxis: {
				categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
			},
			yAxis: {
				min: 0,
				title: {
					text: '# of Items'
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
			stackedchart(data, options, 'Monthly Borrowed Items by Years', "# of Items");
			insertTable('querytable', data, 'Monthly Borrowed Items by Years', 'This table lists the monthly borrowed items through Interlibrary Loan by years.');
		} else if (selection == 1) {
			stackedchart(data, options, 'Monthly Lended Items by Years', "# of Items");
			insertTable('querytable', data, 'Monthly Lended Items by Years', 'This table lists the monthly lended items through Interlibrary Loan by years.');
		} else if (selection == 2) {
			monthlychart(data, options, 'Monthly Intercampus Loan by Years', "# of Items");
			insertTable('querytable', data, 'Monthly Intercampus Loan by Years', 'This table lists the monthly borrowed items from other PSU campuses by years.');
		} else if (selection == 3) {
			totalchart(data, options, 'Total Interlibrary Loan Items by Years', "# of Items");
			insertTable('querytable', data, 'Total Interlibrary Loan Items by Years', 'This table lists the total items provided through interlibrary loan service by years.');
		} else if (selection == 4) {
			totalchart(data, options, 'Total Intercampus Loan Items by Years', "# of Items");
			insertTable('querytable', data, 'Total Intercampus Loan Items by Years', 'This table lists the total items borrowed from other PSU campuses by years.');
		}
		var chart = new Highcharts.Chart(options);
		data = null;
	};
	</script>
</head>
<body>
<center>
	<h1><font color='#FFFFFF'>Interlibrary Loan & Intercampus Loan</font></h1>
	<br>
	<table>
		<tr><td>
		&nbsp;&nbsp;&nbsp;Interlibrary Loan services allow our patrons to access collections from other libraries to supplement what we have locally, and also provides users from other libraries to benefit from our Collection here at the Harrell Health Sciences Library.  We partner with libraries nationally and internationally.
		</td></tr>
		<tr><td>
		&nbsp;&nbsp;&nbsp;Intercampus Loan provides Penn State Hershey Users access to the depth and breadth of University Libraries collections accross 24 campuses for free.
		</td></tr>
	</table>
	<form action="">
	<div class="querybox">
		<querytext>Select a report:</querytext>
		<pivotoptions>
			<select id='pivot' onchange='formQuery(this.value);'>
			<option value="ILL Borrowing Monthly">Monthly ILL Borrowing by Years</option>
			<option value="ILL Lending Monthly">Monthly ILL Lending by Years</option>
			<option value="InterCampus Monthly">Monthly Inter-campus Loan by Years</option>
			<option value="ILL Total">Total Interlibrary Loan by Years</option>
			<option value="InterCampus Total">Total Intercampus Loan by Years</option>
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
	var thisyear = (new Date().getFullYear() - 3).toString();
	
	switch(opt) {
		case 'ILL Borrowing Monthly':
			query = "select B, sum(C), sum(D) where A > " + thisyear + " group by B pivot A label sum(C) 'Filled', sum(D) 'Not Filled'";
			break;
		case 'ILL Lending Monthly':
			query = "select B, sum(E), sum(F) where A > " + thisyear + " group by B pivot A label sum(E) 'Filled', sum(F) 'Not Filled'";
			break;
		case 'InterCampus Monthly':
			query = "select B, sum(G) where A > " + thisyear + " group by B pivot A";
			break;
		case 'ILL Total':
			query = "select A, sum(C)+sum(D)+sum(E)+sum(F) where A > " + thisyear + " group by A label sum(C)+sum(D)+sum(E)+sum(F) 'Total Transactions'";
			break;
		case 'InterCampus Total':
			query = "select A, sum(G) where A > " + thisyear + " group by A label sum(G) 'Total Intercampus Items'";
			break;
		default:
			"select B, sum(C), sum(D) where A > " + thisyear + " group by B pivot A label sum(C) 'Filled', sum(D) 'Not Filled'";
	}
	setQuery(query);
}
</script>
</body>
</html>
