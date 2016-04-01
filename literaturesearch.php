<html>
<head>
	<?php include 'header.inc' ?>
	<title>Instruction/Presentations at Harrell HSL</title>
	<script type="text/javascript">
	var data;
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=163lBGpl1WzIWoBu4evBcRisJdG3DZ2hhAQzKR7X-OZ8&pub=1');
	var thisyear = (new Date().getFullYear() - 3).toString();
	query.setQuery("select B, sum(C)+sum(D)+sum(E)+sum(F)+sum(G) where A > " + thisyear + " group by B pivot A label sum(C)+sum(D)+sum(E)+sum(F)+sum(G) 'Transactions'");
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
				text: 'provided by Harrell HSL faculty'
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
			monthlychart(data, options, 'Monthly Literature Searches by Years', "# of Transactions");
			insertTable('querytable', data, 'Monthly In-depth Literature Searches by Years', 'This table lists the monthly literature searches provided by Harrell HSL faculty by years.');
		} else if (selection == 1) {
			totalchart(data, options, 'Total Literature Searches by Years', "# of Transactions");
			insertTable('querytable', data, 'Total In-depth Literature Searches by Years', 'This table lists the total number of in-depth literature searches provided by Harrell HSL faculty by years.');
		} else if (selection == 2) {
			typechart(data, options, 'Literature Searches By Type (If Known)', 'Type of Literature Searches');
			insertTable('querytable', data, 'Literature Searches By Type', 'This table lists the number of in-depth literature searches provided by Harrell HSL faculty by types if known.');
		}
		var chart = new Highcharts.Chart(options);
		data = null;
	}
	google.setOnLoadCallback(sendAndDrawTable);
	</script>
</head>
<body>
<center>
	<h1><font color='#FFFFFF'>In-depth Literature Searches by Harrell HSL faculty</font></h1>
	<br>
	<table width=80%>
		<tr><td>
		In-depth literature searches are searches performed by librarians to help users to find the information they need for research, teaching, or patient care. These searches are often by request or in cooperation with a user or team.
		</td></tr>
	</table>	
	<form action="">
	<div class="querybox">
		<querytext>Select a report:</querytext>
		<pivotoptions>
			<select id='pivot' onchange="formQuery(this.value);">
			<option value="Literature Searches Monthly">Monthly Literature Searches by Years</option>
			<option value="Literature Searches Total">Total Literature Searches by Years</option>
			<option value="Literature Searches Type">Literature Searches By Type</option>
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
		case 'Literature Searches Monthly':
			query = "select B, sum(C)+sum(D)+sum(E)+sum(F)+sum(G) where A > " + thisyear + " group by B pivot A label sum(C)+sum(D)+sum(E)+sum(F)+sum(G) 'Transactions'";
			break;
		case 'Literature Searches Total':
			query = "select A, sum(C)+sum(D)+sum(E)+sum(F)+sum(G) where A > " + thisyear + " group by A label sum(C)+sum(D)+sum(E)+sum(F)+sum(G) 'Total Transactions'";
			break;
		case 'Literature Searches Type':
			query = "select sum(C), sum(D), sum(E), sum(F), sum(G) where A > " + thisyear + " label sum(C) 'Clinical Work', sum(D) 'Research & Publication', sum(E) 'Grant-related', sum(F) 'Teaching & Education', sum(G) 'Others'";
			break;
		default:
			query = "select B, sum(C)+sum(D)+sum(E)+sum(F)+sum(G) where A > " + thisyear + " group by B pivot A label sum(C)+sum(D)+sum(E)+sum(F)+sum(G) 'Transactions'";
			break;
	}
	setQuery(query);
}
</script>
</body>
</html>
