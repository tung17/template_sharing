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
$sql_statement = "SELECT COUNT(TemplateID) AS T_Count FROM template";
$result = mysqli_query($conn, $sql_statement);
$tcount = mysqli_fetch_array($result)['T_Count'];
$total_pages = $tcount == 0 ? 0 : floor(($tcount - 1) / $tpg) + 1;
?>
<div id="page-scroller">
	<?php
	if($total_pages != 1) {
	?>
	<div>
		<ul class="pagination">
			<script>
				var pageSelection = function(e) {
					var page = $(e).text();
					var params = { 'page': page };
					$.post('./table_template_list.php', params, function(result) {
						$('#table-template-list').replaceWith(result);
					})
					$.post('./page_scroller.php', params, function(result) {
						$('#page-scroller').replaceWith(result);
					})
				}
			</script>
			<?php
			for($i = 1; $i <= $total_pages; $i++) {
				if($i == $page) {
				?>
				<li class="active"><span><?php echo $i; ?></span></li>
				<?php
				}
				else {
				?>
				<li><span onclick="pageSelection(this)"><?php echo $i; ?></span></li>
				<?php				
				}
			}
			?>
		</ul>
		<div class="clearfix"></div>
	</div>
	<?php
	}
	?>
</div>
<?php
mysqli_close($conn);
?>