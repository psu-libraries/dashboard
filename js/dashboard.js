function addCommas(number) {
    var n= number.toString().split(".");
    //For the first part, add comma to every 3 digits
    n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return n.join(".");
}
function resetPivot() {
	document.getElementById('pivot').value = '';
}
function setQuery(queryString) {
	query.setQuery(queryString);
	sendAndDrawTable();
}
function sendAndDrawTable() {
	query.send(handleQueryResponse);
}
function monthlychart(data, options, title, ytitle) {
	for (var i=1; i<colno; i++) {
		var name = data.getColumnLabel(i);
		var series = {
			data: []
		};
		series.name = name;
		for (var j=0; j<rowno; j++) {
			var value = data.getValue(j, i);
			series.data.push(value);
		}
		options.series.push(series);
	}
	var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	var tmp = [];
	for (var i=0; i<rowno; i++) {tmp.push(data.getValue(i, 0));}
	options.chart.type = 'column';
	options.title.text = title;
	options.xAxis.categories = months.slice(tmp[0]-1);
	options.yAxis.title.text = ytitle;
	options.tooltip = {
		formatter: function () {
			return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + addCommas(this.y) + '<br/>';
		}
	}
	options.plotOptions =  {
		column: {
			pointPadding: 0.2,
			borderWidth: 0
		}
	}
}
function totalchart(data, options, title, ytitle) {
	for (var i=1; i<colno; i++) {
		var name = data.getColumnLabel(i);
		var series = {
			data: []
		};
		series.name = name;
		for (var j=0; j<rowno; j++) {
			var value = data.getValue(j, i);
			series.data.push(value);
		}
		options.series.push(series);
	}
	options.chart.type = 'column';
	options.title.text = title;
	options.xAxis.categories = [];
	for (var i=0; i <rowno; i ++) {
		var year = data.getValue(0,0) + i;
		options.xAxis.categories.push(year.toString());
	}
	options.yAxis.title.text = ytitle;
	options.tooltip = {
		formatter: function () {
			return '<b>' + this.x + '</b><br/>' + this.series.name + ': ' + addCommas(this.y) + '<br/>';
		}
	}
	options.plotOptions =  {
		column: {
			pointPadding: 0.2,
			borderWidth: 0
		}
	}
}
function typechart(data, options, title, seriesname) {
	var sum = 0;
	for (var i=0; i<colno; i++) {
		sum += data.getValue(0, i);
	}
	var series = {
		type: 'pie',
		name: seriesname,
		data: []
	};
	for (var i=0; i<colno; i++) {
		var name = data.getColumnLabel(i);
		//name = name.substr(name.indexOf(" ")+1);
		var value = data.getValue(0, i) / sum * 100;
		var tmp = [name, parseFloat(value.toFixed(2))];
		series.data.push(tmp);
	}
	options.chart.type = '';
	options.title.text = title;
	options.xAxis.categories = [];
	options.series.push(series);
	options.tooltip = {
		formatter: function() {
			return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
		}
	};
	options.plotOptions =  {
		pie: {
			allowPointSelect: true,
			cursor: 'pointer',
			dataLabels: {
				enabled: true,
				format: '<b>{point.name}</b>: {point.percentage:.2f} %',
				style: {
					color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
				}
			}
		}
	};
}
function stackedchart(data, options, title, ytitle) {
	seriesno = -1;
	for (var j=1; j<colno; j++) {
		var series = {
			name: '',
			data: [],
			stack: '',
			minPointLength: 3
		};		
		var name = data.getColumnLabel(j);

		//series.name = name;
		var c = name.charAt(0);
		if (c >= '0' && c <= '9') {
			series.name = name;
		} else {
			var today = new Date();
			var yyyy = today.getFullYear();
			series.name = yyyy.toString() + ' ' + name;
		}

		var yyyy = name.substr(0, 4);
		series.stack = yyyy;
		options.series.push(series);
		seriesno ++;
		for (var i=0; i<rowno; i++) {
			var value = data.getValue(i, j);
			if (value > 0) {
				options.series[seriesno].data.push(value);
			} else {
				options.series[seriesno].data.push(null);
			}
		}
	}
	//alert(options.series.toSource());
	options.chart.type = 'column';
	options.title.text = title;
	options.xAxis.categories = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
	options.ytitle = ytitle;
	options.plotOptions = {
		column: {stacking: 'normal'}
	}
	options.tooltip = {
		formatter: function () {
			return '<b>' + this.x + '</b><br/>' +
				this.series.name + ': ' + addCommas(this.y) + '<br/>' +
				'Total: ' + addCommas(this.point.stackTotal);
		}
	}
}
function insertTable(id, data, caption, summary, format, height) {
    var theader = "<table class='querytable' summary='";
	theader += summary;
	theader += "'>";
	theader += "<caption class='querytablecaption'>";
	theader += caption;
	theader += "</caption>";
	
	var header = 'querytableheader';
	var cell = 'querytablecell';
	var oddrow = 'querytableoddrow';
	if (format == 'format1') {
		header = 'querytableheader1';
		cell = 'querytablecell1';
		oddrow = 'querytableoddrow1';
	}	
	
	for(var j = 0; j < colno; j++) {
		theader += "<th class='" + header + "'>" + data.getColumnLabel(j) + " </th>";
	}

    var tbody = "";
	for(var i = 0; i < rowno; i++)
	{
		tbody += "<tr>";
		for(var j = 0; j < colno; j++)
		{
			if ((i%2) == true) {
				tbody += "<td class='" + oddrow + "'>";
			} else {
				tbody += "<td class='" + cell + "'>";
			}
			if (data.getValue(i, j)) {
				if (data.getColumnLabel(j) == 'Month') {
					var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ];
					var month = data.getValue(i, j);
					tbody += monthNames[month-1];
				} else if (data.getColumnLabel(j) == 'Year' || data.getColumnLabel(j) == 'Fiscal Year') {
					tbody += data.getValue(i, j);
				} else {
					tbody += addCommas(data.getValue(i, j));
				}
			}
			tbody += "</td>"
		}
		tbody += "</tr>";
	}
	var tfooter = "</table>";
	document.getElementById(id).innerHTML = theader + tbody + tfooter;
}
