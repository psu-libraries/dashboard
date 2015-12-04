<!--
When searching for dashboard ideas, we found an on-line dashboard at http://www.macalester.edu/library/dashboard/2014/.
We liked the idea of using tiles to highlight the information so that we downloaded the template provided on this website.
Our development was based on this template.
-->

<!-- This page was inspired by a dashboard page on the Indianapolis Museum of Art's website, http://dashboard.imamuseum.org/. It was created by Johan Oberg, Digital Scholarship and Services Librarian at Macalester College, in 2009. Many of the icons come from the Crystal Clear icon set created by Everaldo Coelho and available on Wikimedia at http://commons.wikimedia.org/wiki/Crystal_Clear, which are made available under the GNU Lesser General Public License (LGPL). A copy of the license can be found here http://www.gnu.org/licenses/old-licenses/lgpl-2.1.html  -->
<!DOCTYPE html>
<?php include 'header.inc' ?>
<title>Activities at Harrell HSL</title>
<script type="text/javascript">
$(document).ready(function() {
	var today = new Date();
	var last_year = today.getFullYear() - 1;
	
	//Gate Count
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1qZBHNg9HHWTAQzVC2COEXbDykQXj37Kw2KSd6JoqClY&pub=1');
	var sql = "select sum(C) where A=" + last_year.toString();
	query.setQuery(sql);
	query.send(handleQueryResponse);
	function handleQueryResponse(response) {
		data = response.getDataTable();
		if (data.getNumberOfRows == 0) {
			$("#gatecount").append(0);
		} else {
			$("#gatecount").append(addCommas(data.getValue(0,0)));
		}
		data = null;
	};
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	var today = new Date();
	var last_year = today.getFullYear() - 1;
	
	//Website
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1NCktC5wjJGdgNoXMZEQiJNk16PRwESXH0pkQjP9sVfM&pub=1');
	var sql = "select sum(C)+sum(F), sum(D)+sum(G), sum(E)+sum(H) where A=" + last_year.toString();
	query.setQuery(sql);
	query.send(handleQueryResponse);
	function handleQueryResponse(response) {
		data = response.getDataTable();
		if (data.getNumberOfRows == 0) {
			$("#sessions").append(0);
			$("#users").append(0);
			$("#pageviews").append(0);
		} else {
			$("#sessions").append(addCommas(data.getValue(0,0)));
			$("#users").append(addCommas(data.getValue(0,1)));
			$("#pageviews").append(addCommas(data.getValue(0,2)));
		}
		data = null;
	};
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	var today = new Date();
	var last_year = today.getFullYear() - 1;
	
	//Interlibrary Loan
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1mIKqXdFJRJ2_RjriFwLTqQEogcAqaRZFw7ApP4FDh_A&pub=1');
	var sql = "select sum(C)+sum(D)+sum(E)+sum(F), sum(G) where A=" + last_year.toString();
	query.setQuery(sql);
	query.send(handleQueryResponse);
	function handleQueryResponse(response) {
		data = response.getDataTable();
		if (data.getNumberOfRows == 0) {
			$("#interlibraryloan").append(0);
			$("#intercampusloan").append(0);
		} else {
			$("#interlibraryloan").append(addCommas(data.getValue(0,0)));
			$("#intercampusloan").append(addCommas(data.getValue(0,1)));
		}
		data = null;
	};
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	var last_year = new Date().getFullYear() - 1;
	
	//Reference
	query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1joe4AzK7fI0hBh9XRnszAZmsVhsylKnI7PmXIbeITeA&pub=1');
	var sql = "select sum(C) where A=" + last_year.toString();
	query.setQuery(sql);
	query.send(handleQueryResponse);
	function handleQueryResponse(response) {
		data = response.getDataTable();
		if (data.getNumberOfRows == 0) {
			$("#reference").append(0);
		} else {
			$("#reference").append(addCommas(data.getValue(0,0)));
		}
		data = null;
	}
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	var last_year = new Date().getFullYear() - 1;
	
	//Literature Searches
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=163lBGpl1WzIWoBu4evBcRisJdG3DZ2hhAQzKR7X-OZ8&pub=1');
	var sql = "select sum(C)+sum(D)+sum(E)+sum(F)+sum(G) where A=" + last_year.toString();
	query.setQuery(sql);
	query.send(handleQueryResponse);
	function handleQueryResponse(response) {
		data = response.getDataTable();
		if (data.getNumberOfRows == 0) {
			$("#indepth_searches").append(0);
		} else {
			$("#indepth_searches").append(addCommas(data.getValue(0,0)));
		}
		data = null;
	}
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	var last_year = new Date().getFullYear() - 1;
	
	//Instruction/Presentations	
	query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1Nnbl7lNgpjrujwzb2WNuDPoRUhkF3EAfBx5sc3uEpEg&pub=1');
	var sql = "select sum(C)+sum(D)+sum(E)+sum(F), sum(G)+sum(H)+sum(I) where A=" + last_year.toString();
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
		data = null;
	}
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	var last_year = (new Date().getFullYear() - 1).toString();
	
	//Journals
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1eORcD01xXpbQbEYu71hUNMhMa_Sp28ZZgbq6-c3gAoM&pub=1');
	var sql = "select *";
	query.setQuery(sql);
	query.send(handleQueryResponse);
	function handleQueryResponse(response) {
		data = response.getDataTable();
		var rowno = data.getNumberOfRows();
		var colno = data.getNumberOfColumns();
		var total = 0;
		for (var i=3; i<colno; i++) {
			if (data.getColumnLabel(i) == last_year) {
				for (var j=0; j<rowno; j++) {
					total += data.getValue(j, i);
				}
				break;
			}
		}
		$("#journal").append(addCommas(total));
	}
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	var last_year = new Date().getFullYear() - 1;
	$("#year").append(last_year.toString());
	
	//Databases
	var query = new google.visualization.Query('http://spreadsheets.google.com/tq?key=1z1Sq8Z-uzRRmGi_u6rzxqdaNUm_1bL99bIuZx2F9-OA&pub=1');
	var sql = "select * where A=" + last_year.toString();
	query.setQuery(sql);
	query.send(handleQueryResponse);
	function handleQueryResponse(response) {
		data = response.getDataTable();
		var rowno = data.getNumberOfRows();
		var colno = data.getNumberOfColumns();
		var sum = 0;
		for (var i=0; i<rowno; i++) {
			for (var j=2; j<colno; j++) {
				sum  = sum + data.getValue(i, j);
			}
		}
		$("#database").append(addCommas(sum));
		data = null;
	};
});
</script>
</head>
<body>
	<div class="outbox">
		<div class="headercontainer">
			<headerleft>
				<div id="logo">
					<a id="harrellhsl" href="https://www.libraries.psu.edu/psul/hershey.html" class="more_link">
					<img src="../images/hershey_logo.png" alt="Harrell HSL Logo" align="left" border=0>
					</a>
				</div>
			</headerleft>
			<headerright>
				<h1>Activities at Harrell HSL</h1>
				<h3>in <span id="year"></span></h3>
			</headerright>
		</div>
		
		<!------------------------ Row 1 ------------------------>
		<div class="lefttile">
			<div class="boxtop">
				<div class="image"><img src="../images/Turnstile-icon2.png" alt="Gate Count Icon" align="left"></div>
				<div class="description">
					<div class="number"><span id="gatecount"></span></div><br/>
					<div class="text">Visits to the library</div>
				</div>
			</div>
			<div class="boxbottom">
				<div class="bottomtext bottomtext-right">
					<a id="volumesDetails" href="gatecount.php" class="more_link">Current Gate Count Data</a>
				</div>
			</div>
		</div>
		<div class="centertile">
			<div class="boxtop">
				<div class="image"><img src="../images/Visit_Views-icon.png" alt="Website Icon" align="left"></div>
				<div class="description">
					<div class="number number-medium"><span id="users"></span></div><br>
					<div class="text">Users visited our website for</div>
					<div class="number number-medium"><span id="pageviews"></span></div><br>
					<div class="text">Page views</div>
				</div>
			</div>
			<div class="boxbottom">
				<div class="bottomtext bottomtext-right">
					<a id="volumesDetails" href="website.php" class="more_link">Current Website Data</a>
				</div>
			</div>
		</div>
		<div class="righttile">
			<div class="boxtop">
				<div class="image"><img src="../images/InterlibraryLoan_resize.png" alt="Interlibrary Loan Icon" align="left"></div>
				<div class="description">
					<div class="number number-medium"><span id="interlibraryloan"></span></div><br/>
					<div class="text text-small">Items provided via Interlibrary Loan</div>
					<div class="number number-medium"><span id="intercampusloan"></span></div><br/>
					<div class="text text-small">Items borrowed from other PSU campuses</div>
				</div>
			</div>
			<div class="boxbottom">
				<div class="bottomtext bottomtext-right">
					<a id="volumesDetails" href="interlibraryloan.php" class="more_link">Current Interlibrary Loan Data</a>
				</div>
			</div>
		</div>
		<!------------------------ Row 2 ------------------------>
		<div class="lefttile">
			<div class="boxtop">
				<div class="image"><img src="../images/Reference-icon.png" alt="Reference Icon" align="left"></div>
				<div class="description">
					<div class="number"><span id="reference"></span></div><br/>
					<div class="text">Answers provided by Harrell HSL</div>
				</div>
			</div>
			<div class="boxbottom">
				<div class="bottomtext bottomtext-right">
					<a id="volumesDetails" href="reference.php" class="more_link">Current Reference Data</a>
				</div>
			</div>
		</div>
		<div class="centertile">
			<div class="boxtop">
				<div class="image"><img src="../images/Mediated-Search-icon.png" alt="Mediated Searches Icon" align="left"></div>
				<div class="description">
					<div class="number"><span id="indepth_searches"></span></div><br>
					<div class="text">In-depth literature searches by library faculty</div>
				</div>
			</div>
			<div class="boxbottom">
				<div class="bottomtext bottomtext-right">
					<a id="volumesDetails" href="literaturesearch.php" class="more_link">Current Search Data</a>
				</div>
			</div>
		</div>
		<div class="righttile">
			<div class="boxtop">
				<div class="image"><img src="../images/Liaison.png" alt="Liaison Program Icon" align="left"></div>
				<div class="description">
					<div class="number number-small">8</div><br/>
					<div class="text text-small">Liaisons serving</div>
					<div class="number number-small">25</div><br/>
					<div class="text text-small">Academic Departments</div>
					<div class="number number-small">1,175</div><br/>
					<div class="text text-small">Faculty</div>
				</div>
			</div>
			<div class="boxbottom">
				<div class="bottomtext bottomtext-right">
					<a id="volumesDetails" href="liaison.php" class="more_link">Current Liaison Data</a>
				</div>
			</div>
		</div>
		<!------------------------ Row 3 ------------------------>
		<div class="lefttile">
			<div class="boxtop">
				<div class="image"><img src="../images/Teaching-icon3_resize.png" alt="Instruction and Presentations Icon" align="left"></div>
				<div class="description">
					<div class="number number-medium"><span id="instruction_transactions"></span></div><br>
					<div class="text text-small">Instruction/presentations provided to</div>
					<div class="number number-medium"><span id="instruction_attendance"></span></div><br>
					<div class="text text-small">Students, faculty, and staff</div>
				</div>
			</div>
			<div class="boxbottom">
				<div class="bottomtext bottomtext-right">
					<a id="volumesDetails" href="instruction.php" class="more_link">Current Instruction Data</a>
				</div>
			</div>
		</div>
		<div class="centertile">
			<div class="boxtop">
				<div class="image"><img src="../images/Journals-icon.png" alt="Journal Views Icon" align="left"></div>
				<div class="description">
					<div class="number"><span id="journal"></span></div><br/>
					<div class="text">Articles read in the Top Ten Biomedical Journals* (Selective List)</div>
				</div>
			</div>
			<div class="boxbottom">
				<div class="bottomtext bottomtext-left">*PSU Wide</div>
				<div class="bottomtext bottomtext-right">
					<a id="volumesDetails" href="journal.php" class="more_link">Current Journal Data</a>
				</div>
			</div>
		</div>
		<div class="righttile">
			<div class="boxtop">
				<div class="image"><img src="../images/Databases-icon.png" alt="Database Searches Icon" align="left"></div>
				<div class="description">
					<div class="number"><span id="database"></span></div><br/>
					<div class="text">Searches of the Core Databases*</div>
				</div>
			</div>
			<div class="boxbottom">
				<div class="bottomtext bottomtext-left">*PSU Wide</div>
				<div class="bottomtext bottomtext-right">
					<a id="volumesDetails" href="database.php" class="more_link">Current Database Data</a>
				</div>
			</div>
		</div>
	</div>	
</body>
</html>
