<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$params = $_POST['params'];
}
else {
	$params = array(
		'mode' => 0,
		'cate' => 0
	);
}
?>

<div id="filter-side" class="col-sm-4 col-md-2">
	<h3>
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "template_sharing";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		$mode = $params["mode"] + 1;
		$sql_statement = "SELECT Name FROM template_kind WHERE KindID = $mode";
		$result = mysqli_query($conn, $sql_statement);
		$name = ucwords(mysqli_fetch_array($result)['Name']);
		echo $name;
		
		$sql_statement = "SELECT Name FROM template_category";
		$result = mysqli_query($conn, $sql_statement);
		$cates = array();
		while($row = mysqli_fetch_array($result)) {
			$cates[] = ucwords($row['Name']);
		}
		
		mysqli_close($conn);
		?>
	</h3>
	<div>Categories</div>
	<div class="list-group">
		<?php
		$cur_cate = $params["cate"];
		for($i = 1; $i < 4; $i++) {
			if($i == $cur_cate) {
				echo '<a href="#';
			}
			else {
				echo '<a href="../Templates/?';
				$params["cate"] = $i;
				echo http_build_query(($params));
			}
			echo '" class="list-group-item';
			if($i == $cur_cate) {
				echo ' active disabled';
			}
			echo '">' . $cates[$i - 1] . '</a>';
		}
		$params["cate"] = $cur_cate;
		?>
	</div>
</div>