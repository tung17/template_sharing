<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>List of Templates</title>
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
			
			parse_str($_SERVER["QUERY_STRING"], $params);
			$mode = $params["mode"] = empty($params["mode"]) ? "0" : $params["mode"];
			$cate = $params["cate"] = empty($params["cate"]) ? "0" : $params["cate"];
			$page = $params["page"] = empty($params["page"]) ? "1" : $params["page"];
			echo "
				<script>
					var params = { 'mode': $mode, 'cate': $cate, 'page': $page };
				</script>
			";
			include("./head-decoration.php");
			?>
			<div id="content">
				<div id="main-content">
					<div id="filter-side"></div>
					<script>
						$.post('./filter-side.php', { 'params': params }).done(function(result){
							$('#filter-side').replaceWith(result);
						});
					</script>
					<div id="templates-side" class="container col-sm-8 col-md-10">
						<?php
						include("./path-line.php");
						if($params["cate"] == 0) {
						?>
							<div id='category-area'></div>
							<script>
								$.post('./category.php', { 'params': params }).done(function(result){
									$('#category-area').replaceWith(result);
								});
							</script>
						<?php
						}
						else {
						?>
							<div class="page-scroller"></div>
							<div id='list-templates-area'></div>
							<div class="page-scroller"></div>
							<script>
								$.post('./list-templates-area.php', { 'params': params }).done(function(result) {
									$('#list-templates-area').replaceWith(result);
								});
								$.post('./page-scroller.php', { 'params': params }).done(function(result) {
									$('.page-scroller').replaceWith(result);
								});
							</script>
						<?php
						}
						?>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
			<?php
			include("./also-like.php");
			
			include("../Header_Footer/footer.php");
			?>
		</div>
	</body>
</html>