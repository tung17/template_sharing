<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$method = $_POST['method'];
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "template_sharing";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	if(empty($method)) {
	}
	elseif($method === 'delete') {
		$table = $_POST['table'];
		$column = $_POST['column'];
		$id = $_POST['id'];
		if(!empty($id) and is_numeric($id)) {
			$sql_statement = "DELETE FROM $table WHERE $column = $id";
			mysqli_query($conn, $sql_statement);	
		}
		else {
			http_response_code(400);
		}
	}
	elseif($method === 'insert') {
		$table = $_POST['table'];
		$columns = $_POST['columns'];
		$data = $_POST['data'];
		$flag = !empty($data);
		for($i = 0; $i < count($columns); $i++) {
			$column = $columns[$i];
			if(strpos($column, 'ID') !== false or strpos($column, 'Counter') !== false) {
				$flag = $flag and is_numeric($data[$i]);
			}
			else if(strlen($data[$i]) > 255) {
				$flag = false;
			}
		}
		if($flag) {
			$col = '(' . implode(",", $columns) . ')';
			for($i = 0; $i < count($data); $i++) {
				$data[$i] = "'" . $data[$i] . "'";
			}
			$da = '(' . implode(",", $data) . ')';
			$sql_statement = "INSERT INTO $table $col VALUES $da";
			mysqli_query($conn, $sql_statement);
			if($table === "template") {
				$id_col = 'TemplateID';
			}
			elseif($table === "image_link") {
				$id_col = 'ImageID';				
			}
			elseif($table === "template_description") {
				$id_col = 'DescriptionID';
			}
			$sql_statement = "SELECT MAX($id_col) AS new_id FROM $table";
			$new_id = mysqli_fetch_array(mysqli_query($conn, $sql_statement))['new_id'];
			echo $new_id;	
		}
		else {
			http_response_code(400);
		}
	}
	elseif($method === 'update_list') {
		$table = $_POST['table'];
		$data = $_POST['data'];
		foreach($data as $dict) {
			$columns = $dict['columns'];
			$values = $dict['values'];
			$column = $dict['column'];
			$id = $dict['id'];
			$flag = !empty($values);
			if(!empty($id) and is_numeric($id)) {
				$sql_statement = "UPDATE $table SET ";
				$length = count($columns);
				for($i = 0; $i < $length - 1; $i++) {
					if(strpos($columns[$i], 'ID') !== false or strpos($columns[$i], 'Counter') !== false) {
						$flag = $flag and is_numeric($values[$i]);
					}
					else if(strlen($values[$i]) > 255) {
						$flag = false;
					}
				}
				if($flag) {
					for($i = 0; $i < $length - 1; $i++) {
						$sql_statement .= $columns[$i] . ' = \'' . $values[$i] . '\', ';
					}
					$sql_statement .= $columns[$length - 1] . ' = \'' . $values[$length - 1] . '\'';
					$sql_statement .= " WHERE $column = $id";
					echo $sql_statement;
					mysqli_query($conn, $sql_statement);
				}
				else {
					http_response_code(400);
					break;
				}
			}
			else {
				http_response_code(400);
				break;
			}
		}
	}
	mysqli_close($conn);
}
?>