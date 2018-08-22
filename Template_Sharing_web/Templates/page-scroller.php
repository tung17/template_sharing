<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$params = $_POST['params'];
}
else {
	$params = array(
		'mode' => '0',
		'cate' => '1',
		'page' => '1'
	);
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "template_sharing";
$conn = mysqli_connect($servername, $username, $password, $dbname);

$mode = $params["mode"] + 1;
$cate = $params["cate"];
$tpg = 12;
$sql_statement = "SELECT COUNT(TemplateID) AS T_Count FROM template WHERE CategoryID = $cate AND KindID = $mode";
$result = mysqli_query($conn, $sql_statement);
$tcount = mysqli_fetch_array($result)['T_Count'];
$total_pages = $tcount == 0 ? 0 : floor(($tcount - 1) / $tpg) + 1;
mysqli_close($conn);
?>
<div class="page-scroller">
	<?php
	if($total_pages != 1) {
	?>
	<div>
		<ul class="pagination">
			<script>
				var pageSelection = function(e) {
					var mode = $(e).attr("mode");
					var cate = $(e).attr("cate");
					var page = $(e).attr("page");
					var params = { 'mode': mode, 'cate': cate, 'page': page };
					$.post('./list-templates-area.php', { 'params': params }).done(function(result){
						$('#list-templates-area').replaceWith(result);
					});
					$.post('./page-scroller.php', { 'params': params }).done(function(result) {
						$('.page-scroller').replaceWith(result);
					});
				}
			</script>
			<?php			
			$cur_page = $params["page"];
			if(!function_exists("parseParams")) {
				function parseParams($params) {
					$mode = $params["mode"];
					$cate = $params["cate"];
					$page = $params["page"];
					return "mode=\"$mode\" cate=\"$cate\" page=\"$page\"";
				}
			}
			if($cur_page > $total_pages) {
				$cur_page = $params["page"] = $total_pages;
			}
			elseif($cur_page < 1) {
				$cur_page = $params["page"] = 1;
			}
			if($params["page"] == 1) {
				echo '<li class="disabled"><span>&lt;&lt;</span></li>';
				echo '<li class="disabled"><span>&lt;</span></li>';
				echo '<li class="active"><span>1</span></li>';
			}
			else {
				$params["page"] = 1;
				echo '<li><span ' . parseParams($params) . ' onclick="pageSelection(this)">&lt;&lt;</span></li>';
				$params["page"] = $cur_page - 1;
				echo '<li><span ' . parseParams($params) . ' onclick="pageSelection(this)">&lt;</span></li>';
				$params["page"] = 1;
				echo '<li><span ' . parseParams($params) . ' onclick="pageSelection(this)">1</span></li>';
			}
			for($i = 2; $i < $total_pages; $i++) {
				if($cur_page == $i) {
					echo '<li class="active"><span>' . $i . '</span></li>';
				}
				else {
					$params["page"] = $i;
					echo '<li><span ' . parseParams($params) . ' onclick="pageSelection(this)">' . $i . '</span></li>';
				}
			}
			if($cur_page == $total_pages) {
				if($total_pages != 1) {
					echo '<li class="active"><span>' . $total_pages . '</span></li>';
				}
				echo '<li class="disabled"><span>&gt;</span></li>';
				echo '<li class="disabled"><span>&gt;&gt;</span></li>';
			}
			else {
				$params["page"] = $total_pages;
				echo '<li><span ' . parseParams($params) . ' onclick="pageSelection(this)">' . $total_pages . '</span></li>';
				$params["page"] = $cur_page + 1;
				echo '<li><span ' . parseParams($params) . ' onclick="pageSelection(this)">&gt;</span></li>';
				$params["page"] = $total_pages;
				echo '<li><span ' . parseParams($params) . ' onclick="pageSelection(this)">&gt;&gt;</span></li>';
			}
			$params["page"] = $cur_page;
			?>
		</ul>
		<ul class="pagination">
			<li>
				<span class="irrelevant">
				/
				<?php
					echo $total_pages . (($total_pages > 1) ? " PAGES" : " PAGE");
				?>
				</span>
			</li>
		</ul>
		<div class="clearfix"></div>
	</div>
	<?php
	}
	?>
</div>