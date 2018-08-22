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

$sql_statement = "SELECT KindID as kind, CategoryID as cate, Name as name, DownloadLink as link, DownloadCounter as counter";
$sql_statement .= " FROM template t";
$sql_statement .= " WHERE t.TemplateID = $id";
$result = mysqli_query($conn, $sql_statement);
$row = mysqli_fetch_array($result);
$kind = $row['kind'];
$cate = $row['cate'];
$name = $row['name'];
$link = $row['link'];
$counter = $row['counter'];
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
		<script src="../script/template_details.js"></script>
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
					<div id="template_details">
						<form class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-sm-2" for="t_id">ID:</label>
								<div class="col-sm-10">
									<input type="text" value="<?php echo $id; ?>" id="t_id" class="form-control" readonly="" placeholder="ID"/>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="t_kind">Template Kind:</label>
								<div class="col-sm-10">
									<select class="selectpicker form-control" id="t_kind">
										<?php
										$sql_statement = "SELECT KindID as id, Name as name FROM template_kind";
										$result = mysqli_query($conn, $sql_statement);
										while($row = mysqli_fetch_array($result)) {
											$k_id = $row['id'];
											$k_name = $row['name'];
											echo "<option value='$k_id'" . ($kind == $k_id ? " selected=''>" : ">");
											echo "$k_name";
											echo "</option>";
										}										
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="t_cate">Template Category:</label>
								<div class="col-sm-10">
									<select class="selectpicker form-control" id="t_cate">
										<?php
										$sql_statement = "SELECT CategoryID as id, Name as name FROM template_category";
										$result = mysqli_query($conn, $sql_statement);
										while($row = mysqli_fetch_array($result)) {
											$c_id = $row['id'];
											$c_name = $row['name'];
											echo "<option value='$c_id'" . ($cate == $c_id ? " selected=''>" : ">");
											echo "$c_name";
											echo "</option>";
										}										
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="t_name">Name:</label>
								<div class="col-sm-10">
									<input type="text" value="<?php echo $name; ?>" id="t_name" class="form-control" placeholder="Name"/>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="t_link">Download Link:</label>
								<div class="col-sm-10">
									<input type="text" value="<?php echo $link; ?>" id="t_link" class="form-control" placeholder="Download Link"/>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="t_counter">Download Counter:</label>
								<div class="col-sm-10">
									<input type="number" value="<?php echo $counter; ?>" id="t_counter" class="form-control" min="0" placeholder="Download Counter"/>
								</div>
							</div>
							<div class="form-group">
								<input type="button" value="Save" class="btn btn-primary" onclick="saveButtionFunc(this)"/>
								<input type="reset" value="Reset" class="btn btn-warning"/>
								<input type="button" value="Add" class="btn btn-info" onclick="addButtionFunc(this)"/>
								<input type="button" value="Delete" class="btn btn-danger" onclick="deleteButtionFunc(this)"/>
							</div>
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