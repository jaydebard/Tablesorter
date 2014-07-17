<!--
This script assumes you have a database connection pre-configured.

Import the employees.sql file to your database to setup the table structure for the query.
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	
	<!-- jQuery & Tablesorter Libararies -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
	<script src="jquery.tablesorter.min.js" type="text/javascript"></script>

<!-- Load Tablesorter -->
<script type="text/javascript">
$(document).ready(function() 
    { 
        $("#myTable").tablesorter(); 
    } 
);  
</script>

</head>
	
<body>

<p><br />Click on column headers to sort each column.</p>
<?php
include('db-info.php');

// Query employees table to find first 10 records
if($stmt = $mysqli->prepare("SELECT FirstName, LastName, Email, PhoneNumber, ManagerID, DepartmentID FROM employees LIMIT 10")) {	
		
	$ms = microtime(true);
	
	// Execute the statement
	$stmt->execute();
	
	$ms = microtime(true) - $ms;
		
	// Bind variables from query result
	$stmt->bind_result($firstname, $lastname, $email, $phonenumber, $managerid, $departmentid);
	
	echo "<table align='center' width='90%' cellspacing=0 cellpadding=0 border=0 id='myTable'>";
	echo "<thead><tr align='left'>";
	echo "<th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Mgr ID</th><th>Dept ID</th>";
	echo "</tr></thead><tbody>";
	
	// Display results of query
	while($stmt->fetch()) {
		echo "<tr><td>$firstname</td><td>$lastname</td><td>$email</td><td>$phonenumber</td><td>$managerid</td><td>$departmentid</td></tr>";
	}
	
	echo "</tbody></table>";
	
	// Close the statement
	$stmt->close();
}
// Close the connection
$mysqli->close();

echo "Execution Time:" . round($ms, 5).' s'; //seconds
?>

</body>
</html>