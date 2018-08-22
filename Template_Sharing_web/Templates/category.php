<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$params = $_POST['params'];
}
else {
	$params = array('mode' => '0');
}
$params['page'] = 1;
?>
<div id="category-area">
	<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "template_sharing";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	$sql_statement = "SELECT Name FROM template_category";
	$result = mysqli_query($conn, $sql_statement);
	while($row = mysqli_fetch_array($result)) {
		$name = ucwords($row['Name']);
		$cates[] = $name;
	}		
	
	for($i = 0; $i < 3; $i++) {
		echo '<div class="' . strtolower($cates[$i]) . '">';
		echo '<a href="../Templates/?';
		$params["cate"] = $i + 1;
		echo http_build_query(($params));
		echo '">';
		echo '<div><span>';
		echo $cates[$i];
		echo '</span></div></a></div>';
	}
	mysqli_close($conn);
	?>
</div>