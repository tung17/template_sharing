<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Search result</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="../css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<link href="../css/list_templates.css" rel="stylesheet" type="text/css"/>
		<link href="../css/footer.css" rel="stylesheet" type="text/css"/>
		<link href="../css/header.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<div class="full-size">
			<?php
			include('../Header_Footer/header.php');
			?>
			
			<div id="content">
				<div class="container">
					<h1>Search result</h1>
					<?php
					parse_str($_SERVER["QUERY_STRING"], $params);
					$params["mode"] = empty($params["mode"]) ? "0" : $params["mode"];
					$params["name"] = empty($params["name"]) ? "^^^^^" : $params["name"];
					
					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "template_sharing";
					$conn = mysqli_connect($servername, $username, $password, $dbname);
					
					$mode = $params["mode"] + 1;
					$name = $params["name"];
					$sql_statement = "SELECT COUNT(TemplateID) AS T_COUNT FROM template WHERE KindID = $mode AND Name LIKE '" . $name . "%'";
					$result = mysqli_query($conn, $sql_statement);
					$count = mysqli_fetch_array($result)['T_COUNT'];
					?>
					<h2>
						<?php
						if($count == 0) {
							echo "No result were found";
						}
						elseif($count == 1) {
							echo 'Only 1 template found';
						}
						else {
							echo "$count templates found";
						}
						?>					
					</h2>
					<div class="container list-templates">
						<ul>
							<?php
							$sql_statement = "SELECT TemplateID, Name FROM template WHERE KindID = $mode AND Name LIKE '" . $name . "%'";
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
												<a href="<?php echo $dlink ?>">
													<input type="image" src="../images/templates/download_symbol.png" alt="download" width="32" height="32"/>
												</a>
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
							?>
						</ul>
					</div>
				</div>
			</div>
			
			<?php			
			include("../Header_Footer/footer.php");
			?>
		</div>
	</body>
</html>