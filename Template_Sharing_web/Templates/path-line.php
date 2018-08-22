<div id="path-line">
	<div class="breadcrumb">
		<a href="../Homepage/homepage.php">Homepage</a>
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
		
		echo '<a href="../Templates/?';
		$temp = $params["cate"];
		$params["cate"] = 0;
		echo http_build_query(($params));
		$params["cate"] = $temp;
		echo '">' . $name . '</a>';
		$cate = $params["cate"];
		if($cate != 0) {
			$temp = 'temp??';
			if(!empty($params["tid"])) {
				$temp = $params["tid"];
				unset($params["tid"]);
			}
		?>
			<a href="./?<?php echo http_build_query(($params)); ?>">
				<?php
				$sql_statement = "SELECT Name FROM template_category WHERE CategoryID = $cate";
				$result = mysqli_query($conn, $sql_statement);
				$name = ucwords(mysqli_fetch_array($result)['Name']);
				echo $name;
				?>
			</a>
		<?php
			if($temp != 'temp??') {
				$params["tid"] = $temp;
			}
			if(!empty($params["tid"])) {
				$tid = $params["tid"];
		?>
				<a href="#">
					<?php
					$sql_statement = "SELECT Name FROM template WHERE TemplateID = $tid";
					$result = mysqli_query($conn, $sql_statement);
					$name = ucwords(mysqli_fetch_array($result)['Name']);
					echo $name;
					?>
				</a>
		<?php
			}
		}
		mysqli_close($conn);
		?>
	</div>
</div>