<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$params = $_POST['params'];
	session_start();
}
else {
	$params = array(
		'mode' => '0',
		'cate' => '1',
		'page' => '1'
	);
}
?>
<div id="list-templates-area" class="list-templates">
	<ul>
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "template_sharing";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		$mode = $params["mode"] + 1;
		$cate = $params["cate"];
		$page = $params["page"];
		$tpg = 12;
		$offset = ($page - 1) * $tpg;
		$sql_statement = "SELECT TemplateID, Name FROM template WHERE CategoryID = $cate AND KindID = $mode LIMIT $offset, $tpg";
		$result = mysqli_query($conn, $sql_statement);
		while($row = mysqli_fetch_array($result)) {
			$name = $row['Name'];
			$tid = $row['TemplateID'];
			$sql_statement = "SELECT Link FROM image_link WHERE TemplateID = $tid LIMIT 0, 1";
			$inner_result = mysqli_query($conn, $sql_statement);
			$image_link = mysqli_fetch_array($inner_result)['Link'];
			$tlink = "./template_item.php?tid=$tid";
			$dlink = "./downloadfile.php?templateID=$tid";
		?>
			<li>
				<div class="col-xs-12 col-md-4">
					<a href="<?php echo $tlink ?>">
						<img src="<?php echo $image_link ?>" alt="<?php echo $name ?>" class="template-img"/>
					</a>
					<div>
						<div class="col-xs-9">
							<a href="<?php echo $tlink ?>"><?php echo $name ?></a>
						</div>
						<div class="col-xs-3">
							<?php
							if(!empty($_SESSION['signed_in']) and $_SESSION['signed_in']) {
							?>
							<a href="<?php echo $dlink ?>"><input type="image" src="../images/templates/download_symbol.png" alt="download" width="32" height="32"/></a>
							<?php
							}
							?>
						</div>
						<div class="clearfix"></div>
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