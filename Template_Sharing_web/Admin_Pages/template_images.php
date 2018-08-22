<?php
session_start();

if(empty($_SESSION['is_admin']) or $_SESSION['is_admin'] == false) {
	header("Location: ./admin.php");
	exit();
}

$id = empty($_GET['tid']) ? 1 : $_GET['tid'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "template_sharing";
$conn = mysqli_connect($servername, $username, $password, $dbname);

$sql_statement = "SELECT Name as name FROM template WHERE TemplateID = $id";
$result = mysqli_query($conn, $sql_statement);
$row = mysqli_fetch_array($result);
$name = $row['name'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $name; ?></title>
		<meta charset="UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
		<script src="../script/template_images.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css" rel="stylesheet">
		<link href="../css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
		<link href="../css/resources_management.css" rel="stylesheet" type="text/css"/>
		<link href="../css/footer.css" rel="stylesheet" type="text/css"/>
		<link href="../css/header.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<div class="full-size">
            <?php
			include('../Header_Footer/header.php');
			?>
			
			<div class="container">
				<h1><?php echo $name; ?></h1>
				<div class="container">
					<div id="template_description">
						<h2>Template Images</h2>
						<form>
							<?php
							$sql_statement = "SELECT ImageID as id, Link as link FROM image_link WHERE TemplateID = $id";
							$result = mysqli_query($conn, $sql_statement);
							while($row = mysqli_fetch_array($result)) {
								$i_id = $row['id'];
								$i_link = $row['link'];
							?>
								<div class="form-group">
									<div class="col-xs-1"></div>
									<div class="col-xs-8">
										<input type="text" value="<?php echo $i_link; ?>" att-id="<?php echo $i_id; ?>" class="form-control inp-img" placeholder="Link"/>
									</div>
									<div class="col-xs-2">
										<input type="button" value="Delete" att-id="<?php echo $i_id; ?>" class="btn btn-danger" onclick="deleteButtionFunc(this)"/>
									</div>
									<div class="clearfix"></div>
								</div>
							<?php
							}
							?>
							<div class="form-group">
								<div class="col-xs-1"></div>
								<div class="col-xs-8">
									<input type="text" value="" id="btn-add-img" class="form-control" placeholder="Link"/>
								</div>
								<div class="col-xs-2">
									<input type="button" value="Add" class="btn btn-success" onclick="addButtionFunc(this)"/>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="form-group">
								<div class="col-xs-0 col-sm-3"></div>
								<div class="col-xs-6 col-sm-2">
									<input type="button" value="Save" class="btn btn-primary" onclick="saveButtionFunc(this)"/>
								</div>
								<div class="col-xs-6 col-sm-2">
									<input type="reset" value="Reset" class="btn btn-warning"/>
								</div>
								<div class="clearfix"></div>
							</div>
							<input type="hidden" id="template_id" value="<?php echo $id; ?>"/>
						</form>
					</div>
				</div>
			</div>
			
			<?php
			include("../Header_Footer/footer.php");
			?>
		</div>
	</body>
</html>
<?php
mysqli_close($conn);
?>