<?php
session_start();

if(empty($_SESSION['is_admin']) or $_SESSION['is_admin'] == false) {
	header("Location: ../Access/login.php");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Resources Management Page</title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="../css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<link href="../css/resources_management.css" rel="stylesheet" type="text/css"/>
		<link href="../css/footer.css" rel="stylesheet" type="text/css"/>
		<link href="../css/header.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<div class="full-size">
            <?php
			include('../Header_Footer/header.php');
			
			parse_str($_SERVER["QUERY_STRING"], $params);
			$page = $params["page"] = empty($params["page"]) ? "1" : $params["page"];
			?>
			
			<div class="container">
				<h1>Admin Resources Management Page</h1>
				<div class="container">
					<div id="template_list">
						<h2>List of Templates</h2>
						<?php
						?>
						<div id="table-template-list" class="table-responsive"></div>
						<div id="page-scroller"></div>
						<script>
							$.post('./table_template_list.php', { 'page': <?php echo $page; ?> }, function(result) {
								$('#table-template-list').replaceWith(result);
							})
							$.post('./page_scroller.php', { 'page': <?php echo $page; ?> }, function(result) {
								$('#page-scroller').replaceWith(result);
							})
						</script>
					</div>
				</div>
			</div>
			
			<?php
			include("../Header_Footer/footer.php");
			?>
		</div>
	</body>
</html>