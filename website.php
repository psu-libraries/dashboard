<html>
<head>
	<?php include 'header.inc' ?>
	<title>Harrell HSL Website Traffic</title>
	<script type="text/javascript">
	var data;
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1NCktC5wjJGdgNoXMZEQiJNk16PRwESXH0pkQjP9sVfM&pub=1');
	var thisyear = Math.max(new Date().getFullYear()-3, 2014).toString();
	query.setQuery("select B, sum(C)+sum(F), sum(D)+sum(G), sum(E)+sum(H) where A > " + thisyear + " group by B pivot A label sum(C)+sum(F) 'Sessions', sum(D)+sum(G) 'Users', sum(E)+sum(H) 'Pageviews'");
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
				text: 'at Harrell HSL Website'
			},
			xAxis: {
				categories: []
			},
			yAxis: {
				min: 0,
				title: {
					text: '# of Sessions/Users/Pageviews'
				}
			},
			tooltip: '',
			plotOptions: '',
			series: []
		}

		rowno = data.getNumberOfRows();
		colno = data.getNumberOfColumns();
		var selection = document.getElementById('pivot').selectedIndex;
		
		//Since display data starts from 2015, so in 2015 only display one year of data. Show this in caption & description.
		var year = "by years";
		if (new Date().getFullYear() == 2015) {
			year = "for 2015";
		}
		if (selection == 0) {
			stackedchart(data, options, 'Monthly Website Traffic '+year, "#s");
			insertTable('querytable', data, 'Monthly Website Traffic '+year, 'This table lists the monthly traffic to the Harrell HSL website '+year);
		} else if (selection == 1) {
			totalchart(data, options, 'Total Website Traffic '+year, '# of Visits');
			insertTable('querytable', data, 'Total Website Traffic '+year, 'This table lists the total traffic to the Harrell HSL website '+year);
		}	
		var chart = new Highcharts.Chart(options);
		data = null;
	}
	google.setOnLoadCallback(sendAndDrawTable);
	</script>
</head>
<body>
<center>
	<h1><font color='#FFFFFF'>Harrell HSL Website Traffic</font></h1>
	<br>
	<table>
		<tr><td>
		&nbsp;&nbsp;&nbsp;We track our website traffic with Google Analytics. The following data are the number of sessions, users, page views we received on Harrell HSL website and LibGuides.
		</td></tr>
	</table>	
	<form action="">
	<div class="querybox">
		<querytext>Select a report:</querytext>
		<pivotoptions>
			<select id='pivot' onchange="formQuery(this.value);">
			<option value="Website Monthly">Monthly Website Traffic by Years</option>
			<option value="Website Total">Total Website Traffic by Years</option>
			</select>
		</pivotoptions>
	</div>
	</form>	
	<div id="container" class="chartcontainer" style="width: 80% !important; height: 400px;"role="image" aria-label="This chart used the data from below table."></div>
	<div id="querytable"></div>
	<h4><font color='#FFFFFF'>*Incomplete data available from January, 2015 to March, 2015, showing lower totals than actual.</font></h4>
	<?php include 'footer.inc' ?>
</center>
<script>
function formQuery(opt) {
	var query = '';
	var thisyear = Math.max(new Date().getFullYear()-3, 2014).toString();
	
	switch(opt) {
		case 'Website Monthly':
			query = "select B, sum(C)+sum(F), sum(D)+sum(G), sum(E)+sum(H) where A > " + thisyear + " group by B pivot A label sum(C)+sum(F) 'Sessions', sum(D)+sum(G) 'Users', sum(E)+sum(H) 'Pageviews'";
			break;
		case 'Website Total':
			query = "select A, sum(C)+sum(F), sum(D)+sum(G), sum(E)+sum(H) where A > " + thisyear + " group by A label sum(C)+sum(F) 'Total Sessions', sum(D)+sum(G) 'Total Users', sum(E)+sum(H) 'Total Pageviews'";
			break;
		default:
			query = "select B, sum(C)+sum(F), sum(D)+sum(G), sum(E)+sum(H) where A > " + thisyear + " group by B pivot A label sum(C)+sum(F) 'Sessions', sum(D)+sum(G) 'Users', sum(E)+sum(H) 'Pageviews'";
			break;
	}
	setQuery(query);
}
</script>
</body>
</html>
