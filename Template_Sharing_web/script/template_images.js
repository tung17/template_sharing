var deleteButtionFunc = function(e) {
	var id = $(e).attr('att-id');
	var params = {
		'method': 'delete',
		'table': 'image_link',
		'column': 'ImageID',
		'id': id,
	};
	$.post('./sql_processing.php', params, function(result) {
		alert('Deleted!');
		location.reload();
	}).fail(function(result) {
		alert(result);
	});
}

var addButtionFunc = function(e) {
	var tlink = $('#btn-add-img').val();
	var id = $('#template_id').val();
	var data = [tlink, id];
	var params = {
		'method': 'insert',
		'table': 'image_link',
		'columns': ['Link', 'TemplateID'],
		'data': data,
	};
	$.post('./sql_processing.php', params, function(result) {
		alert('Added!');
		location.reload();
	}).fail(function(result) {
		alert(result);
	});
}

var saveButtionFunc = function(e) {
	l = [];
	$('.inp-img').each(function(){
		var id = $(this).attr('att-id');
		var tlink = $(this).val();
		l.push({
			'columns': ['Link'],
			'values': [tlink],
			'column': 'ImageID',
			'id': id,
		});
	});
	var params = {
		'method': 'update_list',
		'table': 'image_link',
		'data': l,
	};
	$.post('./sql_processing.php', params, function(result) {
		alert("Saved!");
	}).fail(function(result) {
		alert(result);
	});
}