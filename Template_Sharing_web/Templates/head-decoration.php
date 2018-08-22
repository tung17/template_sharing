<div id="head-decoration">
	<h2>
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "template_sharing";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		$mode = $params["mode"] + 1;
		$sql_statement = "SELECT COUNT(TemplateID) AS T_Count FROM template WHERE KindID = $mode";
		$result = mysqli_query($conn, $sql_statement);
		$total = mysqli_fetch_array($result)['T_Count'];
		$sql_statement = "SELECT Name FROM template_kind WHERE KindID = $mode";
		$result = mysqli_query($conn, $sql_statement);
		$name = mysqli_fetch_array($result)['Name'];
		
		echo "<span>$total</span> $name";
		mysqli_close($conn);
		?>
	</h2>
</div>