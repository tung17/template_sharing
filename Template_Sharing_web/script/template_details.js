var deleteButtionFunc = function(e) {
	var id = $('#t_id').val();
	var params = {
		'method': 'delete',
		'table': 'template',
		'column': 'TemplateID',
		'id': id,
	};
	$.post('./sql_processing.php', params, function(result) {
		alert('Deleted!');
		window.location.href = "./resources_management.php";
	}).fail(function(result) {
		alert(result);
	});
}

var addButtionFunc = function(e) {
	var name = $('#t_name').val();
	var dl = $('#t_link').val();
	var dc = $('#t_counter').val();
	var cid = $('#t_cate').val();
	var kid = $('#t_kind').val();
	var data = [name, dl, dc, cid, kid];
	var params = {
		'method': 'insert',
		'table': 'template',
		'columns': ['Name', 'DownloadLink', 'DownloadCounter', 'CategoryID', 'KindID'],
		'data': data,
	};
	$.post('./sql_processing.php', params, function(result) {
		alert('Added!');
		window.location.href = "./template_details.php?tid=" + result;
	}).fail(function(result) {
		alert(result);
	});
}

var saveButtionFunc = function(e) {
	var id = $('#t_id').val();
	var name = $('#t_name').val();
	var dl = $('#t_link').val();
	var dc = $('#t_counter').val();
	var cid = $('#t_cate').val();
	var kid = $('#t_kind').val();
	var data = {
		'columns': ['Name', 'DownloadLink', 'DownloadCounter', 'CategoryID', 'KindID'],
		'values': [name, dl, dc, cid, kid],
		'column': 'TemplateID',
		'id': id,
	};
	var params = {
		'method': 'update_list',
		'table': 'template',
		'data': [data],
	};
	$.post('./sql_processing.php', params, function(result) {
		alert("Saved!");
	}).fail(function(result) {
		alert(result);
	});
}