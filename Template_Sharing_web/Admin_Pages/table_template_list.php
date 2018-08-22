<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$page = $_POST['page'];
}
else {
	$page = 1;
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "template_sharing";
$conn = mysqli_connect($servername, $username, $password, $dbname);

$tpg = 100;
$offset = ($page - 1) * $tpg;

?>
<div id="table-template-list" class="table-responsive">
	<table class="table table-striped table-hover table-condensed">
		<thead>
			<tr>
				<th>ID</th>
				<th>Kind</th>
				<th>Category</th>
				<th>Name</th>
				<th>Download<br/>Counter</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql_statement = "SELECT t.TemplateID as id, k.Name as kind, c.Name as cate, t.Name as name";
			$sql_statement .= ", t.DownloadLink as link, t.DownloadCounter as counter";
			$sql_statement .= " FROM template t, template_kind k, template_category c";
			$sql_statement .= " WHERE t.KindID = k.KindID AND t.CategoryID = c.CategoryID";
			$sql_statement .= " ORDER BY id LIMIT $offset, $tpg";
			$result = mysqli_query($conn, $sql_statement);
			while($row = mysqli_fetch_array($result)) {
				$id = $row['id'];
				$kind = $row['kind'];
				$cate = $row['cate'];
				$name = $row['name'];
				$link = $row['link'];
				$counter = $row['counter'];
				echo '<tr>';
				echo "<td><a href='./template_details.php?tid=$id'>$id</a></td>";
				echo "<td><a href='./template_details.php?tid=$id'>$kind</a></td>";
				echo "<td><a href='./template_details.php?tid=$id'>$cate</a></td>";
				echo "<td><a href='./template_details.php?tid=$id'>$name</a></td>";
				echo "<td><a href='./template_details.php?tid=$id'>$counter</a></td>";
			?>
				<td>
					<a href="./template_description.php?tid=<?php echo $id; ?>" class="btn btn-xs btn-info" title="Manage Template Description">
						<span class="glyphicon glyphicon-cog"></span>
					</a>
				</td>
				<td>
					<a href="./template_images.php?tid=<?php echo $id; ?>" class="btn btn-xs btn-info" title="Manage Template Pictures">
						<span class="glyphicon glyphicon-picture"></span>
					</a>
				</td>
				<td>
					<a href="./template_details.php?tid=<?php echo $id; ?>" class="btn btn-xs btn-primary" title="Manage Template">
						<span class="glyphicon glyphicon-edit"></span>
					</a>
				</td>
			<?php
				echo "<td></td>";
				echo '</tr>';
			}
			?>
		</tbody>
	</table>
</div>
<?php
mysqli_close($conn);
?>