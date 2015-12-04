<html>
<head>
	<?php include 'header.inc' ?>
	<title>Top Ten Biomedical Journals</title>
	<script type="text/javascript">
	var data;
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1z1Sq8Z-uzRRmGi_u6rzxqdaNUm_1bL99bIuZx2F9-OA&pub=1');
	var thisyear = (new Date().getFullYear()-3).toString();
	var sql = "select A, sum(C),sum(D),sum(E),sum(F),sum(G),sum(H),sum(I),sum(J) where A > " + thisyear + " group by A";
	query.setQuery(sql);
	query.send(handleQueryResponse);

	function handleQueryResponse(response) {
		if (response.isError()) {
			alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
		return;
		}
		data = response.getDataTable();
		//alert(data.toSource());
		rowno = data.getNumberOfRows();
		colno = data.getNumberOfColumns();
		for (var i=1; i<colno; i++) {
			var label = data.getColumnLabel(i);
			var res = label.split('http://');
			var name = res[0].substring(4);
			res = res[1].split(" ");
			var url = res[0];
			data.setColumnLabel(i, "<a href='"+url+"' style='color: #000000'>"+name+"</a>");
		}
		data.setColumnLabel(0, 'Year');

		insertTable('querytable', data, 'Core Databases Searches', 'This table lists the number of searches of the core databases across all Penn State.', 'format1', 500);
		data = null;
	}
	google.setOnLoadCallback(sendAndDrawTable);
	</script>
</head>
<body>
<center>
	<h1><font color='#FFFFFF'>Core Databases Searches</font></h1>
	<br>
	<table>
		<tr><td>
		&nbsp;&nbsp;&nbsp;The Harrell Health Sciences Library maintains a scoped list of over 100 biomedical and science databases for the Penn State Hershey Community. 
		The following data is the number of searches in the selected databases across all of Penn State.
		</td></tr>
	</table>
	<br>
	<div id="querytable"></div>
	<h3><font color='#FFFFFF'>*All data is vendor-supplied.</font></h3>
</center>
</body>
</html>