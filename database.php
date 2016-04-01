<html>
<head>
	<?php include 'header.inc' ?>
	<title>Top Ten Biomedical Journals</title>
	<script type="text/javascript">
	var data;
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1CkwGymzAXuqOQXN5vApQtu6VMMs8WK1ch_iEzk28kZ0&pub=1');
	function handleQueryResponse(response) {
		if (response.isError()) {
			alert('Error in query: ' + response.getMessage() + ' ' + response.getDetailedMessage());
		return;
		}
		data = response.getDataTable();
		//alert(data.toSource());
		rowno = data.getNumberOfRows();
		colno = data.getNumberOfColumns();		
		
		//Delete columns that are not within the most recent 3 years
		var thisyear = new Date().getFullYear() - 3;
		var colyear = data.getColumnLabel(4); //Start from the first year which is the 5th column
		while (parseInt(colyear, 10) < thisyear) {
			data.removeColumn(3);
			colno --;
			colyear = data.getColumnLabel(3);
		}
		
		for (var i=0; i<rowno; i++) {
			var journal = data.getValue(i, 0);
			var url = data.getValue(i, 1);
			if (url != null) {
				var value = "<a href='" + url + "' style='color: #000000'>" + journal + "</a>";
				data.setCell(i, 0, value);
			}
		}
		data.removeColumn(1); //remove URL column
		colno --;
		data.removeColumn(1); //remove Source column
		colno --;
		data.removeColumn(1); //remove Data column
		colno --;

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
		The following data is the number of searches in select databases across all of Penn State.
		</td></tr>
	</table>
	<br>
	<div id="querytable"></div>
	<p><font color='#FFFFFF'>*All data is vendor-supplied.</font></h3>
	<?php include 'footer.inc' ?>
</center>
</body>
</html>