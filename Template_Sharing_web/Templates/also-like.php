<div id="bottom-decoration" class="container list-templates">
	<h3>
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "template_sharing";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		$mode = 3 - ($params["mode"] + 1);
		$sql_statement = "SELECT Name FROM template_kind WHERE KindID = $mode";
		$result = mysqli_query($conn, $sql_statement);
		$name = ucwords(mysqli_fetch_array($result)['Name']);
		
		echo "Some $name You May Like";
		?>
	</h3>
	<ul>
		<?php
		$sql_statement = "SELECT TemplateID, Name FROM template WHERE KindID = $mode LIMIT 0, 4";
		$result = mysqli_query($conn, $sql_statement);
		while($row = mysqli_fetch_array($result)) {
			$name = $row['Name'];
			$tid = $row['TemplateID'];
			$sql_statement = "SELECT Link FROM image_link WHERE TemplateID = $tid LIMIT 0, 1";
			$inner_result = mysqli_query($conn, $sql_statement);
			$image_link = mysqli_fetch_array($inner_result)['Link'];
			$tlink = "./template_item.php?tid=$tid";
		?>
			<li>
				<div class="col-xs-12 col-sm-6 col-md-3">
					<a href="<?php echo $tlink ?>">
						<img src="<?php echo $image_link ?>" alt="<?php echo $name ?>" class="template-img"/>
					</a>
					<div>
						<a href="<?php echo $tlink ?>"><?php echo $name ?></a>
					</div>
				</div>
			</li>
		<?php
		}
		mysqli_close($conn);
		?>
	</ul>
	<div class="clearfix"></div>
</div>