var deleteButtionFunc = function(e) {
	var id = $(e).attr('att-id');
	var params = {
		'method': 'delete',
		'table': 'template_description',
		'column': 'DescriptionID',
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
	var content = $('#btn-add-des').val();
	var id = $('#template_id').val();
	var data = [content, id];
	var params = {
		'method': 'insert',
		'table': 'template_description',
		'columns': ['Content', 'TemplateID'],
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
	$('.inp-des').each(function(){
		var id = $(this).attr('att-id');
		var content = $(this).val();
		l.push({
			'columns': ['Content'],
			'values': [content],
			'column': 'DescriptionID',
			'id': id,
		});
	});
	var params = {
		'method': 'update_list',
		'table': 'template_description',
		'data': l,
	};
	$.post('./sql_processing.php', params, function(result) {
		alert("Saved!");
	}).fail(function(result) {
		alert(result);
	});
}